<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<a class="btn btn-primary" href="<?=$arParams['ADD_LINK']?>">Добавить</a>
<a class="btn btn-primary" href="javascript:void(0)" onclick="exportExcel();">Экспорт в Excel</a>
<div class="row">
    <div class="col-md-2 form-inline">
        <label for="selectSort" class="control-label">Сортировка по полю: </label>
        <select id="selectSort" class="form-control" onchange="changeSort(
                this.value,
                $(this).find(':selected').data('order')
            )">
            <option data-order="DESC" value="created" <?=($arParams['ELEMENT_SORT_FIELD'] == 'created') && ($arParams['ELEMENT_SORT_ORDER'] == 'DESC') ? 'selected' : ''?>>Дата добавления &darr;</option>
            <option data-order="ASC" value="created" <?=($arParams['ELEMENT_SORT_FIELD'] == 'created') && ($arParams['ELEMENT_SORT_ORDER'] == 'ASC') ? 'selected' : ''?>>Дата добавления &uarr;</option>
            <option data-order="DESC" value="PROPERTY_LINK" <?=($arParams['ELEMENT_SORT_FIELD'] == 'PROPERTY_LINK') && ($arParams['ELEMENT_SORT_ORDER'] == 'DESC') ? 'selected' : ''?>>URL &darr;</option>
            <option data-order="ASC" value="PROPERTY_LINK" <?=($arParams['ELEMENT_SORT_FIELD'] == 'PROPERTY_LINK') && ($arParams['ELEMENT_SORT_ORDER'] == 'ASC') ? 'selected' : ''?>>URL &uarr;</option>
            <option data-order="DESC" value="NAME" <?=($arParams['ELEMENT_SORT_FIELD'] == 'NAME') && ($arParams['ELEMENT_SORT_ORDER'] == 'DESC')? 'selected' : ''?>>Название &darr;</option>
            <option data-order="ASC" value="NAME" <?=($arParams['ELEMENT_SORT_FIELD'] == 'NAME') && ($arParams['ELEMENT_SORT_ORDER'] == 'ASC')? 'selected' : ''?>>Название &uarr;</option>
            <option data-order="DESC" value="PROPERTY_KEYWORDS" <?=($arParams['ELEMENT_SORT_FIELD'] == 'PROPERTY_KEYWORDS') && ($arParams['ELEMENT_SORT_ORDER'] == 'DESC')? 'selected' : ''?>>keywords &darr;</option>
            <option data-order="ASC"  value="PROPERTY_KEYWORDS" <?=($arParams['ELEMENT_SORT_FIELD'] == 'PROPERTY_KEYWORDS') && ($arParams['ELEMENT_SORT_ORDER'] == 'ASC')? 'selected' : ''?>>keywords &uarr;</option>
            <option data-order="DESC" value="PROPERTY_DESCRIPTION" <?=($arParams['ELEMENT_SORT_FIELD'] == 'PROPERTY_DESCRIPTION') && ($arParams['ELEMENT_SORT_ORDER'] == 'DESC')? 'selected' : ''?>>description &darr;</option>
            <option data-order="ASC"  value="PROPERTY_DESCRIPTION" <?=($arParams['ELEMENT_SORT_FIELD'] == 'PROPERTY_DESCRIPTION') && ($arParams['ELEMENT_SORT_ORDER'] == 'ASC')? 'selected' : ''?>>description &uarr;</option>
        </select>
    </div>
</div>

<table class="table table-striped table-bordered dataTable" id="bookmarks-list">
    <thead>
        <tr>
            <th>Дата добавления</th>
            <th>favicon</th>
            <th>Ссылка</th>
            <th>Название</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($arResult['ITEMS'] as $bookmark){ ?>
        <tr>
            <td><?=$bookmark['DATE_CREATE']?></td>
            <td><img width="32" src="<?=$bookmark['PROPERTIES'][$arParams['PROPERTY_FAVICON']]['VALUE'] ? CFile::GetPath($bookmark['PROPERTIES'][$arParams['PROPERTY_FAVICON']]['VALUE']) : ''?>" alt=""></td>
            <td><a href="<?=$bookmark['PROPERTIES'][$arParams['PROPERTY_LINK']]['VALUE']?>" target="_blank"><?=$bookmark['PROPERTIES'][$arParams['PROPERTY_LINK']]['VALUE']?></a></td>
            <td><a href="<?=$bookmark['DETAIL_PAGE_URL']?>"><?=$bookmark['NAME']?></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<input type="hidden" id="PROPERTY_KEYWORDS" value="<?=$arParams['PROPERTY_KEYWORDS']?>">
<input type="hidden" id="PROPERTY_LINK" value="<?=$arParams['PROPERTY_LINK']?>">
<input type="hidden" id="PROPERTY_DESCRIPTION" value="<?=$arParams['PROPERTY_DESCRIPTION']?>">

<?=$arResult['NAV_STRING']?>
