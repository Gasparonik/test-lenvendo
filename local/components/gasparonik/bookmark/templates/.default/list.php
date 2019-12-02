<?php
$APPLICATION->IncludeComponent('gasparonik:bookmark.list', '.default', [
    'USER_ID' => $arParams['USER_ID'],
    'IBLOCK_ID' => $arParams['IBLOCK_ID']
]);