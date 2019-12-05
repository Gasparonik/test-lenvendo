<?php
namespace Gasparonik\Components;
use \Bitrix\Main\Loader;

class BookMarkElement extends \CBitrixComponent{

    public function onPrepareComponentParams($params)
    {
        return $params;
    }

    function executeComponent()
    {
        Loader::includeModule('iblock');
        $bookmark = \CIBlockElement::GetByID($this->arParams['ELEMENT_ID'])->GetNextElement();
        if($bookmark){
            $this->arResult = $bookmark->GetFields();
            $this->arResult['PROPERTIES'] = $bookmark->GetProperties();
        }
        $this->includeComponentTemplate();
    }
}