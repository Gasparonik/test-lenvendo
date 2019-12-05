<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent('gasparonik:bookmark.add', '.default', [
    'IBLOCK_ID' => $arParams['IBLOCK_ID']
]);