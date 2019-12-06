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

      if($do == 'Manage'){ // Manage Members Page ?>
          
         <h1 class="text-center">Manage Members Page</h1> 
         <div class="container">
            <div class="table-responsive">
               <table class="main-table text-center table table-bordered">
                  <tr>
                     <td>#ID</td>
                     <td>Username</td>
                     <td>Email</td>
                     <td>Full Name</td>
                     <td>Registered Date</td>
                     <td>Control</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>
                        <a href="#" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>
                        <a href="#" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>
                        <a href="#" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>
                        <a href="#" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>
                        <a href="#" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
               </table>
             </div>
             <a href="members.php?do=Add" class="btn btn-primary">
               <i class="fa fa-plus"></i> Add New Member</a>
         </div>
         
     <?php } elseif($do == 'Add'){  // Add Members Page ?>

         <h1 class="text-center">Add New Member</h1> 
         <div class="container">
         <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- Start Username Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Username</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Username To Login Into Shop" required="required">
               </div>
            </div>
             <!-- End Username Field -->

            <!-- Start Password Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Password</label>
               <div class="col-sm-10 col-md-6">
                  <input type="password" name="password" class="password form-control" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" required="required">
                  <i class="show-pass fa fa-eye fa-2x"></i>

               </div>
            </div>
            <!-- End Password Field -->

            <!-- Start Email Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Email</label>
               <div class="col-sm-10 col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="Email Must Be Valid" required="required">
               </div>
            </div>
            <!-- End Email Field -->

            <!-- Start Full Name Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Full Name</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="full" class="form-control" placeholder="Full Name Appear In Your Profile Page" required="required">
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


          if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Update Member</h1>";
                echo "<div class='container'>";
             
                // Get Variables From The Form

                $user  = $_POST['username'];
                $pass  = $_POST['password'];
                $email = $_POST['email'];
                $name  = $_POST['full'];

                
                $hashPass = sha1($_POST['password']);

                // Validate The Form
                
                $formErrors = array();
                
                if(strlen($user) < 4){

                   $formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
                }

                if(strlen($user) > 20){

                   $formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
                }


                if(empty($user)){

                   $formErrors[] = 'Username Cant Be <strong>Empty</strong>';
                }

                if(empty($pass)){

                   $formErrors[] = 'Password Cant Be <strong>Empty</strong>';
                }

                if(empty($name)){

                   $formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
                }

                if(empty($email)){

                   $formErrors[] = 'Email Cant Be <strong>Empty</strong>';

                }

                // Loop Into Errors Array And Echo It

                  foreach ($formErrors as $error) {
                   
                   echo '<div class="alert alert-danger">' . $error .'</div>';

                  }


                 // Check If There 's No Error Proceed The Update Operation'
                
                  if(empty($formErrors)){

                  // Insert Userinfo In Database
                  $stmt = $con->prepare("INSERT INTO 
                                         users(Username, Password, Email, FullName)
                                         VALUES(:zuser, :zpass, :zmail, :zname)");
                  $stmt->execute(array(

                      'zuser' => $user,
                      'zpass' => $hashPass,
                      'zmail' => $email,
                      'zname' => $name

                  ));

                     // // Echo Success Message
                     echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

                 } 

          }else{

             echo 'Sorry You Cant Browse This Page Directly';
          }

          echo "</div>";

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

                 
               // Validate the Form

                $formErrors = array();
                
                if(strlen($user) < 4){

                   $formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
                }

                if(strlen($user) > 20){

                   $formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
                }


                if(empty($user)){

                   $formErrors[] = 'Username Cant Be <strong>Empty</strong>';
                }

                if(empty($name)){

                   $formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
                }

                if(empty($email)){

                   $formErrors[] = 'Email Cant Be <strong>Empty</strong>';

                }

                // Loop Into Errors Array And Echo It

                foreach ($formErrors as $error) {
                   
                  echo '<div class="alert alert-danger">' . $error .'</div>';

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
