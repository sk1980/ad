<?if(!check_bitrix_sessid()) return;?>

<?
	if(!check_bitrix_sessid() || !CModule::IncludeModule("iblock")) 
		return;
		
	$strWarning = "";
	$bVarsFromForm = false;
	$arUGroupsEx = Array();
	$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
	while($arUGroups = $dbUGroups -> Fetch())
	{
		if ($arUGroups["ANONYMOUS"] == "Y")
		$arUGroupsEx[$arUGroups["ID"]] = "R";
	}
	

	if ($GLOBALS["APPLICATION"]->GetGroupRight("iblock") >= "W")
	{
		$arIBTLang = array();
		$arLang = array();
		$l = CLanguage::GetList($lby="sort", $lorder="asc");
		while($ar = $l->ExtractFields("l_"))
			$arIBTLang[]=$ar;
			
		for($i=0; $i<count($arIBTLang); $i++)
			$arLang[$arIBTLang[$i]["LID"]] = array("NAME" => "AdiBlockType");
			
		$arFields = array(
			"ID" => "AdiBlockType",
			"LANG" => $arLang,
			"SECTIONS" => "Y");

			$GLOBALS["DB"]->StartTransaction();
			$obBlocktype = new CIBlockType;
			$IBLOCK_TYPE_ID = $obBlocktype->Add($arFields);
			if (strLen($IBLOCK_TYPE_ID) <= 0)
			{
				$strWarning .= $obBlocktype->LAST_ERROR;
				$GLOBALS["DB"]->Rollback();
				$bVarsFromForm = true;
			}
			else
			{
				$GLOBALS["DB"]->Commit();
				$_REQUEST["create_iblock_type"] = "N";
				$_REQUEST["iblock_type_name"] = "";
				$_REQUEST["iblock_type_id"] = $IBLOCK_TYPE_ID;
			}
		
	$IBLOCK_TYPE_ID = "AdiBlockType";

$res = CIBlock::GetList(
	Array(), 
	Array(
		'TYPE'=>'AdiBlockType',
		'NAME'=>'AdiBlock'
	), true
);

//while($ar_res = $res->Fetch())
//{
//	 echo $ar_res['ID']."<-ID ".$ar_res['NAME'].': '.$ar_res['ELEMENT_CNT']."<br>";
//}
//echo $res->SelectedRowsCount()."<br>";
		
if ($res->SelectedRowsCount()<1) echo ImportXMLFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/install/load_xml/ad.xml","AdiBlockType",false,"D", "D", true, true, false, true); 

	}
	
?>

<?
	RegisterModule("ad");
	CModule::IncludeModule("ad");
	COption::SetOptionString("ad", "AD_DIR", "");

if($ex = $APPLICATION->GetException())
	echo CAdminMessage::ShowMessage(Array(
		"TYPE" => "ERROR",
		"MESSAGE" => GetMessage("MOD_INST_ERR"),
		"DETAILS" => $ex->GetString(),
		"HTML" => true,
	));
else
	echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
</form>