
<?php
 function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
    |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);
 }
 function isDeskTop() {
    return preg_match("/(windows|linux|mac)/i ", $_SERVER["HTTP_USER_AGENT"]);
 }
   function DeviceCheck(){
       $Device = '';
        if(isMobileDevice()){
            $Device = "Mobile";
        }
        if(isDeskTop()){
            $Device = "Desktop";
        }
        else {
            $Device = "UnKnown";
        }
        return $Device ;
   }
   function Ip_Address(){
            $clientIP = $_SERVER['HTTP_CLIENT_IP'] 
            ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
            ?? $_SERVER['HTTP_X_FORWARDED'] 
            ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
            ?? $_SERVER['HTTP_FORWARDED'] 
            ?? $_SERVER['HTTP_FORWARDED_FOR'] 
            ?? $_SERVER['REMOTE_ADDR'] 
            ?? '0.0.0.0';

        # Earlier than PHP7
        $clientIP = '0.0.0.0';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $clientIP = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            # when behind cloudflare
            $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP']; 
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $clientIP = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $clientIP = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $clientIP = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $clientIP = $_SERVER['REMOTE_ADDR'];
        }

        return $clientIP;
   }
   @$localIP = getHostByName(getHostName()); 
   @$Device_name = gethostbyaddr($localIP);
?>