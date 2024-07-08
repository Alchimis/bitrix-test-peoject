<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (CModule::IncludeModule("iblock")) return;

$arIBlockType = CIBlockParameters::GetIBlockType();
$arIBlock = Array("-"=>GetMessage("IBLOCK_ANY"));

$rsIBlock = CIBlock::GetList(Array("sort"=>"asc"), Array("TYPE"=>$arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch()){
    $arIBLock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = Array(
    "GROUPS" => Array(),
    "PARAMETERS" => Array(
        "IBLOCK_FURNITURE_ID" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("IBLOCK_FURNITURE_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
        ),
        "IBLOCK_NEWS_ID" => Array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("IBLOCK_NEWS_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
        ),
        "FURNITURE_NEWS_LINK" => Array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("FURNITURE_NEWS_LINK"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  Array("DEFAULT"=>36000),
    ),
);
?>