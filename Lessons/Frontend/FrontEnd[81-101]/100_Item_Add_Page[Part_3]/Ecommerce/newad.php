<?php 
  
  ob_start();

  session_start();

  $pageTitle = 'Create New Item';

  include  'init.php';
  
  if(isset($_SESSION['user'])){

  	if($_SERVER['REQUEST_METHOD'] == 'POST'){

  		$formErrors = array();
        
        $name      =  filter_var($_POST['name'], 
        	FILTER_SANITIZE_STRING);
        $desc      =  filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $price     =  filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT); // ou FILTER_SANITIZE_NUMBER_FLOAT
        $country   =  filter_var($_POST['country'], FILTER_SANITIZE_STRING);
        $status    =  filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
        $category  =  filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);

       if(strlen($name) < 4){
        
           $formErrors[] = 'Item Title Must Be At Least 4 Characters';

       }

       if(strlen($desc) < 10){
        
           $formErrors[] = 'Item Description Must Be At Least 10 Characters';

       }

       if(strlen($country) < 2){
        
           $formErrors[] = 'Item Country Must Be At Least 2 Characters';

       }

       if(empty($price)){
        
           $formErrors[] = 'Item Price Must Be empty';

       }

       if(empty($status)){
        
           $formErrors[] = 'Item Status Must Be empty';

       }

       if(empty($category)){
        
           $formErrors[] = 'Item Category Must Be empty';

       }

  	}

?>

<h1 class="text-center"><?php echo $pageTitle; ?></h1>

<div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary"><!-- ou panel-default-->
			<div class="panel-heading"><?php echo $pageTitle; ?></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8"> 
				      <form class="form-horizontal main-form" 
				            action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				            <!-- Start Name Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-3 control-label">Name</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                        type="text" 
				                        name="name" 
				                        required="required" 
				                        class="form-control live" 
				                        placeholder="Name of The Item"
				                        data-class=".live-title">
				               </div>
				            </div>
				             <!-- End Name Field -->

				            <!-- Start Description Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-3 control-label">Description</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                         type="text" 
				                         name="description" 
				                         required="required" 
				                         class="form-control live" 
				                         placeholder="Description of The Item"
				                         data-class=".live-desc">
				               </div>
				            </div>
				            <!-- End Description Field -->

				            <!-- Start Price Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-3 control-label">Price</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                         type="text" 
				                         name="price"
				                         required="required"  
				                         class="form-control live"
				                         placeholder="Price of The Item" data-class=".live-price">
				               </div>
				            </div>
				            <!-- End Price Field -->

				             <!-- Start Country Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-3 control-label">Country</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                         type="text" 
				                         name="country"
				                         required="required"  
				                         class="form-control" 
				                         placeholder="Country of Made">
				               </div>
				            </div>
				            <!-- End Country Field -->

				             <!-- Start Status Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-3 control-label">Status</label>
				               <div class="col-sm-10 col-md-9">
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

				             <!-- Start Categories Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-3 control-label">Category</label>
				               <div class="col-sm-10 col-md-9">
				                  <select  name="category">
				                      <option value="0">...</option>
				                      <?php

				                         $stmt2 = $con->prepare("SELECT * FROM categories");
				                         $stmt2->execute();
				                         $cats = $stmt2->fetchAll();

				                         foreach ($cats as $cat) {
				                           
				                            echo "<option value='". $cat['ID'] ."'>". $cat['Name'] ."</option>";
				                         }

				                      ?>
				                  </select>
				               </div>
				            </div>
				            <!-- End Categories Field -->

				            <!-- Start Submit Field -->
				            <div class="form-group">
				               <div class="col-sm-offset-3 col-sm-9">
				                  <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
				               </div>
				            </div>
				            <!-- End Submit Field -->
				         </form>
					</div><!-- col-md-8 end -->
					<div class="col-md-4">
					  <div class="thumbnail item-box live-preview">
		     	       <span class="price-tag">
		     	            $<span class="live-price">0</span>
		     	       </span>
		     	        <img class="img-responsive" src="img.png" alt="">
		     	          <div class="caption">
                             <h3 class="live-title">Title</h3>
                             <p class="live-desc">Description</p>
		     	          </div>
		     	      </div>
					</div>
				</div>
				<!-- Start Looping Through Errors -->
                  <?php 
                     if(! empty($formErrors)){
                     	foreach ($formErrors as $error) {
                     		echo '<div class="alert alert-danger">'
                     		         . $error .
                     		     '</div>';
                     	}
                     }
                  ?>
				<!-- End Looping Through Errors -->
			</div>
		</div>
	</div>
</div>

<?php 

  }else{

     header('Location: login.php');
     exit();

  }

  include $tpl. 'footer.php'; 
  ob_end_flush();
?>