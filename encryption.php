<?php
 function EncryptURLData($Code){
    $CombinedURL = "";
     for ($i=0; $i < 5; $i++) { 
        $CombinedURL  = md5($CombinedURL)."&".$Code[$i];
        $EncryptedURL = md5($CombinedURL);
     }
    return $EncryptedURL;
 }
?>