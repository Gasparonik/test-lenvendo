<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<form id="bookmarks-add">
    <div class="form-group">
        <label for="bookmark-url">Ссылка</label>
        <input type="url" class="form-control" id="bookmark-url" placeholder="https://example.com" value="http://dadata.ru">
        <label for="bookmark-password">Пароль</label>
        <input type="password" required class="form-control" id="bookmark-password">
        <label for="bookmark-password-confirm">Подтверждение</label>
        <input type="password" required class="form-control" id="bookmark-password-confirm">
        <small id="warning" class="form-text text-muted"></small>
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
    <input type="hidden" id="bookmark-iblock" value="<?=$arParams['IBLOCK_ID']?>">
    <input type="hidden" id="PROPERTY_LINK" value="<?=$arParams['PROPERTY_LINK']?>">
    <input type="hidden" id="PROPERTY_FAVICON" value="<?=$arParams['PROPERTY_FAVICON']?>">
    <input type="hidden" id="PROPERTY_PASSWORD" value="<?=$arParams['PROPERTY_PASSWORD']?>">
    <input type="hidden" id="PROPERTY_DESCRIPTION" value="<?=$arParams['PROPERTY_DESCRIPTION']?>">
    <input type="hidden" id="PROPERTY_KEYWORDS" value="<?=$arParams['PROPERTY_KEYWORDS']?>">
    <input type="hidden" id="PROPERTY_PASSWORD" value="<?=$arParams['PROPERTY_PASSWORD']?>">
</form>
