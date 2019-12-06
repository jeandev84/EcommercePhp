<?php 


/*
 ========================
 ==  Items Page
 ==  http://gregfranko.com/jquery.selectBoxIt.js/index.html
 ==  http://gregfranko.com/jquery.selectBoxIt.js/customDownload.html
 ==  http://jqueryui.com/download/
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
                        placeholder="Name of The Item">
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
                         placeholder="Description of The Item">
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
                         placeholder="Price of The Item">
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
                         placeholder="Country of Made">
               </div>
            </div>
            <!-- End Country Field -->

             <!-- Start Status Field -->
            <div class="form-group form-group-lg">
               <label class="col-sm-2 control-label">Status</label>
               <div class="col-sm-10 col-md-6">
                  <select  name="status">
                      <option value="0">...</option>
                      <option value="1">New</option>
                      <option value="2">Like New</option>
                      <option value="3">Used</option>
                      <option value="4">Very Old</option>
                  </select>
               </div>
            </div>
            <!-- End Status Field -->


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

          if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Insert Item</h1>";
                echo "<div class='container'>";
             
                // Get Variables From The Form

                $name     =  $_POST['name'];
                $desc     =  $_POST['description'];
                $price    =  $_POST['price'];
                $country  =  $_POST['country'];
                $status   =  $_POST['status'];



                // Validate The Form
                
                $formErrors = array();
                
                if(empty($name)){

                   $formErrors[] = 'Name Can\'t be <strong>Empty</strong>';
                }

                if(empty($desc)){

                   $formErrors[] = 'Description Can\'t be <strong>Empty</strong>';
                }


                if(empty($price)){

                   $formErrors[] = 'Price Can\'t be <strong>Empty</strong>';
                }

                if(empty($country)){

                   $formErrors[] = 'Country Can\'t be <strong>Empty</strong>';
                }

                if($status == 0){

                   $formErrors[] = 'You Must Choose the <strong>Status</strong>';
                }

                

                // Loop Into Errors Array And Echo It

                  foreach ($formErrors as $error) {
                   
                   echo '<div class="alert alert-danger">' . $error .'</div>';

                  }


                 // Check If There 's No Error Proceed The Update Operation'
                
                  if(empty($formErrors)){

                      // Insert Userinfo In Database
                      $stmt = $con->prepare("INSERT INTO 
                                             items(Name, Description, Price, Country_Made, Status, Add_Date)
                                             VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now())");
                      $stmt->execute(array(

                          'zname'    => $name,
                          'zdesc'    => $desc,
                          'zprice'   => $price,
                          'zcountry' => $country,
                          'zstatus'  => $status

                      ));

                      // // Echo Success Message
                      $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

                      redirectHome($theMsg, 'back');


                 } 

          }else{
            
             echo "<div class='container'>";

             $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

             redirectHome($theMsg);

             echo "</div>";

          }

          echo "</div>";
            

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
         
      
         
 