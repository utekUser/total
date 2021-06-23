function open_browser() {
	mywin = open('/externals/filemanager/', 'displaywindow', 'width=700, height=500,resizable=no');
}
function display(id) {
    document.location.href = '?displayset=' + id;
}
function set(id) {
    document.location.href='?first_set='+id;
}
function setd(id) {
    document.location.href='?d_set='+id;
}