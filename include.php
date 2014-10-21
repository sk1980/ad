<?
global $DB, $MESS, $APPLICATION;

require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin_tools.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/filter_tools.php");
IncludeModuleLangFile(__FILE__);

if (!defined("AD_CACHE_TIME"))
	define("AD_CACHE_TIME", 3600);

?>