<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="card">
    <div class="catalog-heading-container">
        <div class="catalog-heading">Каталог: </div>
    </div>
    <div >
        <ul>
<? foreach($arResult["NEWS_RESULT"] as $item): ?>
            <li>
                <div class="news-heading">   
                    <p >
                        <b><?echo $item["NEWS_DATA"]["NAME"]; ?></b> - <? echo $item["NEWS_DATA"]["DATE_ACTIVE_FROM"];?> (<?echo implode(", ", $item["NEWS_DATA"]["FURNITURE_SECTIONS"]);?>)
                    </p>
                </div>
                <ul class="default-text">
                    <? foreach($item["FURNITURE_DATA"] as $furniture):?>
                    <li>
                        <p class=""><?echo $furniture["NAME"]. " - " .$furniture["PRICE"]. " - ". $furniture["MATERIAL"].", ". $furniture["ARTNUMBER"];?></p>
                    </li>
                    <? endforeach; ?>
                </ul>
            </li>
<? endforeach; ?>
        </ul>
    </div>
</div>