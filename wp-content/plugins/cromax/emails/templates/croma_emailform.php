<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
/**
 * email template
 *
 *
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	Reservation
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		email form for transactional emails
 */



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <title>::TITLE::</title>
		<style type="text/css">
		
			/* Browser specific */
			#outlook a{padding:0;} 
			body{width:100% !important;} .ReadMsgBody{width:100%;} 
			.ExternalClass{width:100%;} 
			body{-webkit-text-size-adjust:none;}

			/* Reset Styles */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* Template Styles */


			body, #backgroundTable{
				background-color:#FCFCFC;
			}

			h1, .h1{
				color:#202020;
				display:block;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:34px;
				font-weight:bold;
				line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			h2, .h2{
				color:#202020;
				display:block;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:30px;
				font-weight:bold;
				line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			h3, .h3{
				color:#404040;
				display:block;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:26px;
				font-weight:normal;
				line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}


			h4, .h4{
				color: #404040;
				display:block;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:22px;
				font-weight:normal;
				line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			#templatePreheader{
				background-color:#FCFCFC;
			}

			.preheaderContent div{
				color:#505050;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:10px;
				line-height:100%;
				text-align:center;
			}

			.preheaderContent div a:link, .preheaderContent div a:visited, /* Yahoo! Mail Override */ .preheaderContent div a .yshortcuts /* Yahoo! Mail Override */{
				color:#336699;
				font-weight:normal;
				text-decoration:underline;
			}

			#templateHeader{
				background-color:#FCFCFC;
				border-bottom:0;
			}

			.headerContent{
				color:#202020;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:34px;
				font-weight:bold;
				line-height:100%;
				padding:0;
				text-align:center;
				vertical-align:middle;
			}
			
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				color:#336699;
				font-weight:normal;
				text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:500px !important;
			}

			#templateContainer, .bodyContent{
				background-color:#FFFFFF;
			}

			.bodyContent div{
				color:#505050;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:14px;
				line-height:150%;
				text-align:left;
			}

			
			.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
				color:#336699;
				font-weight:normal;
				text-decoration:underline;
			}

			.bodyContent img{
				display:inline;
				height:auto;
			}


			#templateFooter{
				background-color:#404040;
				border-top:0;
			}

			.footerContent div{
				color:#707070;
				font-family: Tahoma, Verdana, Segoe, sans-serif;
				font-size:12px;
				line-height:125%;
				text-align:left;
			}

			.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
				color:#336699;
				font-weight:normal;
				text-decoration:underline;
			}

			.footerContent img{
				display:inline;
			}

			
			#social{
				background-color:#FAFAFA;
				border:0;
			}

			#social div{
				text-align:center;
			}

			#utility{
				background-color:#FFFFFF;
				border:0;
			}

			#utility div{
				text-align:center;
			}

			#monkeyRewards img{
				max-width:190px;
			}
		</style>
	</head>
    

    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	
    	<center>


        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="font-family: Tahoma, Verdana, Segoe, sans-serif;">
            	<tr>
                	<td align="center" valign="top" style="background-color:#1C1E20;">
                        


                        <!--  Begin Template Preheader  -->
                        <table border="0" cellpadding="10" cellspacing="0" width="500" id="templatePreheader" style="background: transparent; color: #fff;margin-bottom: 50px;">
                            <tr>
                                <td valign="top" class="preheaderContent">
                                
                                	<!--  Begin Module: Standard Preheader  -->
                                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                    	<tr>
                                        	<td valign="top">
                                            	<div mc:edit="std_preheader_content" style="color: #fff; font-size: 20px;">
                                                	::TITLE::
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                	<!--  End Module: Standard Preheader  -->
                                
                                </td>
                            </tr>
                        </table>
                        <!-- // End Template Preheader  -->


                        <table border="0" cellpadding="0" cellspacing="0" width="500" id="templateContainer" style="background-color:::COLOR::;">
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Body  -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="500" id="templateBody">
                                    	<tr>
                                            <td valign="top" class="bodyContent">
                                
                                                <!-- // Begin Module: Standard Content  -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%" style="background: ::COLOR:: ;">
                                                    <tr>
                                                        <td valign="top">
                                                            <div mc:edit="std_content00">
                                                                <h3 class="h3" style="text-align: center; margin: 0px; padding: 40px; color: #fff; line-height: 1.6;font-weight: normal;">::SUBTITLE::</h3>
                                                            </div>
														</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content  -->
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body  -->
                                </td>
                            </tr>
                           </table>



                        <table border="0" cellpadding="0" cellspacing="0" width="500" id="templateContainer">
                        	<tr>
                            	<td align="center" valign="top">


                                	<table border="0" cellpadding="0" cellspacing="0" width="500" id="templateBody">
                                    	<tr>
                                            <td valign="top" class="bodyContent">
                                
                                                <!-- // Begin Module: Standard Content  -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                    	<td valign="top" colspan="2" style="padding: 25px 0;">
                                                            <div mc:edit="std_content00">
                                                                <h4 style="text-align:center; padding: 10px 20px 0 20px; color: #464646;font-weight: normal;">::BODY::</h4> 
                                                            </div>
														</td>
													</tr>
												</table>
                                                
                                            </td>
                                        </tr>
                                    </table>

                                    ::MAININFO::

                                </td>
                            </tr>
                         </table>
                         <br/>


                         <table border="0" cellpadding="0" cellspacing="0" width="500" id="templateContainer" style="color: #fff;">
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Footer  -->
                                	<table border="0" cellpadding="10" cellspacing="0" width="500" id="templateFooter" style="background: ::COLOR::; color: #fff;">
                                    	<tr>
                                        	<td valign="top" class="footerContent">
                                            
                                                <!-- // Begin Module: Standard Footer  -->
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    
                                                    <tr>
                                                        <td valign="top" width="350">
                                                            <div mc:edit="std_footer" style="color: #fff; font-weight: bold;">
																<em>&copy; ::BLOGYEAR:: ::BLOGNAME::</em>
                                                            </div>
                                                        </td>
                                                        <td valign="top" width="190" id="cro_ftr">
                                                            <div style="text-align: right;">
                                                               <a href="::BLOGADDR::" style="color: #fff; font-weight: bold; text-decoration: none;">::BLOGNAME::</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Footer  -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer  -->
                                </td>
                            </tr>
                        </table>


                        <br />
                    </td>
                </tr>
            </table>

            
        </center>
    </body>
</html>

