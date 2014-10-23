<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("ad"))
	return;

$arComponentParameters = array(
	"GROUPS" => array(
		"AD_NEW_PARAMS" => array(
			"NAME" => GetMessage("AD_NEW_PARAMS_NAME"),
		),
	),
	
	"PARAMETERS" => array(
		"HOW_MANY" => array(
			"NAME" => GetMessage("AD_HOW_MANY_NAME"), 
			"TYPE" => "INTEGER",
			"DEFAULT" => "3",
			"PARENT" => "AD_NEW_PARAMS",
		),

		"SHOW_DESCRIPTION" => array(
			"NAME" => GetMessage("AD_SHOW_DESCRIPTION_NAME"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "N",	
			"PARENT" => "AD_NEW_PARAMS",
		),
		
		"SET_TITLE" => array(),
		"CACHE_TIME" => array("DEFAULT" => "3600"),
	),
);


?>