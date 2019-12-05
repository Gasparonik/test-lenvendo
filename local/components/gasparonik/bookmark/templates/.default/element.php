<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent('gasparonik:bookmark.element', '.default', [
    'USER_ID' => $arParams['USER_ID'],
    'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'LIST_URL' => $arParams['SEF_FOLDER']
]);