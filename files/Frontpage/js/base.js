var currtab = "java";
var curract = "pay";
var pathname = window.location.pathname;
$('.' + curract).show();
function show(tab){
    $('#' + currtab).hide();
    $('#' + tab).show();
    //var stateObj = { foo: "bar" };
    //history.replaceState(null, tab,"#" + tab);
    currtab = tab;
}
function action(act){
    $('.' + curract).hide();
    $('.' + act).show();
    //var stateObj = { foo: "bar" };
    //history.replaceState(null, act,"#" + currtab + "#" + act);
    curract = act;
}
function smoothScroll(eID) {
    $(eID).ScrollTo({duration: 500,easing: 'swing'});
}

