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

//$arResult["arText"] = CreateAdTextStructure();

//$this->IncludeComponentTemplate();

if (!CModule::IncludeModule("iblock")):
	ShowError(GetMessage("AD_MODULE_IS_NOT_INSTALLED"));
	return;
endif;


$res = CIBlock::GetList(
	Array(), 
	Array(
		'TYPE'=>'AdiBlockType',
		'NAME'=>'AdiBlock'
	), true
);

while($ar_res = $res->Fetch())
{
//	echo $ar_res['ID']."<-ID ".$ar_res['NAME'].': '.$ar_res['ELEMENT_CNT']."<br>";
	$adiblockID=$ar_res['ID'];
//	echo "AdiBlock code = <b>$adiblockID</b><br>";
}

////////////////////

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>$adiblockID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

$arReturn = array();

	while($ob = $res->GetNextElement())
	{ 
		$arFields = $ob->GetFields();  
		$arProps = $ob->GetProperties();

                $arItem["NAME"]=$arFields['NAME'];
                $arItem["LINK"]="ad".$arFields['ID'];
                $arItem["DESCRIPTION"]=$arProps['DESCRIPTION']['VALUE'];
                $arItem["PHONE"]=$arProps['PHONE']['VALUE'];

		$arReturn[] = $arItem;

		//echo "Name is ".$arFields['NAME']."<br>";
		//echo "Description is ".$arProps['DESCRIPTION']['VALUE']."<br>";
		//echo "Phone is ".$arProps['PHONE']['VALUE']."<br>";
	}

$arResult["arText"] = $arReturn;

$this->IncludeComponentTemplate();


//////////

$el = new CIBlockElement;

$PROP = array();
$PROP["NAME"] = "Test ".mt_rand(100,999);
$PROP["DESCRIPTION"] = "Test description ".mt_rand(100,999);
$PROP["PHONE"] = mt_rand(1000000,9999999);

$arLoadProductArray = Array(
	"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
	"IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	"IBLOCK_ID"      => $adiblockID,
	"PROPERTY_VALUES"=> $PROP,
	"NAME"           => $PROP["NAME"],
	"ACTIVE"         => "Y",            // активен
	"PREVIEW_TEXT"   => "текст для списка элементов",
	"DETAIL_TEXT"    => "текст для детального просмотра",
	"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
	);

if($PRODUCT_ID = $el->Add($arLoadProductArray))
	echo "New ID: ".$PRODUCT_ID;
else
	echo "Error: ".$el->LAST_ERROR;

?>