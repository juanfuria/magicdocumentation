<?php
header('Content-type: text/javascript');

//Player
Ajax::Register("savePlayer", "Player", '$("#xplayers").append(data.html);');
Ajax::Register("updatePlayer", null, 'replaceData(data);', array("id", "Name"));
Ajax::Register("editPlayer", null, '$("#xcontent").html(data.html);', array("Player_id"));
Ajax::Register("epip", null, 'replaceData(data);', array("id"));
Ajax::Register("saveGame", "Game", '$("#xgames").append(data.html);');

//Pages
Ajax::Register("Page_Players", null, '$("#xcontent").html(data.html);');
Ajax::Register("Page_Games", null, '$("#xcontent").html(data.html);');

ob_end_flush();
?>

function replaceData(data){
if (typeof(data.replace) != 'undefined') {
$("#" + data.replace.id).replaceWith(data.replace.html);
}
}