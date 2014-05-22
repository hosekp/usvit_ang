<?php
session_start();
$newtema=$_POST["newtema"];
//echo $newtema;
if($newtema==="true"){
    $name=$_POST["name"];
    $permis=$_POST["permis"];
    if($name==""||$permis==""){echo "not filled";return;}
    include 'connect.php';
    $q="insert into forumtema (
        name,
        permis
        ) values (
        '$name',
        '$permis'
        )";
    //echo $q;
    //mysql_query($q);
    //$result=mysql_query("SELECT id FROM players WHERE email='".$email."'");
    //$result2 = mysql_query("select last_insert_id()");
    //$id = mysql_result($result2,0,"last_insert_id()");
}else{
    $hrac=$_POST["hrac"];
    $tema=$_POST["tema"];
    $text=$_POST["text"];
    $permis=$_POST["permis"];
    if($hrac==""||$tema==""||$text==""){echo "not filled";return;}
    include 'connect.php';
    $q="insert into forumtext (
        hrac,
        tema,
        text
        ) values (
        '$hrac',
        $tema,
        '$text'
        )";
    //echo $q;
    //$result=mysql_query("SELECT id FROM players WHERE email='".$email."'");
    //$result2 = mysql_query("select last_insert_id()");
    //$id = mysql_result($result2,0,"last_insert_id()");
}
include "changes.php";
add_change("forum", $permis);
$result=mysql_query($q);
mysql_close();
echo $result;
return;


?>
