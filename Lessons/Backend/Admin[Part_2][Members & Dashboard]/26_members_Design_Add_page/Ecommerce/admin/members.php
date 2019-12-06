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
            echo 'Welcome To Manage Members Page<br>';

            echo '<a href="members.php?do=Add">Add New Member</a>';


      } elseif($do == 'Add'){  // Add Members Page ?>

         <h1 class="text-center">Add New Member</h1> 
         <div class="container">
         <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- Start Username Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Username</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Shop">
               </div>
            </div>
             <!-- End Username Field -->

            <!-- Start Password Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Password</label>
               <div class="col-sm-10 col-md-6">
                  <input type="password" name="password" class="form-control" autocomplete="new-password" required="required" placeholder="Password Must Be Hard & Complex">

               </div>
            </div>
            <!-- End Password Field -->

            <!-- Start Email Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Email</label>
               <div class="col-sm-10 col-md-6">
                  <input type="email" name="email" class="form-control" required="required" placeholder="Email Must Be Valid">
               </div>
            </div>
            <!-- End Email Field -->

            <!-- Start Full Name Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Full Name</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="full" value="" class="form-control" required="required" placeholder="Full Name Appear In Your Profile Page">
               </div>
            </div>
            <!-- End Full Name Field -->

            <!-- Start Submit Field -->
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Add Member" class="btn btn-primary">
               </div>
            </div>
            <!-- End Submit Field -->
           
         </form>
         </div>

      <?php 

      }elseif($do == 'Insert'){
          
        // Insert Member Page
            
        echo $_POST['username'] . $_POST['password'] . $_POST['email'] . $_POST['full'];

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
      				<input type="text" name="username" value="<?php echo $row['Username']; ?>" class="form-control" autocomplete="off" required="required">
      			</div>
      		</div>
             <!-- End Username Field -->

      		<!-- Start Password Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Password</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>">
                  <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change">

      			</div>
      		</div>
      		<!-- End Password Field -->

      		<!-- Start Email Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Email</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="email" name="email" value="<?php echo $row['Email']; ?>" class="form-control" required="required">
      			</div>
      		</div>
      		<!-- End Email Field -->

      		<!-- Start Full Name Field -->
      		<div class="form-group form-group-lg">
      			<label class="col-sm-2 control-label">Full Name</label>
      			<div class="col-sm-10 col-md-6">
      				<input type="text" name="full" value="<?php echo $row['FullName']; ?>" class="form-control" required="required">
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
          echo "<div class='container'>";

          if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
                // Get Variables From The Form

                $id    = $_POST['userid'];
                $user  = $_POST['username'];
                $email = $_POST['email'];
                $name  = $_POST['full'];

                // Password Trick

                $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

                // Validate The Form
                
                $formErrors = array();
                
                if(strlen($user) < 4){

                   $formErrors[] = '<div class="alert alert-danger">Username Cant Be Less Than <strong>4 Characters</strong></div>';
                }

                if(strlen($user) > 20){

                   $formErrors[] = '<div class="alert alert-danger">Username Cant Be More Than <strong>20 Characters</strong></div>';
                }


                if(empty($user)){

                   $formErrors[] = '<div class="alert alert-danger">Username Cant Be <strong>Empty</strong></div>';
                }

                if(empty($name)){

                   $formErrors[] = '<div class="alert alert-danger">Full Name Cant Be <strong>Empty</strong></div>';
                }

                if(empty($email)){

                   $formErrors[] = '<div class="alert alert-danger">Email Cant Be <strong>Empty</strong></div>';

                }

                // Loop Into Errors Array And Echo It

                foreach ($formErrors as $error) {
                   
                     echo $error;
                }


                // Check If There 's No Error Proceed The Update Operation'
                
                  if(empty($formErrors)){

                      // Update The Database With THis Info
                     $stmt = $con->prepare("UPDATE users 
                                             SET Username = ?, 
                                                 Email = ?, 
                                                 FullName = ?,
                                                 Password = ?
                                             WHERE UserID = ?");

                     $stmt->execute(array($user, $email, $name, $pass, $id));

                     // Echo Success Message
                     echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

                 } 

          }else{

             echo 'Sorry You Cant Browse This Page Directly';
          }

          echo "</div>";

     }

    include $tpl. 'footer.php'; 

}else{

	header('Location: index.php');
	exit();
}
