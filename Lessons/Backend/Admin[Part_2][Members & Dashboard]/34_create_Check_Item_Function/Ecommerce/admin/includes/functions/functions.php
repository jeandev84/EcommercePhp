<?php 

 /**
  ** Title Function v1.0
  ** Title Function That Echo The Page Title In Case The Page
  ** Has The Variable $pageTitle 
  ** And Echo Default Title for Other Pages
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
  ** Home Redirect Function  v1.0
  ** This Function Accept Parameters
  ** $errorMsg = Echo The Error Message 
  ** $seconds  = Seconds Before Redirecting
  **
  */

 function redirectHome($errorMsg, $seconds = 3){

 	  echo "<div class='alert alert-danger'>$errorMsg</div>";

 	  echo "<div class='alert alert-info'>You Will Be Redirected to Homepage After $seconds Seconds.</div>";

 	  header("refresh:$seconds;url=index.php");

 	  exit();

 }

 /**
  ** Check Items Function v1.0
  ** Function to Check Item In Database [ Function Accept Parameters ]
  ** $select = The Item To Select [ Example: user, item, category]
  ** $from   = The Table To Select From [ Example: users, items, categories ]
  ** $value  = The Value Of Select [ Example: Osama , Box , Electronics]
  */

function checkItem($select, $from, $value){

    global $con;

    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

    $statement->execute(array($value));

    $count = $statement->rowCount();

    return $count;

}


