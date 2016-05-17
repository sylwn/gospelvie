<?php

  $filename = $_GET['type']; 
	
	function dl_file($file){

    //First, see if the file exists
    if (!is_file($file)) { die("<b>404 File not found!</b>"); }

    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
      case "mp3": $ctype="audio/mpeg"; break;

      //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
      case "wav":
      case "mpeg":
      case "mpg":
      case "mpe":
      case "mov":
      case "avi": 
      case "pdf": 
      case "exe": 
      case "zip": 
      case "doc": 
      case "xls": 
      case "ppt": 
      case "gif": 
      case "png": 
      case "jpeg":
      case "jpg": 
      case "php":
      case "htm":
      case "html":
      case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;

      default: $ctype="application/force-download";
    }

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
   
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");

    //Force the download
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    @readfile($file);
    exit;
}
		
	dl_file($filename);
		
?>

