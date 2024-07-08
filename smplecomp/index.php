<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("smplecomp");
?><?$APPLICATION->IncludeComponent(
	"products:simplecomp.catalog",
	".default",
	Array(
		"FURNITURE_NEWS_LINK" => "UF_NEWS_LINK",
		"IBLOCK_FURNITURE_ID" => "2",
		"IBLOCK_NEWS_ID" => "1"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>