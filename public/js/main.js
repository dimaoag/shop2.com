$('#currency').change(function () {
    // console.log(window.location.origin);
    window.location = '/currency/change/?curr=' + $(this).val();
});