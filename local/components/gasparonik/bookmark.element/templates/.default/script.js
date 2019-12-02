function bookMarkDelete(id, iblockID) {
    var pass = prompt('Password');

    var request = BX.ajax.runComponentAction('gasparonik:bookmark.add', 'delete', {
        mode: 'class',
        data: {
            data: {
                'id': id,
                'iblock_id': iblockID,
                'password': pass
            }
        }
    });
    request.then(function (response) {
        if (response.data.status === 'success') {
            window.location.reload();
        } else {
            alert(response.data.reason);
        }
    });
}