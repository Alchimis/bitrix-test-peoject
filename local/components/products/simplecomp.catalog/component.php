<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    if (!isset($arParams["CACHE_TIME"])){
        $arParams["CACHE_TIME"] = 36000000;
    };

    $arParams["IBLOCK_NEWS_ID"] = intval($arParams["IBLOCK_NEWS_ID"]);
    if (!$arParams["IBLOCK_NEWS_ID"]) {
        return;
    }

    $arParams["IBLOCK_FURNITURE_ID"] = intval($arParams["IBLOCK_FURNITURE_ID"]);
    if (!$arParams["IBLOCK_FURNITURE_ID"]){
        return;
    }

    if (!isset($arParams["FURNITURE_NEWS_LINK"])){
        return;
    }

    if ($this->StartResultCache()){

        if (!CModule::IncludeModule("iblock")){
            $this->AbortResultCache();
            return;
        }
        
        $newsResult = Array();
        {
            $newsRaw = CIBlockElement::GetList(
                false,
                Array(
                    "ACTIVE" => "Y",
                    "IBLOCK_ID" => $arParams["IBLOCK_NEWS_ID"] 
                ),
                false,
                false,
            );
            while($n = $newsRaw->GetNextElement()){
                $f = $n->GetFields();
                $newsResult[$f["ID"]] = Array(
                    "NEWS_DATA" => Array(
                        "NAME" => $f["NAME"],
                        "DATE_ACTIVE_FROM" => $f["DATE_ACTIVE_FROM"], 
                        "FURNITURE_SECTIONS" => Array(),
                    ),
                    "FURNITURE_DATA" => Array(),
                );
            }
        }
        $elementsCount = 0;
        {
            $sectionQueryResult = CIBlockSection::GetList(false, Array("IBLOCK_ID" => $arParams["IBLOCK_FURNITURE_ID"]));
            $sections = Array();
            while($secion = $sectionQueryResult->Fetch()){
                $sections[$secion["ID"]] = $secion["NAME"];
            }

            $queryResult = CIBlockElement::GetList(
                false,
                Array(
                    "ACTIVE" => "Y", 
                    "IBLOCK_ID" => $arParams["IBLOCK_FURNITURE_ID"],
                ),
                false,
                false,
            ); 
            while($f = $queryResult->GetNextElement()){
                $elementsCount++;
                $props = $f->GetProperties();
                $name = $f->GetFields()["NAME"];
                $sectionId = $f->GetFields()["IBLOCK_SECTION_ID"];
                foreach($props["UF_NEWS_LINK"]["VALUE"] as $newsId){
                    $newsResult[$newsId]["FURNITURE_DATA"][] = Array(
                        "NAME" => $name,
                        "ARTNUMBER" => $props["ARTNUMBER"]["VALUE"],
                        "PRICE" => $props["PRICE"]["VALUE"],
                        "MATERIAL" => $props["MATERIAL"]["VALUE"],
                    );
                    $sectionName = $sections[$sectionId];
                    if (!in_array($sectionName, $newsResult[$newsId]["NEWS_DATA"]["FURNITURE_SECTIONS"])){
                        $newsResult[$newsId]["NEWS_DATA"]["FURNITURE_SECTIONS"][] = $sectionName;
                    }
                }
            }
        }

        $arResult["NEWS_RESULT"] = $newsResult;
        $APPLICATION->SetTitle("Элементов - ".$elementsCount);
        $this->IncludeComponentTemplate();
    }   
?>