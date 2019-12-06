<?php 


/*
 ====================================================
 ==  Manage Members Page
 ==  You Can Add | Edit | Delete Members From Here
 ====================================================
*/


session_start(); 
 

if(isset($_SESSION['Username'])){
	  
      include 'init.php';
       
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

      // Start Manage Page

      if($do == 'Manage'){

      	   // Manage Page

      }elseif($do == 'Edit'){

           // Edt Page
           
           echo 'Welcome To Edit Page Your Id is ' . $_GET['userid'];


      }

      include $tpl. 'footer.php'; 

}else{


	header('Location: index.php');
	exit();
}
