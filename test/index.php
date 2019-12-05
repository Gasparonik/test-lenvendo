<?php require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
$APPLICATION->SetTitle('Bookmark');
$APPLICATION->IncludeComponent('gasparonik:bookmark', '.default', [
    'IBLOCK_ID' => 1,
    'ELEMENT_SORT_FIELD' => $_COOKIE['sort_field'] ?? 'created',
    'ELEMENT_SORT_ORDER' => $_COOKIE['sort_order'] ?? 'DESC',
    'ELEMENT_COUNT' => 2,
    'USER_ID' => $USER->GetID(),
    'SEF_FOLDER' => '/test/',
    'SEF_URL_TEMPLATES' => [
        'add' => 'add/',
        'element' => '#ELEMENT_ID#/'
    ],
    'PROPERTY_LINK' => 'LINK',
    'PROPERTY_FAVICON' => 'FAVICON',
    'PROPERTY_PASSWORD' => 'PASSWORD',
    'PROPERTY_DESCRIPTION' => 'DESCRIPTION',
    'PROPERTY_KEYWORDS' => 'KEYWORDS'
]);
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");