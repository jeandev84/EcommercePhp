<?php 


/*
 ===================================
 ==  Categroy Page
 ==  http://localhost:8000/categories.php?do=Add/..
 ===================================
*/

ob_start(); // Output Buffering Start

session_start(); 
 
$pageTitle = 'Categories';


if(isset($_SESSION['Username'])){
	  
      include 'init.php';
       
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
       
      if($do == 'Manage'){

          echo 'Welcome';


      }elseif($do == 'Add'){ ?>
              
         <h1 class="text-center">Add New Category</h1> 
         <div class="container">
         <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- Start Name Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Name</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Name of The Category" required="required">
               </div>
            </div>
             <!-- End Name Field -->

            <!-- Start Description Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Description</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="description" class="form-control" placeholder="Describe The Category">
               </div>
            </div>
            <!-- End Description Field -->

            <!-- Start Ordering Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Ordering</label>
               <div class="col-sm-10 col-md-6">
                  <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories">
               </div>
            </div>
            <!-- End Ordering Field -->

            <!-- Start Visibility Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Visible</label>
               <div class="col-sm-10 col-md-6">
                  <div>
                  	 <input id="vis-yes" type="radio" name="visibility" value="0" checked>
                  	 <label for="vis-yes">Yes</label>
                  </div>
                  <div>
                  	 <input id="vis-no" type="radio" name="visibility" value="1">
                  	 <label for="vis-no">No</label>
                  </div>
               </div>
            </div>
            <!-- End Visibility  Field -->

            <!-- Start Commenting Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Allow Commenting</label>
               <div class="col-sm-10 col-md-6">
                  <div>
                  	 <input id="com-yes" type="radio" name="commenting" value="0" checked>
                  	 <label for="com-yes">Yes</label>
                  </div>
                  <div>
                  	 <input id="com-no" type="radio" name="commenting" value="1">
                  	 <label for="com-no">No</label>
                  </div>
               </div>
            </div>
            <!-- End Commenting Field -->
            
            <!-- Start Ads Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Allow Ads</label>
               <div class="col-sm-10 col-md-6">
                  <div>
                  	 <input id="ads-yes" type="radio" name="ads" value="0" checked>
                  	 <label for="ads-yes">Yes</label>
                  </div>
                  <div>
                  	 <input id="ads-no" type="radio" name="ads" value="1">
                  	 <label for="ads-no">No</label>
                  </div>
               </div>
            </div>
            <!-- End Ads Field -->

            <!-- Start Submit Field -->
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Add Category" class="btn btn-primary">
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


      }


      include $tpl . 'footer.php';

}else{

    header('Location:index.php');

    exit();

}

ob_end_flush(); // Release The Output
         
      
         
 

