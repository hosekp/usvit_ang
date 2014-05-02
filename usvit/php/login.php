<?php
session_start();
if(isset($_POST["email"])){
    $m_email = strtolower($_POST["email"]);
    $m_heslo = $_POST["heslo"];
}else if(isset($_SESSION['email'])){
    $m_email = $_SESSION['email'];
    $m_heslo = "";
}else{echo "{\"state\":\"nobody\"}";return;}

include "corrector.php";
include 'connect.php';
$result=mysql_query("SELECT * FROM players WHERE email='".$m_email."' AND deleted=0");
$num=mysql_numrows($result);
//$osoba = null;
if($num>0){
    if($m_heslo === mysql_result($result,0,"password")||$_SESSION['idx']==mysql_result($result,0,"id")){
        $m_id=mysql_result($result,0,"id");
        $m_name=mysql_result($result,0,"name");
        $m_surname=mysql_result($result,0,"surname");
        $m_nick=valid(mysql_result($result,0,"nick"));
        $m_age=mysql_result($result,0,"age");
        $m_phone=mysql_result($result,0,"phone");
        $m_gamenick=valid(mysql_result($result,0,"gamenick"));
        $m_race=mysql_result($result,0,"race");
        $m_frac=mysql_result($result,0,"frac");
        $m_title=mysql_result($result,0,"hodnost");
        $m_photo=mysql_result($result,0,"photo");
        $m_abil=mysql_result($result,0,"abil");
        $m_text=valid(mysql_result($result,0,"text"));
        $m_sectext=valid(mysql_result($result,0,"sectext"));
        $m_appr=mysql_result($result,0,"appr");
        $m_zapl=mysql_result($result,0,"payed");
        $m_last_visit=mysql_result($result,0,"last_visit");
        //$m_vars=(32745*$m_id+25378)%122457;
        //$nick=mysql_result($result,0,"nick");
        $prihlasen=true;
        $_SESSION['idx'] = $m_id;
        $_SESSION['email'] = $m_email;
        //$_SESSION['frac'] = $m_frac;
        include "changes.php";
        $m_changes=get_changes($m_frac,$m_last_visit);
        renew($m_id);
        $state="{
            \"state\":\"ok\",
            \"num\":".$num.",
            \"log\":{
            \"id\":".$m_id.",
                \"name\":\"".$m_name."\",
                \"surname\":\"".$m_surname."\",
                \"nick\":\"".$m_nick."\",
                \"email\":\"".$m_email."\",
                \"age\":".$m_age.",
                \"phone\":\"".$m_phone."\",
                \"gamenick\":\"".$m_gamenick."\",
                \"race\":\"".$m_race."\",
                \"frac\":\"".$m_frac."\",
                \"title\":".$m_title.",
                \"foto\":".$m_photo.",
                \"abil\":\"".$m_abil."\",
                \"text\":\"".$m_text."\",
                \"sectext\":\"".$m_sectext."\",
                \"appr\":\"".$m_appr."\",
                \"zapl\":".$m_zapl.",
                \"chan\":$m_changes
            }
        }";
    }
    else $state="{\"state\":\"chybne heslo\"}";
}else $state="{\"state\":\"chybny email\"}";
$state=correct($state);
mysql_close();
echo $state;
?>
