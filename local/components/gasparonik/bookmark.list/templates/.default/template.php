<a class="btn btn-primary" href="add/">Добавить</a>
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
    <?php foreach ($arResult['BOOKMARKS'] as $bookmark){ ?>
        <tr>
            <td><?=$bookmark['CREATED_DATE']?></td>
            <td><img src="<?=$bookmark['PROPERTIES']['FAVICON']['VALUE'] ? CFile::GetPath($bookmark['PROPERTIES']['FAVICON']['VALUE']) : ''?>" alt=""></td>
            <td><a href="<?=$bookmark['CODE']?>" target="_blank"><?=$bookmark['CODE']?></a></td>
            <td><a href="<?=$bookmark['DETAIL_PAGE_URL']?>"><?=$bookmark['NAME']?></a></td>
        </tr>
    <?}?>
    </tbody>
</table>
