<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("AD_NEW_NAME"),
	"DESCRIPTION" => GetMessage("AD_NEW_DESCRIPTION"),
	"ICON" => "/images/new.gif",
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "service",
		"CHILD" => array(
			"ID" => "ads",
			"NAME" => GetMessage("AD_SERVICE")
		)
	),
);
?>