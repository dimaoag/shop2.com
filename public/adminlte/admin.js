$('.delete').click(function () {
    var res = confirm('Agree with action?');
    if (!res){
        return false;
    }
});