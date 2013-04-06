<?php
/**
 * used to enumerate QApplication Javascript calls to the MLC/MLC.js file
 */
abstract class MLCJSDriver{

    /**
     * Allows you to load files out side of the applications asset library
     * @param <String> $strScript the url to the script to be loaded
     * @param <String> $strCallback the function name to be called back on load
     */
  public static function LoadJS($strScript, $strCallback = null){
        if(is_null($strCallback)){
            $strCallback = 'null';
        }else{
            $strCallback = sprintf('%s', $strCallback);
        }
        QApplication::ExecuteJavaScript('MLC.loadJavaScriptFile("' . $strScript . '", ' . $strCallback . ');');
  }

  public static function OpenNewWindow($strUrl, $strTitle = '', $strAttributes = ''){
      QApplication::ExecuteJavaScript(
          sprintf(
            "window.open('%s','%s','%s')",
             $strUrl,
             $strTitle,
             $strAttributes
         )
      );
  }
    
}