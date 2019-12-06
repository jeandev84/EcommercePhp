<?php 
  
  session_start();
  $pageTitle = 'Profile';
  include  'init.php';
  
  // Test variable from file (init.php)
  // echo $sessionUser; 

?>

<h1 class="text-center">My Profile</h1>

<div class="information block">
	<div class="container">
		<div class="panel panel-primary"><!-- ou panel-default-->
			<div class="panel-heading">My Information</div>
			<div class="panel-body">
				Name: Khalid
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
  include $tpl. 'footer.php'; 
?>