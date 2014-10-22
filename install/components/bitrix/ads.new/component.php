<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (!CModule::IncludeModule("ad")):
	ShowError(GetMessage("AD_MODULE_IS_NOT_INSTALLED"));
	return;
endif;

$this->IncludeComponentTemplate();
?>