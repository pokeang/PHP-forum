<?php
session_start();
require_once("includes/functions.php");

$obj_class = new functions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
  <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
  <!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

  <!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<!-- for tab -->
    <link rel="stylesheet" href="tab/ui.css" type="text/css" media="print, projection, screen">
    <link rel="stylesheet" href="tab/ui1.css" type="text/css" media="print, projection, screen">
    <script src="tab/jquery-1.js" type="text/javascript"></script>
    <script src="tab/ui_002.js" type="text/javascript"></script>
    <script src="tab/ui.js" type="text/javascript"></script>
<!-- end for tab -->
    <head>
      <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Remove this line if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta name="viewport" content="width=device-width">

        <meta name="description" content="Forum IT, Web developer, basic programming, general topic">
        <title>HOME // Forum General</title>

        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <link rel="shortcut icon" type="image/png" href="favicon.png" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/layout.css" />
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
          <!-- Prompt IE 7 users to install Chrome Frame -->
          <!--[if lt IE 8]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

          <div class="container">

            <header id="navtop">
              <a href="index.php" class="logo fleft">
                <img src="img/logo-forum.png" alt="Designa Studio">
              </a>
              <nav class="fright">
                <?php include("included/top_menu.php"); ?>              
              </nav>
              
            </header>
            <?php
                include_once("included/lpanel.php");
                //===========HERE TO INCLUDE THE PAGE===================
                $page = mysql_real_escape_string(@$_GET['page']);
                if (isset($_GET['page']) && trim($_GET['page']) != "logout") {
                  echo "<section class='grid col-three-quarters mq2-col-two-thirds mq3-col-full' id='main' style='padding:20px 0 20px 10px; border-left:1px solid #ccc; width:74%;'>";
                  if(file_exists('included/'.$page.".php")){
                      include_once('included/' . $page . '.php');
                  }else  include_once('included/pagenotfound.php');
                  
                  echo "</section>";
                }else if(@$_GET["page"] == "logout"){
                   unset($_SESSION['username']); unset($_SESSION['id']);
                   include_once("included/front_page.php");
                }
                else if (@$_SESSION['username'] != "") {
                  echo "<section class='grid col-three-quarters mq2-col-two-thirds mq3-col-full' id='main' style='padding:20px 0 20px 10px; border-left:1px solid #ccc; width:74%;'>";
                   $obj = mysql_real_escape_string($_GET["obj"]);
                  if(isset($obj) && mysql_real_escape_string(@$_GET["act"] != "")){
                     $obj_class->assignaction();
                   }else
                      include_once("included/loginsucces.php");
                  echo "</section>";
                }
                else
                  include_once("included/front_page.php");
            ?>
                <div class="divide-top">
                  <footer class="grid-wrap">
                    <ul class="grid col-one-third social">
                      <li><a href="#">RSS</a></li>
                      <li><a href="#">Facebook</a></li>
                      <li><a href="#">Twitter</a></li>
                      <li><a href="#">Google+</a></li>
                      
                    </ul>

                    <div class="up grid col-one-third ">
                      <a href="#navtop" title="Go back up">&uarr;</a>
                    </div>

                    <nav class="grid col-one-third ">
                      <ul>
                        <li><a href=".">Home</a></li>
                        <li><a href="?page=about">About</a></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                      </ul>
                    </nav>
                  </footer>
                </div>

              </div>


              <!--[if (gte IE 6)&(lte IE 8)]>
              <script src="js/selectivizr.js"></script>
              <![endif]-->

              <script src="js/jquery.flexslider-min.js"></script>
              <script src="js/scripts.js"></script>
              <script src="js/jquery.validate.min.js"></script>
              <script src="js/jsfunction.js"></script>
          <?php
                if (isset($_GET['page']) && trim($_GET['page']) == "signup") {
          ?>
           <!--<script src="js/jquery.validate.min.js"></script>-->
          <?php
                }
          ?>
        </body>
 </html>