<?php 

session_start(); 
 

if(isset($_SESSION['Username'])){
	
	  $pageTitle = 'Dashboard';

      include 'init.php';
      
      // echo '<pre>';
      // print_r($_SESSION);
      // echo '</pre>';

      include $tpl. 'footer.php'; 

}else{

	// echo 'You Are Not Authorized To View This Page';

	header('Location: index.php');
	exit();
}
