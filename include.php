<?
global $DB, $MESS, $APPLICATION;

require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/classes/".strtolower($DB->type)."/ad.php");

IncludeModuleLangFile(__FILE__);

if (!defined("AD_CACHE_TIME"))
	define("AD_CACHE_TIME", 3600);

?>