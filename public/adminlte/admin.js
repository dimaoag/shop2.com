
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

