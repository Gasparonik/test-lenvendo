<a href=".." class="btn btn-close">Назад</a>
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
            <td><img width="16" height="16" src="<?=$arResult['PROPERTIES']['FAVICON']['VALUE'] ? CFile::GetPath($arResult['PROPERTIES']['FAVICON']['VALUE']) : ''?>" alt=""></td>
            <td><?=$arResult['NAME']?></td>
            <td><?=$arResult['PROPERTIES']['KEYWORDS']['VALUE']?></td>
            <td><?=$arResult['PROPERTIES']['DESCRIPTION']['VALUE']?></td>
            <td>
                <button data-id="<?=$arResult['ID']?>" class="btn btn-primary bookmark-delete" type="button" onclick="bookMarkDelete(this.dataset.id, <?=$arParams['IBLOCK_ID']?>)">Удалить</button>
            </td>
        </tr>
    </tbody>
</table>