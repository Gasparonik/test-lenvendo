<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent('gasparonik:bookmark.list', '.default', [
    'USER_ID' => $arParams['USER_ID'],
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ELEMENT_COUNT' => $arParams['ELEMENT_COUNT'],
    'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
    'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
    'DETAIL_URL' => $arParams['SEF_FOLDER'] . $arParams['SEF_URL_TEMPLATES']['element'],
    'ADD_LINK' => $arParams['SEF_FOLDER'] . $arParams['SEF_URL_TEMPLATES']['add'],
    'PROPERTY_LINK' => $arParams['PROPERTY_LINK'],
    'PROPERTY_FAVICON' => $arParams['PROPERTY_FAVICON'],
    'PROPERTY_PASSWORD' => $arParams['PROPERTY_PASSWORD'],
    'PROPERTY_DESCRIPTION' => $arParams['PROPERTY_DESCRIPTION'],
    'PROPERTY_KEYWORDS' => $arParams['PROPERTY_KEYWORDS']
]);
