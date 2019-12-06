<?php 


/*
 =======================================================
 ==  Manage Comments Page                             
 ==  You Can Edit | Delete | Approve Comments From Here  
 ==  http://localhost:8000/members.php?do=Add/...
 =======================================================
*/

ob_start(); // Output Buffering Start

error_reporting(1);

session_start(); 
 
$pageTitle = 'Comments';


if(isset($_SESSION['Username'])){
	  
      include 'init.php';
       
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

      // Start Manage Page

      if($do == 'Manage'){ // Manage Members Page
         
         // Select All Users Except Admin

 $stmt = $con->prepare("SELECT 
                           comments.*, items.Name AS Item_Name, users.Username AS Member
                        FROM 
                           comments
                        INNER JOIN 
                           items
                        ON 
                           items.Item_ID = comments.item_id
                        INNER JOIN 
                           users
                        ON 
                           users.UserID = comments.user_id");

         // Execute The Statement

         $stmt->execute();

         // Assign To Variable

         $rows = $stmt->fetchAll();

       ?>
          
         <h1 class="text-center">Manage Comments</h1> 
         <div class="container">
            <div class="table-responsive">
               <table class="main-table text-center table table-bordered">
                  <tr>
                     <td>ID</td>
                     <td>Comment</td>
                     <td>Item Name</td>
                     <td>User Name</td>
                     <td>Added Date</td>
                     <td>Control</td>
                  </tr>
               
                  <?php 

                     foreach ($rows as $row){
                        echo "<tr>";
                           echo "<td>" . $row['c_id'] . "</td>";
                           echo "<td>" . $row['comment'] . "</td>";
                           echo "<td>" . $row['Item_Name'] . "</td>";
                           echo "<td>" . $row['Member'] . "</td>";
                           echo "<td>" . $row['comment_date'] . "</td>";
                           echo "<td>
                                  <a href='comments.php?do=Edit&comid=". $row['c_id'] ."' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                  <a href='comments.php?do=Delete&comid=". $row['c_id'] ."' class='btn btn-danger confirm'><i class='fa fa-close'></i>   Delete</a>";

                                    if($row['Status'] == 0){

                                      echo "<a href='comments.php?do=Approve&comid=". $row['c_id'] ."' class='btn btn-info  activate'><i class='fa fa-check'></i> Approve</a>";


                                    }

                                 echo "</td>";
                        echo "</tr>";
                     }
                  ?>
               </table>
             </div>
         </div>
         
     <?php  

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
      if($count > 0){ ?>

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
      				<input type="submit" value="Save" class="btn btn-primary btn-lg">
      			</div>
      		</div>
      		<!-- End Submit Field -->
           
      	</form>
      </div>  

      <?php 
        
        // If There's No Such ID, Show Error Message

        }else{
             
             echo "<div class='container'>";

             $theMsg = '<div class="alert alert-danger">Theres No Such ID</div>';

             redirectHome($theMsg, 'back');

             echo "</div>";
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
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
                
                redirectHome($theMsg, 'back');
                 
            } 

       }else{

            $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

            redirectHome($theMsg);
       }

        echo "</div>";

   }elseif($do == 'Delete'){

       echo "<h1 class='text-center'>Delete Member</h1>";
       echo "<div class='container'>";

       // Check If Get Request userid Is Numeric & Get The Integer Value Of It
       $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0; 

      // Select All Data Depend On This ID ()
       
       $check = checkItem('userid', 'users' , $userid); 


      // If There's Such ID Show The Form
       if($check > 0){ 

            $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
            $stmt->bindParam(":zuser", $userid);
            $stmt->execute();

            // Echo Success Message
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

            redirectHome($theMsg);

        }else{

             $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

             redirectHome($theMsg);

        }
    
        echo '</div>';

     } elseif ($do == 'Activate'){

           
        echo "<h1 class='text-center'>Activate Member</h1>";
        echo "<div class='container'>";

      // Check If Get Request userid Is Numeric & Get The Integer Value Of It
         $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0; 

        // Select All Data Depend On This ID ()
       
         $check = checkItem('userid', 'users' , $userid); 


         // If There's Such ID Show The Form
         if($check > 0){ 

            $stmt = $con->prepare("UPDATE users 
                                   SET RegStatus = 1 
                                   WHERE UserID = ?");

            $stmt->execute(array($userid));

            // Echo Success Message
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

            redirectHome($theMsg);

         }else{

             $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

             redirectHome($theMsg);

        }
    
        echo '</div>';
        
     }
   
   include $tpl. 'footer.php'; 

}else{

	header('Location: index.php');
	exit();
}

ob_end_flush(); // Release The Output