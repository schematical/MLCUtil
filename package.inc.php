<?php
define('__MLC_UTIL__', dirname(__FILE__));
if(!defined('__MLC_DB_MANAGER__')){
	MLCApplication::InitPackage('MLCDBManager');
}
define('__MLC_UTIL_CORE__', __MLC_UTIL__ . '/_core');
define('__MLC_UTIL_CORE_CTL__', __MLC_UTIL_CORE__ . '/ctl');
define('__MLC_UTIL_CORE_MODEL__', __MLC_UTIL_CORE__ . '/model');
define('__MLC_UTIL_CORE_VIEW__', __MLC_UTIL_CORE__ . '/view');
MLCApplicationBase::$arrClassFiles['MLCCookieDriver'] = __MLC_UTIL_CORE__ . '/MLCCookieDriver.class.php';
MLCApplicationBase::$arrClassFiles['MLCAssetDriver'] = __MLC_UTIL_CORE__ . '/MLCAssetDriver.class.php';


require_once(__MLC_UTIL_CORE__ . '/_enum.inc.php');
require_once(__MLC_UTIL_CORE__ . '/_exception.inc.php');
