<?php 

 /*
   Categories => [ Manage | Edit | Update | Add | Insert | Delete | Statistics ]

   Condition ? True : False

 */

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


// If The Page is Main Page

if($do == 'Manage'){

	echo 'Welcome You Are In Manage Category Page';
	echo '<a href="page.php?do=Add">Add New Category +</a>';

}elseif($do == 'Add'){

    echo 'Welcome You Are In Add Category Page';

}elseif($do == 'Insert'){

	echo 'Welcome You Are In Insert Category Page';

}else{

	echo 'Error There\'s No Page With this Name';
}

