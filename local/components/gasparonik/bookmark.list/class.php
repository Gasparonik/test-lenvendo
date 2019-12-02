<?php
namespace Gasparonik\Components;

class BookMarkList extends \CBitrixComponent{

    public function onPrepareComponentParams($params)
    {
        return $params;
    }

    function executeComponent()
    {
        $this->arResult = [];
        $bookmarks = \CIBlockElement::GetList(false,
            [
                'CREATED_BY' => $this->arParams['USER_ID'],
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            ]
        );
        while ($bookmark = $bookmarks->GetNextElement()){
            $this->arResult['BOOKMARKS'][] = $bookmark->GetFields();
            $this->arResult['BOOKMARKS'][count($this->arResult['BOOKMARKS']) - 1]['PROPERTIES'] = $bookmark->GetProperties();
        }
        $this->includeComponentTemplate();
    }
}