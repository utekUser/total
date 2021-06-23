function split(id) {
    document.location.href = '?splitm=' + id;
}
function splitbefore(id) {
    document.location.href = '?splitmbefore=' + id;
}











function open_browser() {
	mywin = open('/externals/filemanager/', 'displaywindow', 'width=700, height=500,resizable=no');
}
function show(id) { 
    document.getElementById(id).style.display = 'block';
}
function hide(id) {
    document.getElementById(id).style.display = 'none';
}