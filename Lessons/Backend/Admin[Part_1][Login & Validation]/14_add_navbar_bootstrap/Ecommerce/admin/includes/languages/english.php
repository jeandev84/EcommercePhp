<?php 

function lang( $phrase ){

   static $lang = array(

        // Dashboard Page

   	      'HOME_ADMIN' => 'Home',
   	      'CATEGORIES' => 'Categories',
   	      '' => '',
   	      '' => '',
   	      '' => '',
   	      '' => '',

   );

   return $lang[$phrase];

}



