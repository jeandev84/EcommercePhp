<?php 


/*
 ========================
 ==  Items Page
 ========================
*/

ob_start(); // Output Buffering Start

session_start(); 
 
$pageTitle = 'Items';


if(isset($_SESSION['Username'])){
	  
      include 'init.php';
       
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


      if($do == 'Manage'){ 

         echo 'Welcome to items page';

      }elseif($do == 'Add'){  ?>

       <h1 class="text-center">Add New Item</h1> 
         <div class="container">
         <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- Start Name Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Name</label>
               <div class="col-sm-10 col-md-6">
                  <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        placeholder="Name of The Item" 
                        required="required">
               </div>
            </div>
             <!-- End Name Field -->

            <!-- Start Description Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Description</label>
               <div class="col-sm-10 col-md-6">
                  <input 
                         type="text" 
                         name="description" 
                         class="form-control" 
                         placeholder="Description of The Item"
                         required="required">
               </div>
            </div>
            <!-- End Description Field -->

            <!-- Start Price Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Price</label>
               <div class="col-sm-10 col-md-6">
                  <input 
                         type="text" 
                         name="price" 
                         class="form-control" 
                         placeholder="Price of The Item"
                         required="required">
               </div>
            </div>
            <!-- End Price Field -->

             <!-- Start Country Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Country</label>
               <div class="col-sm-10 col-md-6">
                  <input 
                         type="text" 
                         name="country" 
                         class="form-control" 
                         placeholder="Country of Made"
                         required="required">
               </div>
            </div>
            <!-- End Country Field -->

             <!-- Start Status Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Status</label>
               <div class="col-sm-10 col-md-6">
                  <select class="form-control" name="status">
                      <option value="0">...</option>
                      <option value="1">New</option>
                      <option value="2">Like New</option>
                      <option value="3">Used</option>
                      <option value="4">Very Old</option>
                  </select>
               </div>
            </div>
            <!-- End Status Field -->

              <!-- Start Rating Field -->
           <!--  <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Rating</label>
               <div class="col-sm-10 col-md-6">
                  <select class="form-control" name="rating">
                      <option value="0">...</option>
                      <option value="1">*</option>
                      <option value="2">**</option>
                      <option value="3">***</option>
                      <option value="4">****</option>
                      <option value="5">*****</option>
                  </select>
               </div>
            </div> -->
            <!-- End Rating Field -->


            <!-- Start Submit Field -->
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
               </div>
            </div>
            <!-- End Submit Field -->
           
         </form>
         </div>

      <?php 

      }elseif($do == 'Insert'){

            

      }elseif($do == 'Edit'){
        


      }elseif($do == 'Update'){

            

      }elseif($do == 'Delete'){


      }elseif($do == 'Approve'){

           
      }

      include $tpl . 'footer.php';

}else{

    header('Location:index.php');

    exit();

}

ob_end_flush(); // Release The Output
         
      
         
 