<?php 
  ob_start();
  session_start(); 
  $pageTitle = 'Login';

  if(isset($_SESSION['user'])){
		header('Location: index.php'); 
  }

  include 'init.php';

  // Check If User Coming From HTTP Post Request
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
     
        if(isset($_POST['login'])){

            	$user   = $_POST['username'];
            	$pass   = $_POST['password'];
                
            	$hashedPass = sha1($pass);

        	  // Check If The User Exist In Database
              $stmt = $con->prepare("SELECT 
                                        Username, Password 
                                    FROM 
                                        users 
                                    WHERE 
                                        Username = ? 
                                    AND 
                                        Password = ?");

             $stmt->execute(array($user, $hashedPass));
             $row = $stmt->fetch();
             $count = $stmt->rowCount();

             // If Count > 0 This Mean The Database Contain Record About This Username

             if($count > 0){
                 $_SESSION['user'] = $user; // Register Session Name 
                 header('Location: index.php');  // Redirect To Index
                 exit(); 
             }


          }else {
                 
                $formErrors = array();

                $username  = $_POST['username'];
                $password  = $_POST['password'];
                $password2 = $_POST['password2'];
                $email     = $_POST['email'];

                if(isset($username)){

                    $filteredUser = filter_var($username ,FILTER_SANITIZE_STRING);
                    
                    if(strlen($filteredUser) < 4){

                         $formErrors[] = 'Username Must Be Larger Than 4 Characters ';
                    }
                }

                if(isset($password) && isset($password2)){

                    if(empty($password)){

                        $formErrors[] = 'Sorry Password Cant Be Empty';
                    }

                    if(sha1($password) !== sha1($password2)){

                        $formErrors[] = 'Sorry Password Is Not Match';

                    }


                }


                if(isset($email)){

                    $filterEmail = filter_var($email ,FILTER_SANITIZE_EMAIL);
                    
                   if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true){

                         $formErrors[] = 'This Email Is Not Valid';
                    }
                }


                //--- VALIDATION ---//
                
               // Check If There 's No Error The User Add
                
              if(empty($formErrors)){


                  // Check If User Exist in Database
                  $check = checkItem("Username", "users", $username);
                  
                  if($check == 1){

                    $formErrors[] = 'Sorry This User Is Exists';

                  }else{
                       
                      // Insert Userinfo In Database
                      $stmt = $con->prepare("INSERT INTO 
                                             users(Username, Password, Email,  RegStatus, Date)
                                             VALUES(:zuser, :zpass, :zmail, 0 , now())");
                      $stmt->execute(array(

                          'zuser' => $username,
                          'zpass' => sha1($password),
                          'zmail' => $email

                      ));

                         //  Echo Success Message
                         $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

                        // Echo Success Message

                         $succesMsg = 'Congrats You Are Now Registered User';


                  } // check user

             } // no errors

          }// login

    }// Post Request
?>

  <div class="container login-page">
  	<h1 class="text-center">
  		<span class="selected" data-class="login">Login</span> | 
  		<span data-class="signup">Signup</span>
  	</h1>
  	 <!-- Start Login Form -->
  	 <form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  	 	<div class="input-container">
  	 	<input 
  	 	      type="text"  
  	 	      name="username" 
  	 	      class="form-control" 
  	 	      autocomplete="off"
  	 	      placeholder="Type your username"
  	 	      required="required">
  	 	</div>
  	 	<div class="input-container">
  	 	<input 
  	 	      type="password" 
  	 	      name="password" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type your password">
  	 	</div>
  	 	<input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
  	 </form>
  	 <!-- End Login Form -->
  	 <!-- Start Signup Form-->
  	 <form class="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="input-container">
  	 	<input 
            pattern=".{4,}"
            title="Username Must Be 4 Chars" 
  	 	      type="text"  
  	 	      name="username" 
  	 	      class="form-control" 
  	 	      autocomplete="off"
  	 	      placeholder="Type your username">
      </div>
       <!--
       pattern=".{4,8}"
       title="Username Must Be 4 & 8 Chars"
       -->
      <div class="input-container">
  	 	<input 
            minlength="4" 
  	 	      type="password" 
  	 	      name="password" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type a Complex password">
      </div>
      <div class="input-container">
  	 	<input 
            minlength="4" 
  	 	      type="password" 
  	 	      name="password2" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type a password again">
      </div>
      <div class="input-container">
  	 	<input 
  	 	      type="text" 
  	 	      name="email" 
  	 	      class="form-control" 
  	 	      placeholder="Type a Valid email">
      </div>
  	 	<input type="submit" name="signup" class="btn btn-success btn-block" value="Signup">
  	 </form>
  	 <!-- End Signup Form-->
     <div class="the-errors text-center">
         <?php 
            if(!empty($formErrors)){
                foreach ($formErrors as $error) {   
                    echo '<div class="msg error">'. $error .'</div>';
                }
            }

            if(isset($succesMsg)){

              echo '<div class="msg success">'. $succesMsg .'</div>';
              
            }
         ?>
     </div>
  </div>
<?php

  include $tpl . 'footer.php';
  ob_end_flush();
?>