<?php 

 /**
  * Title Function That Echo The Page Title In Case The Page
  * Has The Variable $pageTitle 
  * And Echo Default Title for Other Pages
  */

 function getTitle(){

 	global $pageTitle;
    
    if(isset($pageTitle)){

    	echo $pageTitle;

    }else{

    	echo 'Default';
    }

 }


 /**
  * Home Redirect Function [ This Function Accept Parameters ]
  * $errorMsg = Echo The Error Message 
  * $seconds  = Seconds Before Redirecting
  *
  */

 function redirectHome($errorMsg, $seconds = 3){

 	  echo "<div class='alert alert-danger'>$errorMsg</div>";

 	  echo "<div class='alert alert-info'>You Will Be Redirected to Homepage After $seconds Seconds.</div>";

 	  header("refresh:$seconds;url=index.php");

 	  exit();

 }