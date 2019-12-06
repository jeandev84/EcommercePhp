<?php 
  
  session_start();

  $pageTitle = 'Profile';

  include  'init.php';
  
  if(isset($_SESSION['user'])){
   
   $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
   
   $getUser->execute(array($sessionUser));

   $info = $getUser->fetch();

?>

<h1 class="text-center">My Profile</h1>

<div class="information block">
	<div class="container">
		<div class="panel panel-primary"><!-- ou panel-default-->
			<div class="panel-heading">My Information</div>
			<div class="panel-body">
				Name:  <?php echo  $info['Username']; ?> <br>
				Email: <?php echo  $info['Email']; ?> <br>
				Full Name:  <?php echo  $info['FullName']; ?> <br>
				Register Date:  <?php echo  $info['Date']; ?> <br>
				Favourite Category :  
			</div>
		</div>
	</div>
</div>

<!-- Ads ( Advertisment - Avertissement ) -->
<div class="my-Ads block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Ads</div>
			<div class="panel-body">
				Test Ads
			</div>
		</div>
	</div>
</div>

<div class="my-comments block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">Latest Comments</div>
			<div class="panel-body">
				Test Comments
			</div>
		</div>
	</div>
</div>

<?php 

  }else{

     header('Location: login.php');
     exit();

  }

  include $tpl. 'footer.php'; 
?>