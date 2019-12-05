document.addEventListener('DOMContentLoaded', function () {
    BX.bind(
        BX('bookmarks-add'),
        'submit',
        function(event){
            var pass = BX('bookmark-password').value;
            var confirmPass = BX('bookmark-password-confirm').value;
            if(pass === confirmPass){
                var request = BX.ajax.runComponentAction('gasparonik:bookmark.add', 'add', {
                    mode:'class',
                    data: {
                        data: {
                            'link': BX('bookmark-url').value,
                            'password': pass,
                            'iblock_id': BX('bookmark-iblock').value,
                            'PROPERTY_LINK': BX('PROPERTY_LINK').value,
                            'PROPERTY_FAVICON': BX('PROPERTY_FAVICON').value,
                            'PROPERTY_DESCRIPTION': BX('PROPERTY_DESCRIPTION').value,
                            'PROPERTY_KEYWORDS': BX('PROPERTY_KEYWORDS').value,
                            'PROPERTY_PASSWORD': BX('PROPERTY_PASSWORD').value,

                        }
                    }
                });
                request.then(function(response){
                    if(response.data.status === 'success'){
                        window.location.href = response.data.url;
                    }else{
                        BX('warning').innerHTML = response.data.reason;
                    }
                });
            }else{
                alert('Пароли не совпадают');
            }
            event.preventDefault() ;
            event.stopPropagation();
        }
    );
});