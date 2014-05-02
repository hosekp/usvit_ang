<?php
session_start();
$me=$_GET["me"];
if(isset($_GET["su"])){$su=$_GET["su"];}else{$su="nic";}
include "corrector.php";

if($me=="news"||$me=="forum"){
    include 'connect.php';
    $add="permis=\"all\"";$and="AND";$where="WHERE";
    if(isset($_SESSION["idx"])){
        $result1=mysql_query("SELECT frac,appr FROM players WHERE id=".$_SESSION["idx"]."");
        $num1=mysql_numrows($result1);
        if($num1!=1){echo "error";return;}
        if($me=="forum"||mysql_result($result1,0,"appr")!=null){
            if(mysql_result($result1,0,"frac")==="cp"){
                $add="";$and="";$where="";
            }else{
                $add="permis=\"all\" OR permis=\"super\" OR permis=\"".mysql_result($result1,0,"frac")."\"";
            }
        }
        
    }
    if($me=="forum"){
        //echo "SELECT * FROM `database` $add";
        $result=mysql_query("SELECT * FROM `forumtema` $where $add");
        $num=mysql_numrows($result);
        $temas=array();//$tids=array();
        for($i=0;$i<$num;$i++){
            $tid=mysql_result($result,$i,"id");
            //array_push($tids,"id=$tid");
            $result2=mysql_query("SELECT * FROM `forumtext` WHERE tema=$tid ORDER BY cas ASC");
            $num2=mysql_numrows($result2);
            $priss=array();
            for($j=0;$j<$num2;$j++){
                array_push($priss,"{\"hrac\":\"".mysql_result($result2,$j,"hrac")."\",\"cas\":\"".mysql_result($result2,$j,"cas")."\",\"text\":\"".valid(mysql_result($result2,$j,"text"))."\"}");
            }
            $tema="{\"id\":$tid,\"permis\":\"".mysql_result($result,$i,"permis")."\",\"name\":\"".mysql_result($result,$i,"name")."\",\"priss\":[".implode(",", $priss)."]}";
            //echo $tema;
            array_push($temas,$tema);
            
        }
        $data="[".implode(",",$temas)."]";
        
        
    }else{
        $result=mysql_query("SELECT * FROM news WHERE valid=1 $and $add");
        $num=mysql_numrows($result);
        mysql_close();
        $data="{";$first=true;
        for($i=0;$i<$num;$i++){
            if($first){$first=false;}else{$data.=",";}
            $data.="\"".mysql_result($result,$i,"id")."\":{\"title\":\"".mysql_result($result,$i,"title")."\",\"text\":\"".valid(mysql_result($result,$i,"text"))."\",";
            $data.="\"permis\":\"".mysql_result($result,$i,"permis")."\",\"time\":\"".mysql_result($result,$i,"time")."\"}";
        }
        $data.="}";
    }
} else if($me==="znalosti"||$me==="pravidla"){
    include 'connect.php';
    $add="permis=\"all\" AND";
    if(isset($_SESSION["idx"])){
        $result1=mysql_query("SELECT race,frac,appr FROM players WHERE id=".$_SESSION["idx"]."");
        $num1=mysql_numrows($result1);
        if($num1!=1){echo "error";return;}
        if(mysql_result($result1,0,"appr")!=null){
            if(mysql_result($result1,0,"frac")==="cp"){
                $add="";
            }else{
                if($me==="pravidla"){
                    $frac=mysql_result($result1,0,"race");
                }else{
                    $frac=mysql_result($result1,0,"frac");
                }
                $add="(permis=\"all\" OR permis=\"".$frac."\") AND";
            }
        }
    }
    if($me==="pravidla"){
        $q="SELECT permis,title,address FROM files WHERE $add valid=1";
    }else{
        $q="SELECT permis,primar,title,text FROM databaze WHERE $add valid=1";
    }
    //echo $q;
    $result=mysql_query($q);
    $num=mysql_numrows($result);
    mysql_close();
    $data="[";$first=true;
    for($i=0;$i<$num;$i++){
        if($first){$first=false;}else{$data.=",";}
        /*$text="not found";
        $file="../doc/".  substr(mysql_result($result,$i,"address"),0,-4).".html";
        if(is_file($file)){
            $text=preg_replace('/[\\n\\r]+/', '', file_get_contents($file));
        }*/
        if($me==="pravidla"){
            $data.="{\"permis\":\"".mysql_result($result,$i,"permis")."\",\"title\":\"".mysql_result($result,$i,"title")."\",\"address\":\"".valid(mysql_result($result, $i,"address"))."\"}";
        }else{
            $data.="{\"permis\":\"".mysql_result($result,$i,"permis")."\",\"prim\":\"".mysql_result($result,$i,"primar")."\",\"title\":\"".mysql_result($result,$i,"title")."\",\"text\":\"".valid(mysql_result($result, $i,"text"))."\"}";
        }
    }
    $data.="]";
    
/*} else if($me=="popisy"){
    //if($su=="rasa"){$sun="racepublic";}else{$sun=$su;}
    include 'connect.php';
    //echo "SELECT title,text FROM texts WHERE section=\"$me\" AND name=\"$su\"";
    $result=mysql_query("SELECT name,title,text FROM texts WHERE section=\"$su\" AND (name=\"rasa\" OR name=\"costumes\")");
    $num1=mysql_numrows($result);
    if($num1!=2){echo "error";return;}
    $datasub=  array();
    for($i=0;$i<2;$i++){
        $datasub[$i]="\"".mysql_result($result,$i,"name")."\":{\"title\":\"".mysql_result($result,$i,"title")."\",\"text\":\"".mysql_result($result,$i,"text")."\"}";
    }
    $data="{".implode(",",$datasub)."}";*/
}else if($me==="home"||$me==="info"||$me==="kontakt"){
    include 'connect.php';
    $result=mysql_query("SELECT name,title,text FROM texts WHERE section=\"$me\"");
    $num=mysql_numrows($result);
    //if($num==2){
        $first=true;$data="{";
        for($i=0;$i<$num;$i++){
            if($first){$first=false;}else{$data.=",";}
            $data.="\"".mysql_result($result,$i,"name")."\":{\"title\":\"".mysql_result($result,$i,"title")."\",\"text\":\"".mysql_result($result,$i,"text")."\"}";
        }
        $data.="}";
    /*}else{
        $data="{}";
    }*/
}else if($me==="ucastnici"){
    include 'connect.php';
    $result=mysql_query("SELECT * FROM players WHERE deleted=0 ORDER BY id ASC");
    $num=mysql_numrows($result);
    $upiri=array();$vlkodlaci=array();$lovci=array();$rodina=array();$rest=array();$novinari=array();
    for($i=0;$i<$num;$i++){
        $frac=mysql_result($result,$i,"frac");
        $hrdata="{
            \"id\":".mysql_result($result,$i,"id").",
            \"name\":\"".mysql_result($result,$i,"name")."\",
            \"surname\":\"".mysql_result($result,$i,"surname")."\",
            \"nick\":\"".mysql_result($result,$i,"nick")."\",
            \"email\":\"".mysql_result($result,$i,"email")."\",
            \"gamenick\":\"".valid(mysql_result($result,$i,"gamenick"))."\",
            \"frac\":\"".$frac."\",
            \"title\":".mysql_result($result,$i,"hodnost").",
            \"photo\":".mysql_result($result,$i,"photo").",
            \"appr\":".(mysql_result($result,$i,"appr")!=NULL?"true":"false").",
            \"zapl\":".mysql_result($result,$i,"payed").",
            \"text\":\"".valid(mysql_result($result,$i,"text"))."\"
        }";
        if($frac==="upiri"){array_push($upiri,$hrdata);}else
        if($frac==="vlkodlaci"){array_push($vlkodlaci,$hrdata);}else
        if($frac==="lovci"){array_push($lovci,$hrdata);}else
        if($frac==="rodina"){array_push($rodina,$hrdata);}else
        if($frac==="novinari"){array_push($novinari,$hrdata);}else
        {array_push($rest,$hrdata);}
    }
    $data="{\"upiri\":[".implode(",",$upiri);
    $data.="],\"vlkodlaci\":[".implode(",",$vlkodlaci);
    $data.="],\"lovci\":[".implode(",",$lovci);
    $data.="],\"rodina\":[".implode(",",$rodina);
    $data.="],\"novinari\":[".implode(",",$novinari);
    $data.="],\"cp\":[".implode(",",$rest);
    $data.="]}";
    
    
//}else if($me=="kontakt"){
    
}else{
    $data="\"".$me.$su."\"";
}
//$data=preg_replace("/[\r]\s\s+/","",$data);
//$data=preg_replace("/\n/","\\\n",$data);
$data=correct($data);
echo "{\"me\":\"$me\",\"su\":\"$su\",\"data\":$data}";
?>
