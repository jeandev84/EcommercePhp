<?php 


/*
 =======================================================
 ==  Manage Members Page                             ===
 ==  You Can Add | Edit | Delete Members From Here   ===
 =======================================================
*/


session_start(); 
 
$pageTitle = 'Members';


if(isset($_SESSION['Username'])){
	  
      include 'init.php';
       
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

      // Start Manage Page

      if($do == 'Manage'){

      	   // Manage Page

      }elseif($do == 'Edit'){ // Edt Page 

      // Check If Get Request userid Is Numeric & Get The Integer Value Of It
      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0; 

      // Select All Data Depend On This ID ()
      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
      
      
      // Execute Query
      $stmt->execute(array($userid));

      // Fetch The Data
      $row = $stmt->fetch();

      // The Row Count
      $count = $stmt->rowCount();

      // If There's Such ID Show Form
      if($stmt->rowCount() > 0){ ?>

      <h1 class="text-center">Edit Member</h1> 
      <div class="container">
      	<form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
      		<!-- Start Username Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Username</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="text" name="username" value="<?php echo $row['Username']; ?>" class="form-control" autocomplete="off">
      			</div>
      		</div>
             <!-- End Username Field -->

      		<!-- Start Password Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Password</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>">
                  <input type="password" name="newpassword" class="form-control" autocomplete="new-password">

      			</div>
      		</div>
      		<!-- End Password Field -->

      		<!-- Start Email Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Email</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="email" name="email" value="<?php echo $row['Email']; ?>" class="form-control">
      			</div>
      		</div>
      		<!-- End Email Field -->

      		<!-- Start Full Name Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Full Name</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="text" name="full" value="<?php echo $row['FullName']; ?>" class="form-control">
      			</div>
      		</div>
      		<!-- End Full Name Field -->

      		<!-- Start Submit Field -->
      		<div class="form-group">
      			<div class="col-sm-offset-2 col-sm-10">
      				<input type="submit" value="Save" class="btn btn-primary">
      			</div>
      		</div>
      		<!-- End Submit Field -->
           
      	</form>
      </div>  

      <?php 
        
        // If There's No Such ID, Show Error Message

        }else{

             echo 'Theres No Such ID';
        }

     }elseif($do == 'Update'){ // Update Page
         
          echo "<h1 class='text-center'>Update Member</h1>";

          if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
                // Get Variables From The Form
                $id    = $_POST['userid'];
                $user  = $_POST['username'];
                $email = $_POST['email'];
                $name  = $_POST['full'];

                // Password Trick
                $pass = '';

                if(empty($_POST['newpassword'])){

                    $pass = $_POST['oldpassword'];

                }else{

                    $pass = sha1($_POST['newpassword']);
                }

                // Update The Database With THis Info
                $stmt = $con->prepare("UPDATE users 
                                       SET Username = ?, 
                                           Email = ?, 
                                           FullName = ?,
                                           Password = ?
                                       WHERE UserID = ?");

                $stmt->execute(array($user, $email, $name, $pass, $id));

                // Echo Success Message
                echo $stmt->rowCount() . ' Record Updated';

          }else{

             echo 'Sorry You Cant Browse This Page Directly';
          }

     }

    include $tpl. 'footer.php'; 

}else{

	header('Location: index.php');
	exit();
}
