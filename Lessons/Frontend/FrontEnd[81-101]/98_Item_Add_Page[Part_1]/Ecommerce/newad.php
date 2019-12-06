<?php 
  
  ob_start();

  session_start();

  $pageTitle = 'Create New Ad';

  include  'init.php';
  
  if(isset($_SESSION['user'])){

?>

<h1 class="text-center">Create New Ad</h1>

<div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary"><!-- ou panel-default-->
			<div class="panel-heading">Create New Ad</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8"> 
				      <form class="form-horizontal" 
				            action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				            <!-- Start Name Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-2 control-label">Name</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                        type="text" 
				                        name="name" 
				                        required="required" 
				                        class="form-control live-name" 
				                        placeholder="Name of The Item">
				               </div>
				            </div>
				             <!-- End Name Field -->

				            <!-- Start Description Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-2 control-label">Description</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                         type="text" 
				                         name="description" 
				                         required="required" 
				                         class="form-control live-desc" 
				                         placeholder="Description of The Item">
				               </div>
				            </div>
				            <!-- End Description Field -->

				            <!-- Start Price Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-2 control-label">Price</label>
				               <div class="col-sm-10 col-md-9">
				                  <input 
				                         type="text" 
				                         name="price"
				                         required="required"  
				                         class="form-control live-price" 
				                         placeholder="Price of The Item">
				               </div>
				            </div>
				            <!-- End Price Field -->

				             <!-- Start Country Field -->
				            <div class="form-group form-group-lg">
				               <label class="col-sm-2 control-label">Country</label>
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
				               <label class="col-sm-2 control-label">Status</label>
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
				               <label class="col-sm-2 control-label">Category</label>
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
				               <div class="col-sm-offset-2 col-sm-9">
				                  <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
				               </div>
				            </div>
				            <!-- End Submit Field -->
				         </form>
					</div><!-- col-md-8 end -->
					<div class="col-md-4">
					  <div class="thumbnail item-box live-preview">
		     	       <span class="price-tag">$0</span>
		     	        <img class="img-responsive" src="img.png" alt="">
		     	          <div class="caption">
                             <h3>Title</h3>
                             <p>Description</p>
		     	          </div>
		     	      </div>
					</div>
				</div>
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