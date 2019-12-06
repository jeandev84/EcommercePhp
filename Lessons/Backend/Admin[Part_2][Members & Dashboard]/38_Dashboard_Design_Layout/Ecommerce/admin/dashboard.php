<?php 
    
session_start(); 
 
 
if(isset($_SESSION['Username'])){
	
	  $pageTitle = 'Dashboard';

      include 'init.php';
      
      
      /* Start Dashboard Page */
       
      ?>
     
    <div class="home-stats">
       <div class="container text-center">
         <h1>Dashboard</h1>
         <div class="row">
               <div class="col-md-3">
                     <div class="stat">
                       Total Members
                       <span>200</span>
                    </div>
               </div>
                <div class="col-md-3">
                     <div class="stat">
                        Pending Members
                        <span>25</span>
                     </div>
               </div>
                <div class="col-md-3">
                     <div class="stat">
                         Total Items
                         <span>1500</span>
                     </div>
               </div>
                <div class="col-md-3">
                     <div class="stat">
                         Total Comments
                         <span>3500</span>
                     </div>
               </div>
         </div>
     </div>
     </div>

     <div class="latest">
       <div class="container">
           <div class="row">
                <div class="col-sm-6">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                           <i class="fa fa-users"></i> Latest Registred Users   
                      </div>
                      <div class="panel-body">
                          Test
                      </div>
                   </div>    
                </div>
                <div class="col-sm-6">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                           <i class="fa fa-tag"></i> Latest Items   
                      </div>
                      <div class="panel-body">
                          Test
                      </div>
                   </div>    
                </div>
           </div>
       </div>
     </div>
     <?php 

      /* End Dashboard Page */

      include $tpl. 'footer.php'; 

}else{

	// echo 'You Are Not Authorized To View This Page';

	header('Location: index.php');
	exit();

}
