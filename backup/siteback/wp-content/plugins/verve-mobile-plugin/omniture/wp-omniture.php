<?php

require_once 'OmnitureMeasurement.class.php';

$s = new OmnitureMeasurement();
$s->account = 'vwiwordpress';
$s->botDetection = true;

$s->currencyCode = 'USD';
$s->cookieDomainPeriods = 2;
$s->debugTracking = true;
$s->trackingServer = 'vervewireless.122.2o7.net';

$s->pageName = wp_title();  // <title> of page
$s->pageURL = $_SERVER['REQUEST_URI'];

$s->prop1 = 'Partner Portal';  // Portal
$s->prop2 = 'Wordpress'; // Group
$s->prop3 = get_bloginfo('name'); // Name of the blog
$s->prop4 = date_i18n('l'); // Day of the week (local)
$s->prop5 = date_i18n('g'); // two digit hour of the day (local)
$s->prop6 = get_the_time('l');; // Day of the week (Eastern)
$s->prop7 = get_the_time('g'); // two digit hour of the day (Eastern)
$s->prop12 = get_the_title();  // article headline
$s->prop12 = $_SERVER['REQUEST_URI'];  // full url to blog post

$s->track();

?>