
// alert before delete item
$('.delete').click(function () {
    var res = confirm('Agree with action?');
    if (!res){
        return false;
    }
});

$('.sidebar-menu a').each(function () {
    var currentLocation = window.location.protocol + '//' + window.location.host + window.location.pathname;
    var link = this.href;
    if(link == currentLocation){
        $(this).parent().addClass(' active'); //parent
        $(this).closest('.treeview').addClass(' active'); //child
    }
});


// include CKeditor
// CKEDITOR.replace('editor1');
$('#editor1').ckeditor();


//reset filter in add new product
$('#reset_filter').click(function () {
    $('#filter input[type=radio]').prop('checked', false); //снять все отметки
    return false;
});

//select2
$(".select2").select2({
    placeholder: "Start to input name product",
    minimumInputLength: 1,  // с какого символа отправлять запрос на сервер
    cache: true,
    ajax: {
        url: adminPath + "/product/related-product",
        delay: 250,  //задержка перед показом
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) { //return data
            return {
                results: data.items,
            };
        },
    },
});
