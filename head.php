<!DOCTYPE html>
<html lang="en">
<head>
<!-- title and meta -->
<meta charset="utf-8" />
<title>O'Toole Web Development</title>
<meta name="description" content="" >
<meta name="author" content="Liam O'Toole" >
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<!--===================================Bootstrap css====================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--===================================CSS====================-->
<link rel="stylesheet" href="myCss/template.css"/>
<link rel="stylesheet" href="myCss/header.css"/>
<link rel="stylesheet" href="myCss/carousel.css">
<link rel="stylesheet" href="myCss/home-threesome.css">
<link rel="stylesheet" href="myCss/partner-links.css">
<link rel="stylesheet" href="myCss/clients.css">
<link rel="stylesheet" href="myCss/services.css">
<link rel="stylesheet" href="myCss/contact.css">
<!-- link bootstrap local files -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!-- <script src="js/bootstrap.min.js"></script> -->
<!--===================================JS for Icons====================-->
<script src="https://use.fontawesome.com/9fd7479891.js"></script>
<!-- google fonts -->
<!--===================================JS for Icons====================-->
<script src="https://use.fontawesome.com/9fd7479891.js"></script>
<!--===================================Bootstrap js====================-->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/animate.min.css" rel="stylesheet" />
<!--===================================Google Analytics====================-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-79858300-6', 'auto');
  ga('send', 'pageview');

</script>
<?php
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;
$domain = "http://";
if (isset($_SERVER['HTTPS'])) {
    if ($_SERVER['HTTPS']) {
        $domain = "https://";
    }
}
$server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");


$domain .= $server;

$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);

if ($debug){

    print "<p>Domain" . $domain;
    print "<p>php Self". $phpSelf;
    print "<p>Path Parts<pre>";
    print_r($path_parts);
    print "</pre>";

}
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries
//
require_once('Lib/security.php');
if ($path_parts['filename'] == "contact") {
    include "Lib/validation-functions.php";
    include "Lib/mail-message.php";
}
?>

</head>
