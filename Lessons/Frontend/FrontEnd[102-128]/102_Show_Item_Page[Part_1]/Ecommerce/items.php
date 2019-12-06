<?php 
  ob_start();
  session_start();
  $pageTitle = 'Show Items';
  include  'init.php';
  
  // http://localhost:8000/items.php?itemid=1,2,3, ..etc

  // Check If Get Request item Is Numeric & Get The Integer Value Of It
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0; 

  // Select All Data Depend On This ID ()
  $stmt = $con->prepare("SELECT * 
                         FROM items 
                         WHERE Item_ID = ?");
  
  
  // Execute Query
  $stmt->execute(array($itemid));

  // Fetch The Data
  $item = $stmt->fetch();


  
?>

<h1 class="text-center"><?php echo $item['Name']; ?></h1>



<?php 

  include $tpl. 'footer.php'; 
  ob_end_flush();

?>