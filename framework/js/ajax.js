var timerID = null;
var delay = 3600 * 1000;
var SEND_METHOD = "POST";


function getCal(calDate){
        $.ajax({
            data: "function=getCal&nextDate=" + calDate,
            type: SEND_METHOD,
            dataType: "json",
            url: "/ajax.php",
            success: function(data){
                getCalendar(data);
            }
        });
}

function getAddPostForm()
{
      $.ajax({
            data: "function=getAddPostForm",
            type: SEND_METHOD,
            dataType: "json",
            url: "/ajax.php",
            success: function(data){
                setAddPostContent(data)
            }
        });
}

function closeSession()
{
    $.ajax({
            data: "function=closeSession",
            type	: SEND_METHOD,
            cache	: false,
            url		: "/ajax.php",
            dataType    : "json",
            success: function(data) {
                    window.location.href = data.redirect;
     }
     });
}

$(document).ready(function()
{
    refreshWeather();
    $("#sl").fancybox({'scrolling': 'no','titleShow': false, 'onComplete': function() {$("#login_name").focus();},'onClosed': function(){$("#login_error").hide();}});
    
    $("#login").click(function() {

            if (($("#login_name").val().length < 1) || ($("#login_pass").val().length < 1))
            {
                $("#login_error").show();
                $.fancybox.resize();
                return false;
            }

            $.fancybox('<img src="/framework/imagenes/loading.gif" />');
            $.ajax({
                    data: "function=login&user=" + $("#login_name").val() +"&pass=" + $("#login_pass").val(),
                    type	: SEND_METHOD,
                    cache	: false,
                    url		: "/ajax.php",
                    dataType    : "json",
                    success: function(data) {
                        if (data.redirect){window.location.href = data.redirect;}
                        else {$.fancybox(data.error);}
                    }
            });

            return false;
    });
    $("#searchstring").keypress(function(event) {if ( event.which == 13 ) {Search();}});
    $("#login_pass").keypress(function(event) {if ( event.which == 13 ) {$("#login").click();}});

    $("#searchButton").click(function(){Search();});

});


function getCalendar(data)
{
    $("#xCalendar").html(data.html);
}
function fillPosts(data)
{
    $("#xPosts").html(data.html);
}
function setWeather(data)
{
    $("body").css("background-color", data.background);
}
function setShowCommentBox(data)
{
    $('#xComment').slideDown('slow');
    $("#xComment").html(data.commentBox);
    $("#xCommentLink").html(data.commentLink);
}
function setHideCommentBox(data)
{
    $('#xComment').slideUp('slow');
    $("#xComment").html("");
    $("#xCommentLink").html(data.commentLink);
}
function addComment(data)
{
    $("#xComments").prepend(data.html);
    $("#xComment").html(data.commentBox);
    $('#xComment').slideUp('slow');
    $("#xCommentLink").html(data.commentLink);
}
function setProcessedPosts(data)
{
    $("#xPosts").html(data.html);
    $("#xPosts").fadeIn(2);
    smoothScroll('body');
}
function setPostContent(data, alone)
{
    if(alone)
    {
        $("#xPosts").fadeIn(2);
        $("#xPosts").html(data.html);
        smoothScroll('body');
    }
    else
    {
        $("#p" + data.id).fadeIn(2);
        $("#p" + data.id).html(data.html);
        smoothScroll("p" + data.id);
    }
}
function setEditContent(data)
{
    $("#p" + data.id).slideDown('slow');
    $("#p" + data.id).html(data.html);
}

function setAddPostContent(data)
{
    $("#xAdd").html(data.html);
    $("#xAdd").fadeIn(2);
    smoothScroll('body');
}

 function PostInserted(data)
 {
    $("#xAdd").html(data.add);
    $("#xAdd").fadeIn(2);
    $("#xPosts").prepend(data.html);
    $("#xPosts").fadeIn(2);
    smoothScroll('body');
    $("#cat").html(data.cat);
 }
 function setEditPostContent(data)
 {
    $("#p" + data.id).slideDown('slow');
    $("#p" + data.id).html(data.html);
 }
 function askDeletePostResult(data)
 {
    $("#p" + data.id).fadeIn(2);
    $("#p" + data.id).html(data.html);
    smoothScroll("p" + data.id);
 }
 function deletePostResult(data)
 {
    $("#p" + data.id).fadeIn(2);
    $("#p" + data.id).html(data.html);
    smoothScroll("p" + data.id);
    $("#cat").html(data.cat);
 }
 function updatePostResult(data)
 {
    $("#p" + data.id).fadeIn(2);
    $("#p" + data.id).html(data.html);
    smoothScroll("p" + data.id);
    $("#cat").html(data.cat);
 }
 function cancelAddPostResult(data)
 {
    $("#xAdd").fadeIn(2);
    $("#xAdd").html(data.html);
 }
 function favResult(data)
 {
    $("#s" + data.id).fadeIn(2);
    $("#s" + data.id).html(data.html);
 }
 function gFavResult(data)
 {
    $("#xPosts").fadeIn(2);
    $("#xPosts").html(data.html);
    smoothScroll('body');
 }


//Utils
function resize(t){a = t.value.split('\n');b = 1;for (x = 0;x < a.length; x++){if (a[x].length >= t.cols)b+= Math.floor(a[x].length/t.cols);}b += a.length;t.rows = b;}
function cambiarTexto()
{
        mensaje = document.getElementById("tic");
	if ((mensaje.innerHTML == '') || (mensaje.innerHTML == '"tac"'))
		mensaje.innerHTML = '"tic"';
	else if (mensaje.innerHTML == '"tic"')
		mensaje.innerHTML = '"tac"';

}
//FROM: http://www.itnewb.com/v/Creating-the-Smooth-Scroll-Effect-with-JavaScript
function smoothScroll(eID) {
    $(eID).ScrollTo({duration: 500,easing: 'swing'});
}

