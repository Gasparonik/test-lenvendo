<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent('gasparonik:bookmark.element', '.default', [
    'USER_ID' => $arParams['USER_ID'],
    'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'LIST_URL' => $arParams['SEF_FOLDER'],
    'PROPERTY_LINK' => $arParams['PROPERTY_LINK'],
    'PROPERTY_FAVICON' => $arParams['PROPERTY_FAVICON'],
    'PROPERTY_PASSWORD' => $arParams['PROPERTY_PASSWORD'],
    'PROPERTY_DESCRIPTION' => $arParams['PROPERTY_DESCRIPTION'],
    'PROPERTY_KEYWORDS' => $arParams['PROPERTY_KEYWORDS']
]);