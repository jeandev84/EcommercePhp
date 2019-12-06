<?php 

session_start(); 

if(isset($_SESSION['Username'])){
	
	echo 'Welcome ' . $_SESSION['Username'];

}else{

	// echo 'You Are Not Authorized To View This Page';

	header('Location: index.php');
	exit();
}
