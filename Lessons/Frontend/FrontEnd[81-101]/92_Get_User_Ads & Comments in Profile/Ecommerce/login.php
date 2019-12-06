<?php 
  session_start(); 
  $pageTitle = 'Login';

  if(isset($_SESSION['user'])){
		header('Location: index.php'); 
  }

  include 'init.php';

  // Check If User Coming From HTTP Post Request
  if($_SERVER['REQUEST_METHOD'] == 'POST'){

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
  	 	<input type="submit" class="btn btn-primary btn-block" value="Login">
  	 </form>
  	 <!-- End Login Form -->
  	 <!-- Start Signup Form-->
  	 <form class="signup">
  	 	<input 
  	 	      type="text"  
  	 	      name="username" 
  	 	      class="form-control" 
  	 	      autocomplete="off"
  	 	      placeholder="Type your username">
  	 	<input 
  	 	      type="password" 
  	 	      name="password" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type a Complex password">
  	 	<input 
  	 	      type="password" 
  	 	      name="password2" 
  	 	      class="form-control" 
  	 	      autocomplete="new-password"
  	 	      placeholder="Type a password again">
  	 	<input 
  	 	      type="email" 
  	 	      name="email" 
  	 	      class="form-control" 
  	 	      placeholder="Type a Valid email">
  	 	<input type="submit" class="btn btn-success btn-block" value="Signup">
  	 </form>
  	 <!-- End Signup Form-->
  </div>
<?php 
  include $tpl . 'footer.php';
?>