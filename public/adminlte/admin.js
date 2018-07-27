
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
                results: data.items
            };
        }
    }
});

//upload images
if ($('div').is('#single')){
    var buttonSingle = $('#single'),
        buttonMulti = $('#multi'),
        file;
}

if (buttonSingle){
    new AjaxUpload(buttonSingle, {
        action: adminPath + buttonSingle.data('url') + "?upload=1",
        data: {name: buttonSingle.data('name')},
        name: buttonSingle.data('name'), //параметр
        onSubmit: function(file, ext){ //при нажатии на кнопку выполняется функция (названия файла и его расширения)
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Error! Allowed only images.');
                return false;
            }
            buttonSingle.closest('.file-upload').find('.overlay').css({'display':'block'});
            //первый предок (родитель с класом .file-upload) >  ищеи .find('.overlay') и показуем спинер

        },
        onComplete: function(file, response){ // по завершению аякс запроса
            setTimeout(function(){ // чтобы лоадер (спинер) дольше покрутился
                buttonSingle.closest('.file-upload').find('.overlay').css({'display':'none'});

                response = JSON.parse(response);
                $('.' + buttonSingle.data('name')).html('<img src="/images/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}

if (buttonMulti){
    new AjaxUpload(buttonMulti, {
        action: adminPath + buttonMulti.data('url') + "?upload=1",
        data: {name: buttonMulti.data('name')},
        name: buttonMulti.data('name'),
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))) {
                alert('Ошибка! Разрешены только картинки');
                return false;
            }
            buttonMulti.closest('.file-upload').find('.overlay').css({'display': 'block'});

        },
        onComplete: function (file, response) {
            setTimeout(function () {
                buttonMulti.closest('.file-upload').find('.overlay').css({'display': 'none'});

                response = JSON.parse(response);
                $('.' + buttonMulti.data('name')).append('<img src="/images/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}


//delete images from  product
$('.del-img').on('click', function () {
    var res = confirm('Agree action?');
    if (!res) return false;

    var this_img = $(this),
        id = this_img.data('id'),
        src = this_img.data('src'),
        type = this_img.data('type');

    $.ajax({
        url: adminPath + '/product/delete-image',
        data: {id: id, src: src, type: type},
        type: 'post',
        beforeSend: function () {
            this_img.closest('.file-upload').find('.overlay').css({'display': 'block'});
        },
        success: function (res) {
            setTimeout(function () {
                this_img.closest('.file-upload').find('.overlay').css({'display': 'none'});
                if (res == 1){
                    this_img.fadeOut();
                }
            }, 1000);
        },
        error: function () {
            setTimeout(function () {
                this_img.closest('.file-upload').find('.overlay').css({'display': 'none'});
                alert('Error!')
            }, 1000);
        },
    });

});


//create modification product
var modList = [];
$('#add').on('click',function () {

    // var modList = [];
    var color = $('#in_color').val(),
        price = $('#in_price').val();
    var temp = {};
        temp.color = color;
        temp.price = price;
    var i = modList.length;
    modList[i] = temp;
    out();


    console.log(modList);

    return false;
});

function out() {
    var out = '';
    for (var key in modList){
        out += "<input type='checkbox' class='form-check-input' checked name='mod[" + key +"]' " +
            "value='" + modList[key].color + "_" + modList[key].price +"'" +
            "id='mod_"+ key +"'>";
        out += "<label class='form-check-label' for='mod_"+ key +"'>" + modList[key].color + " - $" + modList[key].price + "</label><br>";
    }
    $('.out').html(out);
}


// check input before submit isNum
$('#form_id').on('submit', function () {
    if (!isNumeric($('#category_id'))){
        alert('Choose category');
        return false;
    }
});

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}