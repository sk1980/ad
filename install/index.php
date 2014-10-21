<?
global $MESS;
$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen("/index.php"));
IncludeModuleLangFile($PathInstall."/install.php");
IncludeModuleLangFile(__FILE__);

if(class_exists("ad")) return;
Class ad extends CModule
{
	var $MODULE_ID = "ad";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";
	var $errors;

	function ad()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}
		else
		{
			$this->MODULE_VERSION = AD_VERSION;
			$this->MODULE_VERSION_DATE = AD_VERSION_DATE;
		}

		$this->MODULE_NAME = GetMessage("AD_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("AD_MODULE_DESCRIPTION");
		$this->MODULE_CSS = "/bitrix/modules/ad/ad.css";
	}

	function InstallUserFields()
	{

	}

	function UnInstallUserFields()
	{

	}

	function InstallDB($arParams = array())
	{
		global $DB, $DBType, $APPLICATION;
		$this->errors = false;

		// Database tables creation
		if(!$DB->Query("SELECT 'x' FROM b_ad WHERE 1=0", true))
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/install/db/".strtolower($DB->type)."/install.sql");

		if($this->errors !== false)
		{
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}
		else
		{

			$this->InstallUserFields();

			return true;
		}
	}

	function UnInstallDB($arParams = array())
	{
		global $DB, $DBType, $APPLICATION;
		$this->errors = false;

			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/install/db/".strtolower($DB->type)."/uninstall.sql");

		$this->UnInstallUserFields();

		if($this->errors !== false)
		{
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}

		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{

		return true;
	}

	function InstallFiles($arParams = array())
	{

		return true;
	}

	function UnInstallFiles()
	{

		return true;
	}


	function DoInstall()
	{
		global $DB, $APPLICATION, $step;
		$AD_RIGHT = $APPLICATION->GetGroupRight("ad");

		if ($AD_RIGHT=="W")
		{
			if($this->InstallDB()) 
			{
				$APPLICATION->IncludeAdminFile(GetMessage("AD_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/install/step.php");
			}
			$GLOBALS["errors"] = $this->errors;

		}
	}

	function DoUninstall()
	{
		global $DB, $APPLICATION, $step;
		$AD_RIGHT = $APPLICATION->GetGroupRight("ad");
		if ($AD_RIGHT=="W")
		{
			if($step < 2)
			{
				$APPLICATION->IncludeAdminFile(GetMessage("AD_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/install/unstep1.php");
			}
			elseif($step == 2)
			{
				$this->UnInstallDB();
				$GLOBALS["errors"] = $this->errors;
				$APPLICATION->IncludeAdminFile(GetMessage("AD_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/ad/install/unstep.php");
			}

		}
	}


}
?>