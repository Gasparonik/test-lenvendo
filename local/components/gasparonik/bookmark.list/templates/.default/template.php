<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<a class="btn btn-primary" href="<?=$arParams['ADD_LINK']?>">Добавить</a>
<a class="btn btn-primary" href="javascript:void(0)" onclick="exportExcel();">Экспорт в Excel</a>
<div class="row">
    <div class="col-md-2 form-inline">
        <label for="selectSort" class="control-label">Сортировка по полю: </label>
        <select id="selectSort" class="form-control">
            <option value="name">Название</option>
            <option value="keywords">keywords</option>
            <option value="description">keywords</option>
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
            <td><?=$bookmark['CREATED_DATE']?></td>
            <td><img src="<?=$bookmark['PROPERTIES']['FAVICON']['VALUE'] ? CFile::GetPath($bookmark['PROPERTIES']['FAVICON']['VALUE']) : ''?>" alt=""></td>
            <td><a href="<?=$bookmark['CODE']?>" target="_blank"><?=$bookmark['CODE']?></a></td>
            <td><a href="<?=$bookmark['DETAIL_PAGE_URL']?>"><?=$bookmark['NAME']?></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?=$arResult['NAV_STRING']?>
