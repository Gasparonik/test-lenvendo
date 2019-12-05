function exportExcel(){
    var request = BX.ajax.runComponentAction('gasparonik:bookmark.list', 'excel', {
        mode: 'class',
        data: {
            data: {
                export: true
            }
        }
    });

    request.then(function(answer){
        debugger;
        if(answer.data.status === 'success'){
            var $a = $("<a>");
            $a.attr("href",answer.data.file);
            $("body").append($a);
            $a.attr("download","file.xlsx");
            $a[0].click();
            $a.remove();
        }
    });
}