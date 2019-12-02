<?php
namespace Gasparonik\Components;

class BookMarkElement extends \CBitrixComponent{

    public function onPrepareComponentParams($params)
    {
        return $params;
    }

    function executeComponent()
    {
        $bookmark = \CIBlockElement::GetByID($this->arParams['ELEMENT_ID'])->GetNextElement();
        if($bookmark){
            $this->arResult = $bookmark->GetFields();
            $this->arResult['PROPERTIES'] = $bookmark->GetProperties();
        }
        $this->includeComponentTemplate();
    }
}