<?php

namespace Gasparonik\Components;

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class BookMarkList extends \CBitrixComponent implements Controllerable
{

    public function onPrepareComponentParams($params)
    {
        return $params;
    }

    function configureActions()
    {
        return [
            'excel' => []
        ];
    }

    function executeComponent()
    {
        $this->arResult = $this->getBookmarks($this->arParams['ELEMENT_COUNT']);

        $this->includeComponentTemplate();
    }

    function getBookmarks($pageLength = false)
    {

        if ($pageLength = intval($pageLength)) {
            $arNavParams = [
                'nPageSize' => $pageLength
            ];
        } else {
            $arNavParams = false;
        }


        if (Loader::includeModule('iblock')) {
            $arResult['ITEMS'] = [];
            $bookmarks = \CIBlockElement::GetList(
                [
                    $this->arParams['ELEMENT_SORT_FIELD'] => $this->arParams['ELEMENT_SORT_ORDER']
                ],
                [
                    'CREATED_BY' => $this->arParams['USER_ID'],
                    'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                ],
                false,
                $arNavParams
            );
            $bookmarks->SetUrlTemplates($this->arParams['DETAIL_URL']);
            while ($bookmark = $bookmarks->GetNextElement()) {
                $arResult['ITEMS'][] = $bookmark->GetFields();
                $arResult['ITEMS'][count($arResult['ITEMS']) - 1]['PROPERTIES'] = $bookmark->GetProperties();
            }

            $arResult["NAV_STRING"] = $bookmarks->GetPageNavStringEx(
                $navComponentObject,
                '',
                '.default',
                false,
                $this,
                $arNavParams
            );

            return $arResult;
        }

        return [];
    }

    function excelAction($data)
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $metaLinkSource = $data['settings']['PROPERTY_LINK'];
        $metaKeywordsSource = $data['settings']['PROPERTY_KEYWORDS'];
        $metaDescriptionSource = $data['settings']['PROPERTY_DESCRIPTION'];


        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Link');
        $sheet->setCellValue('D1', 'Keywords');
        $sheet->setCellValue('E1', 'Description');

        foreach ($this->getBookmarks()['ITEMS'] as $id => $bookmark) {
            $columnNumber = $id + 2;

            $sheet->setCellValue("A$columnNumber", $bookmark['ID']);
            $sheet->setCellValue("B$columnNumber", $bookmark['NAME']);
            $sheet->setCellValue("C$columnNumber", $bookmark['PROPERTIES'][$metaLinkSource]['VALUE']);
            $sheet->setCellValue("D$columnNumber", $bookmark['PROPERTIES'][$metaKeywordsSource]['VALUE']);
            $sheet->setCellValue("E$columnNumber", $bookmark['PROPERTIES'][$metaDescriptionSource]['VALUE']);
        }

        $writer = new Xlsx($spreadsheet);

        ob_start();
        $writer->save('php://output');
        $excelData = ob_get_clean();

        return [
            'status' => 'success',
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($excelData),
            'name' => 'bookmarks ' . date('Y-m-d H:i:s') . '.xlsx'
        ];
    }
}
