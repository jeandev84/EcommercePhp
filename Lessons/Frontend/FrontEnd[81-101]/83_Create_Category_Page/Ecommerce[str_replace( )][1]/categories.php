<?php 

      include  'init.php';

      echo 'Welcome To Categories Page <br>';
      echo 'Your Page ID is ' . $_GET['pageid'] .'<br>';
      echo 'Your Page Name is ' . str_replace('-', ' ', $_GET['pagename']);

      include $tpl. 'footer.php'; 

?>