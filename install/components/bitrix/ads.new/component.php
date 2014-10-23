<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (!CModule::IncludeModule("ad")):
	ShowError(GetMessage("AD_MODULE_IS_NOT_INSTALLED"));
	return;
endif;

$arParams["HOW_MANY"] = intval($arParams["HOW_MANY"]);
if ($arParams["HOW_MANY"] < 0) $arParams["HOW_MANY"] = 0;

$arResult["arText"]=$arParams["HOW_MANY"]." -> ".$arParams["SHOW_DESCRIPTION"];


if (!function_exists('CreateAdTextStructure'))
{
	function CreateAdTextStructure()
	{
		$arReturn = array();

		$db_res = CAd::GetList(array("SORT" => "ASC"), array("ID" => 1));

		while($ar_res = $db_res->Fetch())
		{
	                $arItem["NAME"]=$ar_res['TITLE'];
	                $arItem["LINK"]=$ar_res['URL'];
	                $arItem["DESCRIPTION"]=$ar_res['DESCRIPTION'];
			$arReturn[] = $arItem;
		}

		return $arReturn;
	}
}

$arResult["arText"] = CreateAdTextStructure();

$this->IncludeComponentTemplate();
?>