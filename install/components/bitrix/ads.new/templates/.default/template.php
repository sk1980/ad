<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if (!is_array($arResult["arText"]) || count($arResult["arText"]) < 1)
	return;

?>
<div class="ad-test">
<H2><?=GetMessage("TEST_MESSAGE")?></H2>

	<ul>
		<?foreach($arResult["arText"] as $index => $arItem):?>

			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?></li>

		<?endforeach?>
	</ul>
</div>