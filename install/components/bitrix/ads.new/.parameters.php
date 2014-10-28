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

		"SEF_MODE" => Array(
			"index" => array(
				"NAME" => GetMessage("INDEX_PAGE"),
				"DEFAULT" => "index.php",
				"VARIABLES" => array()),
			"section" => array(
				"NAME" => GetMessage("SECTION_PAGE"),
				"DEFAULT" => "#SECTION_ID#/",
				"VARIABLES" => array("SECTION_ID")),
			"section_edit" => array(
				"NAME" => GetMessage("SECTION_EDIT_PAGE"),
				"DEFAULT" => "#SECTION_ID#/action/#ACTION#/",
				"VARIABLES" => array("SECTION_ID", "ACTION")),
			"section_edit_icon" => array(
				"NAME" => GetMessage("SECTION_EDIT_ICON_PAGE"),
				"DEFAULT" => "#SECTION_ID#/icon/action/#ACTION#/",
				"VARIABLES" => array("SECTION_ID", "ACTION")),
			"upload" => array(
				"NAME" => GetMessage("UPLOAD_PAGE"),
				"DEFAULT" => "#SECTION_ID#/action/upload/",
				"VARIABLES" => array("SECTION_ID")),
			"detail" => array(
				"NAME" => GetMessage("DETAIL_PAGE"),
				"DEFAULT" => "#SECTION_ID#/#ELEMENT_ID#/",
				"VARIABLES" => array("ELEMENT_ID", "SECTION_ID")),
			"detail_edit" => array(
				"NAME" => GetMessage("DETAIL_EDIT_PAGE"),
				"DEFAULT" => "#SECTION_ID#/#ELEMENT_ID#/action/#ACTION#/",
				"VARIABLES" => array("ELEMENT_ID", "SECTION_ID")),
			"detail_list" => array(
				"NAME" => GetMessage("DETAIL_LIST_PAGE"),
				"DEFAULT" => "list/",
				"VARIABLES" => array())
			),

		
		"SET_TITLE" => array(),
		"CACHE_TIME" => array("DEFAULT" => "3600"),
	),
);


?>