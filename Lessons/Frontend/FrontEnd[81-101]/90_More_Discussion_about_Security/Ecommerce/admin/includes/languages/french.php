<?php 

function lang( $phrase ){

   static $lang = array(
        
        'MESSAGE' => 'Bienvenue',
        'ADMIN'   => 'Administrateur'

   );

   return $lang[$phrase];

}



