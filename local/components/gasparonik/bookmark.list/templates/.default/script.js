function exportExcel(){
    var request = BX.ajax.runComponentAction('gasparonik:bookmark.list', 'excel', {
        mode: 'class',
        data: {
            data: {
                settings: {
                    'PROPERTY_DESCRIPTION': BX('PROPERTY_DESCRIPTION').value,
                    'PROPERTY_KEYWORDS': BX('PROPERTY_KEYWORDS').value,
                    'PROPERTY_LINK': BX('PROPERTY_LINK').value,
                }
            }
        }
    });

    request.then(function(answer){
        if(answer.data.status === 'success'){
            var $a = $("<a>");
            $a.attr("href",answer.data.file);
            $("body").append($a);
            $a.attr("download",answer.data.name);
            $a[0].click();
            $a.remove();
        }
    });
}

function changeSort($field, $order){
    BX.setCookie('sort_field', $field);
    BX.setCookie('sort_order', $order);
    location.reload();
}