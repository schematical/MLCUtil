<?php
/* 
 * This class manages the relivant asset locations
 */
class MLCAssetDriver{
    const FILEINFO_BASENAME = 'basename';
    public static function LocateTemplate($strFileName){
        $arrPathInfo = pathinfo($strFileName);
        if(strpos($strFileName, '.class') !== false){
            $strFileName = str_replace(".class.php", ".tpl.php", $arrPathInfo[self::FILEINFO_BASENAME]);
        }else{
            $strFileName = str_replace(".php", ".tpl.php", $arrPathInfo[self::FILEINFO_BASENAME]);
        }
        $strAssetFile = $arrPathInfo['dirname'] . __REL_TPL_DIR__ . "/". $strFileName;
        return $strAssetFile;
    }
    public static function GetBaseName($strFileName){
        $arrPathInfo = pathinfo($strFileName);
        return $arrPathInfo[self::FILEINFO_BASENAME];
    }
    public static function ClassNameToTplName($strFileName){
        return str_replace(".class.php", ".tpl.php", self::GetBaseName($strFileName));
    }
    public static function EvaluateTemplate($strTemplateLoc, $arrVars){
        foreach($arrVars as $strKey=>$strValue){
            $strKey = $strValue;
        }

        if ($strTemplateLoc) {
				QApplication::$ProcessOutput = false;
				// Store the Output Buffer locally
				$strAlreadyRendered = ob_get_contents();
				ob_clean();

				// Evaluate the new template
				ob_start('__QForm_EvaluateTemplate_ObHandler');
					require($strTemplateLoc);
					$strTemplateEvaluated = ob_get_contents();
				ob_end_clean();

				// Restore the output buffer and return evaluated template
				print($strAlreadyRendered);
				QApplication::$ProcessOutput = true;

				return $strTemplateEvaluated;
			}else{
				return null;
            }

        
    }
    
}
?>
