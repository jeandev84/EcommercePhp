<?php 
  include 'init.php';
?>

  <div class="container login-page">
  	<h1 class="text-center">
  		<span class="selected" data-class="login">Login</span> | 
  		<span data-class="signup">Signup</span>
  	</h1>
  	 <form class="login">
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
  </div>
<?php 
  include $tpl . 'footer.php';
?>