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

                if(isset($_POST['username'])){

                    $filteredUser = filter_var($_POST['username'] ,FILTER_SANITIZE_STRING);
                    
                    if(strlen($filteredUser) < 4){

                         $formErrors[] = 'Username Must Be Larger Than 4 Characters ';
                    }
                }

                if(isset($_POST['password']) && isset($_POST['password2'])){

                    $pass1 = sha1($_POST['password']); 
                    $pass2 = sha1($_POST['password2']);

                    if($pass1 !== $pass2){

                        $formErrors[] = 'Sorry Password Is Not Match';

                    }
                }
          }

    }
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
  	 	      type="text"  
  	 	      name="username" 
  	 	      class="form-control" 
  	 	      autocomplete="off"
  	 	      placeholder="Type your username">
      </div>
      <div class="input-container">
  	 	<input 
  	 	      type="password" 
  	 	      name="password" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type a Complex password">
      </div>
      <div class="input-container">
  	 	<input 
  	 	      type="password" 
  	 	      name="password2" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type a password again">
      </div>
      <div class="input-container">
  	 	<input 
  	 	      type="email" 
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
                    echo $error . '<br>';
                }
            }
         ?>
     </div>
  </div>
<?php

  include $tpl . 'footer.php';
  ob_end_flush();
?>