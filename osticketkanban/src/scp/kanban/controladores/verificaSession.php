<?php
    $here = dirname(getcwd(), 2);
    
    define('ROOT_DIR',str_replace('\\', '/', realpath($here).'/'));    
    unset($here);  

   
    define('INCLUDE_DIR', ROOT_DIR . 'include/');
    
    require(INCLUDE_DIR.'/staff/staff.inc.php');
    
    
    if($thisstaff->isAdmin() && !defined('ADMINPAGE')) {
        echo 'é admin';
    }else{
        echo '404';
    }
?>