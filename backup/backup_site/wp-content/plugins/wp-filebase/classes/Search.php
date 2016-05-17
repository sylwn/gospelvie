<?php
class WPFB_Search {

static function InitClass()
{
	add_filter('posts_join', array(__CLASS__, 'PostsJoin'));
	add_filter('posts_search', array(__CLASS__, 'PostsSearch'));
	add_filter('posts_groupby', array(__CLASS__, 'PostsGroupBy'));
}

static function PostsJoin($join)
{
	global $wpdb;	
	$join .= " LEFT JOIN $wpdb->wpfilebase_files ON ( $wpdb->wpfilebase_files.file_post_id = $wpdb->posts.ID OR $wpdb->wpfilebase_files.file_wpattach_id = $wpdb->posts.ID ) ";
	if(WPFB_Core::GetOpt('search_id3')) 
		$join .= self::ID3Join();
	return $join;
}

private static function getSearchTerms($s)
{
	// code extract from WPs search in query.php
	global $wp_query, $wpdb;
	
	$sentence = empty($wp_query->query_vars['sentence']) ? (empty($_GET['sentence']) ? null : stripslashes($_GET['sentence'])) : $wp_query->query_vars['sentence'];
	$search_terms = array();
		
	if ( !empty($s) )
	{
		$s = $wpdb->escape(stripslashes($s));
		if ($sentence)
			$search_terms = array($s);
		else {
			preg_match_all('/".*?("|$)|((?<=[\\s",+])|^)[^\\s",+]+/', $s, $matches);
			$search_terms = array_map(create_function('$a', 'return trim($a, "\\"\'\\n\\r ");'), $matches[0]);
		}
	}
	return $search_terms;
}

// creates sql for searching files
static function SearchWhereSql($search_id3=false, $s=null) {
	global $wp_query, $wpdb;

	static $search_fields;
	
	if(empty($search_fields)) { $search_fields = array_merge(array(
	'file_name', 'file_thumbnail', 'file_display_name', 'file_description', 'file_tags',
	'file_requirement', 'file_version', 'file_author', 'file_language', 
	'file_platform', 'file_license'), array_keys(WPFB_Core::GetCustomFields(true)));
	}	
	
	if(empty($s)) {
		$s = empty($wp_query->query_vars['s']) ? (empty($_GET['s']) ? null : stripslashes($_GET['s'])) : $wp_query->query_vars['s'];
		if(empty($s)) return null;
	}
	$exact = !empty($wp_query->query_vars['exact']);
	$p = $exact ? '' : '%';
	$search_terms = self::getSearchTerms($s);
	$where = "(1";
	
	foreach($search_terms as $term) {
		$where .= " AND (";
		$or = '';
		foreach($search_fields as $sf) {
			$col = "{$wpdb->wpfilebase_files}.{$sf}";
			$where .= " {$or}({$col} LIKE '{$p}{$term}{$p}')";
			if(empty($or)) $or = 'OR ';
		}
		if($search_id3) $where .= " OR ({$wpdb->wpfilebase_files_id3}.keywords LIKE '{$p}{$term}{$p}')";
		$where .= ") ";
	}
	$where .= ")";
	
	return $where;
}

// injects extra sql for file attachments search
static function PostsSearch($sql)
{
	global $wp_query, $wpdb;
	
	if(empty($sql)) return $sql;
	
	$search_id3 = WPFB_Core::GetOpt('search_id3');
	$no_matches = false;	
	$where = self::SearchWhereSql($search_id3);	
	wpfb_loadclass('File');
	$where = "($where AND (".WPFB_File::GetPermissionWhere()."))";
	
	// check if there are matching files, if there are, include the filebrowser page/post in the resulst!
	$file_browser_id = intval(WPFB_Core::GetOpt('file_browser_post_id'));
	if($file_browser_id > 0 && WPFB_File::GetNumFiles2($where, true) > 0) {	
		$where = "($where OR ({$wpdb->posts}.ID = $file_browser_id))"; // TODO!
		wpfb_loadclass('Output');
		WPFB_Core::$file_browser_search = true;
	}
	
	// OR' the $where to existing search conditions
	$p = strpos($sql, "(");	
	$sql = substr($sql, 0, $p) . "( " . substr($sql, $p);
	
	$p = strrpos($sql, ")))");
	$sql = substr($sql, 0, $p+3) . " OR $where)" . substr($sql, $p+3);
	
	//echo $sql;
	
	return $sql;
}

static function PostsGroupBy($groupby) {
	global $wpdb;
	if(!empty($groupby)) $groupby .= ", ";
	$groupby .= "{$wpdb->posts}.ID";
	return $groupby;
}

static function ID3Join() { // deprecated TODO
	global $wpdb;
	return " LEFT JOIN $wpdb->wpfilebase_files_id3 ON ( $wpdb->wpfilebase_files_id3.file_id = $wpdb->wpfilebase_files.file_id ) ";
}

// used for filebrowser search results
static function FileSearchContent(&$ref_content)
{
	$files = WPFB_File::GetFiles2(self::SearchWhereSql(WPFB_Core::GetOpt('search_id3'), stripslashes($_GET['wpfb_s'])), WPFB_Core::GetOpt('hide_inaccessible'));	
	foreach($files as $file)
		$ref_content .= $file->GenTpl2();
}
}