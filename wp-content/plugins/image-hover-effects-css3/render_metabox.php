<?php global $post; ?>
	    <div id="wcpinner" class="na-main-wrap">
	    <?php
	    $all_styles = array('effect2',
	    					'effect3',
	    					'effect4',
	    					'effect5',
	    					'effect6',
	    					'effect7',
	    					'effect8',
	    					'effect9',
	    					'effect10',
	    					'effect11',
	    					'effect12',
	    					'effect13',
	    					'effect14',
	    					'effect15',
	    					'effect16',
	    					'effect17',
	    					'effect18',
	    					'effect19',
	    					'effect20',
	    	);
	    //get the saved meta as an arry
	    $saved_options = get_post_meta($post->ID,'wcpop',true);

	    $column = 1;
	    if ( count( $saved_options ) > 0 && is_array($saved_options)) {
	        foreach( $saved_options as $key => $options ) {
	       		include 'temp/saved_options.php';
	                $column = $column +1;
	        }
	    } else {
	    	include 'temp/load_first.php';
	    }

	    ?>
	</div>
	<br>
	<span class="add button button-secondary"><?php _e('Add New'); ?></span>