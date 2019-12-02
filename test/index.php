<?php require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
$APPLICATION->SetTitle('Bookmark');
$APPLICATION->IncludeComponent('gasparonik:bookmark', '.default', [
    'IBLOCK_ID' => 1,
    'USER_ID' => $USER->GetID(),
    'SEF_FOLDER' => '/test/',
    'SEF_URL_TEMPLATES' => [
        'list' => '',
        'add' => 'add/',
        'element' => '#ELEMENT_ID#/'
    ]
]);
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");