-- MySQL dump 10.13  Distrib 5.5.19, for Linux (x86_64)
--
-- Host: 68.178.142.183    Database: gos1322201195153
-- ------------------------------------------------------
-- Server version	5.0.96-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL auto_increment,
  `comment_id` bigint(20) unsigned NOT NULL default '0',
  `meta_key` varchar(255) default NULL,
  `meta_value` longtext,
  PRIMARY KEY  (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_commentmeta`
--

LOCK TABLES `wp_commentmeta` WRITE;
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL auto_increment,
  `comment_post_ID` bigint(20) unsigned NOT NULL default '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL default '',
  `comment_author_url` varchar(200) NOT NULL default '',
  `comment_author_IP` varchar(100) NOT NULL default '',
  `comment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL default '0',
  `comment_approved` varchar(20) NOT NULL default '1',
  `comment_agent` varchar(255) NOT NULL default '',
  `comment_type` varchar(20) NOT NULL default '',
  `comment_parent` bigint(20) unsigned NOT NULL default '0',
  `user_id` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_comments`
--

LOCK TABLES `wp_comments` WRITE;
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
INSERT INTO `wp_comments` VALUES (1,1,'Mr WordPress','','http://wordpress.org/','','2013-08-10 20:23:59','2013-08-10 20:23:59','Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.',0,'1','','',0,0);
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL auto_increment,
  `link_url` varchar(255) NOT NULL default '',
  `link_name` varchar(255) NOT NULL default '',
  `link_image` varchar(255) NOT NULL default '',
  `link_target` varchar(25) NOT NULL default '',
  `link_description` varchar(255) NOT NULL default '',
  `link_visible` varchar(20) NOT NULL default 'Y',
  `link_owner` bigint(20) unsigned NOT NULL default '1',
  `link_rating` int(11) NOT NULL default '0',
  `link_updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL default '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_links`
--

LOCK TABLES `wp_links` WRITE;
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL auto_increment,
  `option_name` varchar(64) NOT NULL default '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL default 'yes',
  PRIMARY KEY  (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_options`
--

LOCK TABLES `wp_options` WRITE;
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` VALUES (1,'siteurl','http://gospelvie.com','yes'),(2,'blogname','My Website','yes'),(3,'blogdescription','Just another WordPress site','yes'),(4,'users_can_register','0','yes'),(5,'admin_email','boris.da-achinanon@gospelvie.com','yes'),(6,'start_of_week','1','yes'),(7,'use_balanceTags','0','yes'),(8,'use_smilies','1','yes'),(9,'require_name_email','1','yes'),(10,'comments_notify','1','yes'),(11,'posts_per_rss','10','yes'),(12,'rss_use_excerpt','0','yes'),(13,'mailserver_url','mail.example.com','yes'),(14,'mailserver_login','login@example.com','yes'),(15,'mailserver_pass','password','yes'),(16,'mailserver_port','110','yes'),(17,'default_category','1','yes'),(18,'default_comment_status','open','yes'),(19,'default_ping_status','open','yes'),(20,'default_pingback_flag','1','yes'),(21,'posts_per_page','10','yes'),(22,'date_format','F j, Y','yes'),(23,'time_format','g:i a','yes'),(24,'links_updated_date_format','F j, Y g:i a','yes'),(25,'links_recently_updated_prepend','<em>','yes'),(26,'links_recently_updated_append','</em>','yes'),(27,'links_recently_updated_time','120','yes'),(28,'comment_moderation','0','yes'),(29,'moderation_notify','1','yes'),(30,'permalink_structure','','yes'),(31,'gzipcompression','0','yes'),(32,'hack_file','0','yes'),(33,'blog_charset','UTF-8','yes'),(34,'moderation_keys','','no'),(35,'active_plugins','a:3:{i:0;s:19:\"jetpack/jetpack.php\";i:1;s:45:\"welcome-to-wordpress/welcome-to-wordpress.php\";i:2;s:27:\"quick-setup/quick-setup.php\";}','yes'),(36,'home','http://gospelvie.com','yes'),(37,'category_base','','yes'),(38,'ping_sites','http://rpc.pingomatic.com/','yes'),(39,'advanced_edit','0','yes'),(40,'comment_max_links','2','yes'),(41,'gmt_offset','0','yes'),(42,'default_email_category','1','yes'),(43,'recently_edited','','no'),(44,'template','twentythirteen','yes'),(45,'stylesheet','twentythirteen','yes'),(46,'comment_whitelist','1','yes'),(47,'blacklist_keys','','no'),(48,'comment_registration','0','yes'),(49,'html_type','text/html','yes'),(50,'use_trackback','0','yes'),(51,'default_role','subscriber','yes'),(52,'db_version','24448','yes'),(53,'uploads_use_yearmonth_folders','1','yes'),(54,'upload_path','wp-content/uploads','yes'),(55,'blog_public','1','yes'),(56,'default_link_category','2','yes'),(57,'show_on_front','posts','yes'),(58,'tag_base','','yes'),(59,'show_avatars','1','yes'),(60,'avatar_rating','G','yes'),(61,'upload_url_path','','yes'),(62,'thumbnail_size_w','150','yes'),(63,'thumbnail_size_h','150','yes'),(64,'thumbnail_crop','1','yes'),(65,'medium_size_w','300','yes'),(66,'medium_size_h','300','yes'),(67,'avatar_default','mystery','yes'),(68,'large_size_w','1024','yes'),(69,'large_size_h','1024','yes'),(70,'image_default_link_type','file','yes'),(71,'image_default_size','','yes'),(72,'image_default_align','','yes'),(73,'close_comments_for_old_posts','0','yes'),(74,'close_comments_days_old','14','yes'),(75,'thread_comments','1','yes'),(76,'thread_comments_depth','5','yes'),(77,'page_comments','0','yes'),(78,'comments_per_page','50','yes'),(79,'default_comments_page','newest','yes'),(80,'comment_order','asc','yes'),(81,'sticky_posts','a:0:{}','yes'),(82,'widget_categories','a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}','yes'),(83,'widget_text','a:0:{}','yes'),(84,'widget_rss','a:0:{}','yes'),(85,'uninstall_plugins','a:0:{}','no'),(86,'timezone_string','','yes'),(87,'page_for_posts','0','yes'),(88,'page_on_front','0','yes'),(89,'default_post_format','0','yes'),(90,'link_manager_enabled','0','yes'),(91,'initial_db_version','24448','yes'),(92,'wp_user_roles','a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:62:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:9:\"add_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}','yes'),(93,'widget_search','a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}','yes'),(94,'widget_recent-posts','a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}','yes'),(95,'widget_recent-comments','a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}','yes'),(96,'widget_archives','a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}','yes'),(97,'widget_meta','a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}','yes'),(98,'sidebars_widgets','a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:13:\"array_version\";i:3;}','yes'),(99,'jetpack_activated','3','yes'),(101,'wtwp_options','a:7:{s:11:\"first_login\";b:0;s:4:\"plid\";i:1;s:3:\"isc\";s:10:\"WPHosting1\";s:7:\"api_url\";s:33:\"https://wpqs.secureserver.net/v1/\";s:8:\"help_url\";s:29:\"https://help.securepaynet.net\";s:17:\"control_panel_url\";s:50:\"https://hostingmanager.secureserver.net/Login.aspx\";s:3:\"key\";s:64:\"d8el1JqvjcySncRPKCWS8RPASt2IGt67hI4I2qhMFV9dR822JH2K3se+BHDpSmel\";}','yes'),(102,'gd_quicksetup_last_post','a:0:{}','yes'),(103,'gd_quicksetup_options','a:2:{s:3:\"key\";s:64:\"d8el1JqvjcySncRPKCWS8RPASt2IGt67hI4I2qhMFV9dR822JH2K3se+BHDpSmel\";s:7:\"api_url\";s:33:\"https://wpqs.secureserver.net/v1/\";}','yes'),(104,'cron','a:3:{i:1376166247;a:1:{s:20:\"jetpack_clean_nonces\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1376166248;a:1:{s:17:\"jetpack_heartbeat\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:14:\"jetpack_weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}','yes'),(105,'jetpack_options','a:2:{s:7:\"version\";s:16:\"2.3.3:1376166247\";s:11:\"old_version\";s:16:\"2.3.3:1376166247\";}','yes'),(112,'_transient_timeout_jetpack_https_test','1376252648','no'),(113,'_transient_jetpack_https_test','1','no'),(107,'_site_transient_update_core','O:8:\"stdClass\":3:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":9:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:38:\"http://wordpress.org/wordpress-3.6.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":4:{s:4:\"full\";s:38:\"http://wordpress.org/wordpress-3.6.zip\";s:10:\"no_content\";s:49:\"http://wordpress.org/wordpress-3.6-no-content.zip\";s:11:\"new_bundled\";s:50:\"http://wordpress.org/wordpress-3.6-new-bundled.zip\";s:7:\"partial\";b:0;}s:7:\"current\";s:3:\"3.6\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.6\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1376166247;s:15:\"version_checked\";s:3:\"3.6\";}','yes'),(108,'_site_transient_update_plugins','O:8:\"stdClass\":2:{s:12:\"last_checked\";i:1376166248;s:8:\"response\";a:6:{s:36:\"contact-form-7/wp-contact-form-7.php\";O:8:\"stdClass\":5:{s:2:\"id\";s:3:\"790\";s:4:\"slug\";s:14:\"contact-form-7\";s:11:\"new_version\";s:3:\"3.5\";s:3:\"url\";s:44:\"http://wordpress.org/plugins/contact-form-7/\";s:7:\"package\";s:60:\"http://downloads.wordpress.org/plugin/contact-form-7.3.5.zip\";}s:49:\"facebook-button-plugin/facebook-button-plugin.php\";O:8:\"stdClass\":5:{s:2:\"id\";s:5:\"23139\";s:4:\"slug\";s:22:\"facebook-button-plugin\";s:11:\"new_version\";s:4:\"2.21\";s:3:\"url\";s:52:\"http://wordpress.org/plugins/facebook-button-plugin/\";s:7:\"package\";s:69:\"http://downloads.wordpress.org/plugin/facebook-button-plugin.2.21.zip\";}s:19:\"jetpack/jetpack.php\";O:8:\"stdClass\":5:{s:2:\"id\";s:5:\"20101\";s:4:\"slug\";s:7:\"jetpack\";s:11:\"new_version\";s:5:\"2.3.4\";s:3:\"url\";s:37:\"http://wordpress.org/plugins/jetpack/\";s:7:\"package\";s:55:\"http://downloads.wordpress.org/plugin/jetpack.2.3.4.zip\";}s:39:\"underconstruction/underConstruction.php\";O:8:\"stdClass\":5:{s:2:\"id\";s:4:\"8707\";s:4:\"slug\";s:17:\"underconstruction\";s:11:\"new_version\";s:4:\"1.11\";s:3:\"url\";s:47:\"http://wordpress.org/plugins/underconstruction/\";s:7:\"package\";s:64:\"http://downloads.wordpress.org/plugin/underconstruction.1.11.zip\";}s:51:\"wordpress-popular-posts/wordpress-popular-posts.php\";O:8:\"stdClass\":5:{s:2:\"id\";s:4:\"5377\";s:4:\"slug\";s:23:\"wordpress-popular-posts\";s:11:\"new_version\";s:5:\"2.3.6\";s:3:\"url\";s:53:\"http://wordpress.org/plugins/wordpress-popular-posts/\";s:7:\"package\";s:71:\"http://downloads.wordpress.org/plugin/wordpress-popular-posts.2.3.6.zip\";}s:27:\"wp-filebase/wp-filebase.php\";O:8:\"stdClass\":5:{s:2:\"id\";s:5:\"10299\";s:4:\"slug\";s:11:\"wp-filebase\";s:11:\"new_version\";s:8:\"0.2.9.37\";s:3:\"url\";s:41:\"http://wordpress.org/plugins/wp-filebase/\";s:7:\"package\";s:62:\"http://downloads.wordpress.org/plugin/wp-filebase.0.2.9.37.zip\";}}}','yes'),(109,'_site_transient_timeout_theme_roots','1376168048','yes'),(110,'_site_transient_theme_roots','a:9:{s:10:\"ETHERNA_WP\";s:7:\"/themes\";s:16:\"mobile_pack_base\";s:7:\"/themes\";s:16:\"mobile_pack_blue\";s:7:\"/themes\";s:17:\"mobile_pack_green\";s:7:\"/themes\";s:15:\"mobile_pack_red\";s:7:\"/themes\";s:12:\"twentyeleven\";s:7:\"/themes\";s:9:\"twentyten\";s:7:\"/themes\";s:14:\"twentythirteen\";s:7:\"/themes\";s:12:\"twentytwelve\";s:7:\"/themes\";}','yes'),(111,'_site_transient_update_themes','O:8:\"stdClass\":3:{s:12:\"last_checked\";i:1376166248;s:7:\"checked\";a:9:{s:10:\"ETHERNA_WP\";s:0:\"\";s:16:\"mobile_pack_base\";s:5:\"1.2.5\";s:16:\"mobile_pack_blue\";s:5:\"1.2.5\";s:17:\"mobile_pack_green\";s:5:\"1.2.5\";s:15:\"mobile_pack_red\";s:5:\"1.2.5\";s:12:\"twentyeleven\";s:3:\"1.5\";s:9:\"twentyten\";s:3:\"1.5\";s:14:\"twentythirteen\";s:3:\"1.0\";s:12:\"twentytwelve\";s:3:\"1.2\";}s:8:\"response\";a:0:{}}','yes');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL auto_increment,
  `post_id` bigint(20) unsigned NOT NULL default '0',
  `meta_key` varchar(255) default NULL,
  `meta_value` longtext,
  PRIMARY KEY  (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_postmeta`
--

LOCK TABLES `wp_postmeta` WRITE;
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` VALUES (1,2,'_wp_page_template','default');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `post_author` bigint(20) unsigned NOT NULL default '0',
  `post_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL default 'publish',
  `comment_status` varchar(20) NOT NULL default 'open',
  `ping_status` varchar(20) NOT NULL default 'open',
  `post_password` varchar(20) NOT NULL default '',
  `post_name` varchar(200) NOT NULL default '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL default '0',
  `guid` varchar(255) NOT NULL default '',
  `menu_order` int(11) NOT NULL default '0',
  `post_type` varchar(20) NOT NULL default 'post',
  `post_mime_type` varchar(100) NOT NULL default '',
  `comment_count` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_posts`
--

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES (1,1,'2013-08-10 20:23:59','2013-08-10 20:23:59','Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!','Hello world!','','publish','open','open','','hello-world','','','2013-08-10 20:23:59','2013-08-10 20:23:59','',0,'http://gospelvie.com/?p=1',0,'post','',1),(2,1,'2013-08-10 20:23:59','2013-08-10 20:23:59','This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href=\"http://gospelvie.com/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!','Sample Page','','publish','open','open','','sample-page','','','2013-08-10 20:23:59','2013-08-10 20:23:59','',0,'http://gospelvie.com/?page_id=2',0,'page','',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL default '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL default '0',
  `term_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_relationships`
--

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES (1,1,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL auto_increment,
  `term_id` bigint(20) unsigned NOT NULL default '0',
  `taxonomy` varchar(32) NOT NULL default '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL default '0',
  `count` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_taxonomy`
--

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES (1,1,'category','',0,1);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `slug` varchar(200) NOT NULL default '',
  `term_group` bigint(10) NOT NULL default '0',
  PRIMARY KEY  (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_terms`
--

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES (1,'Uncategorized','uncategorized',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) unsigned NOT NULL default '0',
  `meta_key` varchar(255) default NULL,
  `meta_value` longtext,
  PRIMARY KEY  (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'first_name',''),(2,1,'last_name',''),(3,1,'nickname','boris'),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','fresh'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(11,1,'wp_user_level','10'),(12,1,'dismissed_wp_pointers','wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media,wp360_revisions,wp360_locks'),(13,1,'show_welcome_panel','1');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `user_login` varchar(60) NOT NULL default '',
  `user_pass` varchar(64) NOT NULL default '',
  `user_nicename` varchar(50) NOT NULL default '',
  `user_email` varchar(100) NOT NULL default '',
  `user_url` varchar(100) NOT NULL default '',
  `user_registered` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL default '',
  `user_status` int(11) NOT NULL default '0',
  `display_name` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'boris','$P$BrAoOOvQEe1388vtE5NY3dNR/itkhZ0','boris','boris.da-achinanon@gospelvie.com','','2013-08-10 20:23:59','',0,'boris');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-10 13:24:24
