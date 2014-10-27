<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (!CModule::IncludeModule("ad")):
	ShowError(GetMessage("AD_MODULE_IS_NOT_INSTALLED"));
	return;
endif;

$arParams["SEF_MODE"] = "Y";
$arParams["SEF_FOLDER"] = "/ads/";

$arDefaultUrlTemplatesSEF = array(
"list" => "index.php",
"ads" => "index.php?ELEMENT_ID=#ELEMENT_ID#",
"section" => "section.php?IBLOCK_ID=#IBLOCK_ID#&SECTION_ID=#SECTION_ID#",
"element" => "element.php?ELEMENT_ID=#ELEMENT_ID#"
);

$arParams["HOW_MANY"] = intval($arParams["HOW_MANY"]);
if ($arParams["HOW_MANY"] < 0) $arParams["HOW_MANY"] = 0;

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
$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array("nPageSize"=>$arParams["HOW_MANY"]), $arSelect);

$arReturn = array();

	while($ob = $res->GetNextElement())
	{ 
		$arFields = $ob->GetFields();  
		$arProps = $ob->GetProperties();
		$descrID=$arProps['DESCRIPTION']['ID'];
		$phoneID=$arProps['PHONE']['ID'];

                $arItem["NAME"]=$arFields['NAME'];
                $arItem["LINK"]="/ads/".$arFields['ID'];
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

$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form","",Array(
     "SEF_MODE" => "Y",
     "IBLOCK_TYPE" => "AdiBlockType",
     "IBLOCK_ID" => $adiblockID,
     "PROPERTY_CODES" => Array("NAME","IBLOCK_SECTION",$descrID,$phoneID),
     "PROPERTY_CODES_REQUIRED" => Array("NAME",$descrID,$phoneID),
     "GROUPS" => Array("11"),
     "STATUS_NEW" => "N",
     "STATUS" => "ANY",
     "LIST_URL" => "",
     "ELEMENT_ASSOC" => "CREATED_BY",
     "MAX_USER_ENTRIES" => "100000",
     "MAX_LEVELS" => "100000",
     "LEVEL_LAST" => "Y",
     "USE_CAPTCHA" => "Y",
     "USER_MESSAGE_EDIT" => "",
     "USER_MESSAGE_ADD" => "",
     "DEFAULT_INPUT_SIZE" => "30",
     "MAX_FILE_SIZE" => "0",
     "CUSTOM_TITLE_NAME" => GetMessage("AD_ADD_TITLE"),
     "CUSTOM_TITLE_TAGS" => "",
     "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
     "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
     "CUSTOM_TITLE_IBLOCK_SECTION" => GetMessage("AD_ADD_THEME"),
     "CUSTOM_TITLE_PREVIEW_TEXT" => "",
     "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
     "CUSTOM_TITLE_DETAIL_TEXT" => "",
     "CUSTOM_TITLE_DETAIL_PICTURE" => "",
     "SEF_FOLDER" => "/ads/",
     "VARIABLE_ALIASES" => Array()
     )
);

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

//if($PRODUCT_ID = $el->Add($arLoadProductArray))
//	echo "New ID: ".$PRODUCT_ID;
//else
//	echo "Error: ".$el->LAST_ERROR;

?>