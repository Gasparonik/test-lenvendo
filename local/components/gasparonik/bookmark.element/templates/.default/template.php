<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if($arResult){?>
    <a href="<?=$arParams['LIST_URL']?>" class="btn btn-close">Назад</a>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Название</th>
            <th>Keywords</th>
            <th>Description</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><img width="16" height="16" src="<?=$arResult['PROPERTIES'][$arParams['PROPERTY_FAVICON']]['VALUE'] ? CFile::GetPath($arResult['PROPERTIES'][$arParams['PROPERTY_FAVICON']]['VALUE']) : ''?>" alt=""></td>
            <td><?=$arResult['NAME']?></td>
            <td><?=$arResult['PROPERTIES'][$arParams['PROPERTY_KEYWORDS']]['VALUE']?></td>
            <td><?=$arResult['PROPERTIES'][$arParams['PROPERTY_DESCRIPTION']]['VALUE']?></td>
            <td>
                <button data-id="<?=$arResult['ID']?>" class="btn btn-primary bookmark-delete" type="button" onclick="bookMarkDelete(this.dataset.id, <?=$arParams['IBLOCK_ID']?>)">Удалить</button>
            </td>
        </tr>
        </tbody>
    </table>
<?php }