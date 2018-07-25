//upload images
var buttonSingle = $('#single'),
    buttonMulti = $('#multi'),
    file;

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

new AjaxUpload(buttonMulti, {
    action: adminPath + buttonMulti.data('url') + "?upload=1",
    data: {name: buttonMulti.data('name')},
    name: buttonMulti.data('name'),
    onSubmit: function(file, ext){
        if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
            alert('Ошибка! Разрешены только картинки');
            return false;
        }
        buttonMulti.closest('.file-upload').find('.overlay').css({'display':'block'});

    },
    onComplete: function(file, response){
        setTimeout(function(){
            buttonMulti.closest('.file-upload').find('.overlay').css({'display':'none'});

            response = JSON.parse(response);
            $('.' + buttonMulti.data('name')).append('<img src="/images/' + response.file + '" style="max-height: 150px;">');
        }, 1000);
    }
});