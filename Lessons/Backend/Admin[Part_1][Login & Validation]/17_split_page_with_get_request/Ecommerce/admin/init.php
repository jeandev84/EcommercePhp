<?php 


include 'connect.php';


// Routes

$tpl  = 'includes/templates/'; // Template Directory
$css  = 'layout/css/';  // Css Directory
$js   = 'layout/js/';  // Js Directory
$lang = 'includes/languages/';  // Language Directory


// Includes The Important Files

include  $lang . 'english.php';
include  $tpl. 'header.php'; 


// Include Navbar On All Pages Except The One With $noNavbar Variable

if(! isset($noNavbar)){ include  $tpl . 'navbar.php'; }
