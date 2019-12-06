<?php 
  ob_start();
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
				<ul class="list-unstyled">
				<li>
					<i class="fa fa-unlock-alt fa-fw"></i>
					<span>Login Name</span>:  
					<?php echo  $info['Username']; ?>
				</li>
				<li>
					<i class="fa fa-envelope-o fa-fw"></i>
					<span>Email</span>: 
					<?php echo  $info['Email']; ?>
			    </li>
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span>Full Name</span>:  
					<?php echo  $info['FullName']; ?> 
				</li>
				<li>
					<i class="fa fa-calendar fa-fw"></i>
				    <span>Register Date</span>:  
				    <?php echo  $info['Date']; ?>
				</li>
				<li>
					<i class="fa fa-tags fa-fw"></i>
				    <span>Fav Category</span>: 
				</li>
				</ul>
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
			    <?php 

			       if(! empty(getItems('Member_ID', $info['UserID']))){
                   echo '<div class="row">';
   
                   // au paravant foreach (getItems('Member_ID', $info['UserID']) as $item){}
      // apres avoir faire getItems($where, $value, $approve = NULL){}
     //  foreach (getItems('Member_ID', $info['UserID'],1) as $item){}
			       foreach (getItems('Member_ID', $info['UserID'],1) as $item){
			     	 echo '<div class="col-sm-6 col-md-3">'; 
			     	     echo '<div class="thumbnail item-box">';
			     	          if($item['Approve'] == 0){ 
			     	          	echo '<span class="approve-status">    Waiting Approval
			     	          	    </span>'; 
			     	          }
			     	          echo '<span class="price-tag">$'. $item['Price'] .'</span>';
			     	          echo '<img class="img-responsive" src="img.png" alt="">';
			     	          echo '<div class="caption">';
	                                 echo '<h3><a href="items.php?itemid='.$item['Item_ID'] .'">'. $item['Name'] .'</a></h3>';
	                                 echo '<p>'.  $item['Description'] .'</p>';
	                                 echo '<div class="date">'.  $item['Add_Date'] .'</div>';
			     	          echo '</div>';
			     	     echo '</div>';
			     	 echo '</div>';
			      }
               
               echo '</div>';

			  }else{

			  	   echo 'Sorry There\'is No Ads To Show, Create <a href="newad.php">New Ad</a>';
			  }
			 
			 ?>
		  </div>
		</div>
	</div>
</div>

<div class="my-comments block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">Latest Comments</div>
			<div class="panel-body">
				<?php 

         // Select All Users Except Admin
         $stmt = $con->prepare("SELECT 
                                  comment
                                FROM 
                                  comments
                                WHERE  user_id = ?");

					         // Execute The Statement
					         $stmt->execute(array($info['UserID']));

					         // Assign To Variable
					         $comments = $stmt->fetchAll();

					         if(! empty($comments)){

                                 foreach ($comments as $comment) {

                                 	echo '<p>' . $comment['comment'] .'</p>';

                                 }
					         }else{

					         	 echo 'There\'s No Comments to Show';
					         }

				?>
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
  ob_end_flush();

?>