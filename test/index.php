<?php require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
$APPLICATION->SetTitle('Bookmark');
$APPLICATION->IncludeComponent('gasparonik:bookmark', '.default', [
    'IBLOCK_ID' => 1,
    'ELEMENT_SORT_FIELD' => $_COOKIE['SORT_FIELD'] ?? 'ID',
    'ELEMENT_SORT_ORDER' => $_COOKIE['SORT_ORDER'] ?? 'DESC',
    'ELEMENT_COUNT' => 2,
    'USER_ID' => $USER->GetID(),
    'SEF_FOLDER' => '/test/',
    'SEF_URL_TEMPLATES' => [
        'add' => 'add/',
        'element' => '#ELEMENT_ID#/'
    ]
]);
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");