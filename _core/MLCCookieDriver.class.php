<?php
/**
 * This class is meant to handel all information associated with cookies
 * 
 */
class MLCCookieDriver{

    public static function SetCookie($strName, $strValue, $intExpire = null, $strPath = '/', $strDomain = null, $blnSecure = null, $blnHttponly = null){
        setcookie($strName, $strValue, $intExpire, $strPath, $strDomain, $blnSecure, $blnHttponly);		
        return true;
    }
    public static function GetCookie($strCookieName){
        if(array_key_exists($strCookieName, $_COOKIE)){
            return $_COOKIE[$strCookieName];
        }else{
            return null;
        }  
    }
     public static function RemoveCookie($strCookieName,  $strPath = null, $strDomain = null){
        if(array_key_exists($strCookieName, $_COOKIE)){
            setcookie($strCookieName, '', time()-3600,  $strPath, $strDomain);
            return true;
        }else{
            return null;
        }
    }


}

?>
