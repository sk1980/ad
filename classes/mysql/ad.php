<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/classes/general/ad.php");

/**********************************************************************/
/************** FORUM *************************************************/
/**********************************************************************/
class CAd extends CAllAd
{

	function GetList($arOrder, $arFilter = Array(), $arAddParams = array())
	{
		global $DB;

		$strSql =
			"SELECT b_ad.ID, 
                                b_ad.TITLE, 
                                b_ad.URL, 
                                b_ad.DESCRIPTION 
			 FROM b_ad
			";
		$db_res = $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
		return $db_res;
	}

	function Add($arFields)
	{
		$err_mess = (CForm::err_mess())."<br>Function: AddResultAnswer<br>Line: ";
		global $DB;
		$arInsert = $DB->PrepareInsert("b_ad", $arFields, "form");
		$strSql = "INSERT INTO b_ad (".$arInsert[0].") VALUES (".$arInsert[1].")";
		$DB->Query($strSql, false, $err_mess.__LINE__);
		return intval($DB->LastID());
	}

	function Update($ID, $arFields, $bReindex = true)
	{
		global $DB;
		$ID = intVal($ID);

		if (empty($arFields))
			return false;

		$strUpdate = $DB->PrepareUpdate("b_ad", $arFields);

		if (!empty($strUpdate))
		{
			$strSql = "UPDATE b_ad SET ".$strUpdate." WHERE ID=".$ID;
			$DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
		}

		return $ID;
	}

	function Delete($ID)
	{
		global $DB;
		$ID = intVal($ID);

		if (!$DB->Query("DELETE FROM b_ad WHERE ID=".$ID, true))
		{
			return false;
		}
		return true;
	}

} 
?>