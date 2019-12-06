<?php 

session_start(); 
 
// $noNavbar = '';

if(isset($_SESSION['Username'])){
	
	// echo 'Welcome ' . $_SESSION['Username'];
      include 'init.php';

      echo 'Welcome';

      include $tpl. 'footer.php'; 

}else{

	// echo 'You Are Not Authorized To View This Page';

	header('Location: index.php');
	exit();
}
