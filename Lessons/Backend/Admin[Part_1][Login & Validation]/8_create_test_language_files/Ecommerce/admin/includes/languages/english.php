<?php 

function lang( $phrase ){

   static $lang = array(

        // Homepage
        'MESSAGE' => 'Welcome',
        'ADMIN'   => 'Administrator'

        // Settings

   );

   return $lang[$phrase];

}



/*

$lang = array(

    'Osama' => 'Zero'


);

echo $lang['Osama'];

*/