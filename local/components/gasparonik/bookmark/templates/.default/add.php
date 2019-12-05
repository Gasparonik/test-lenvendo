<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent('gasparonik:bookmark.add', '.default', [
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'PROPERTY_LINK' => $arParams['PROPERTY_LINK'],
    'PROPERTY_FAVICON' => $arParams['PROPERTY_FAVICON'],
    'PROPERTY_PASSWORD' => $arParams['PROPERTY_PASSWORD'],
    'PROPERTY_DESCRIPTION' => $arParams['PROPERTY_DESCRIPTION'],
    'PROPERTY_KEYWORDS' => $arParams['PROPERTY_KEYWORDS']
]);