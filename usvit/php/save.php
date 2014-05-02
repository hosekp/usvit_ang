<?php
    $me=$_POST["me"];
    $su=$_POST["su"];
    //return;
    session_start();
    include 'corrector.php';
    if(count($_POST)===3){
        $state="{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"ok\",\"next\":$_POST[next]}";
    }else if(isset($_SESSION["idx"])){
        $log="";
        //$set=["name","surname","nick","email","password","age","phone","gamenick","race","fraction","text","sectext"];
        include 'connect.php';
        $result=mysql_query("SELECT appr,photo FROM players WHERE id=".$_SESSION["idx"]."");
        $num=mysql_numrows($result);
        if($num!==1){
            echo "{\"state\":\"Přihlášený hráč nenalezen\"}";mysql_close();return;
        }
        $appr=mysql_result($result,0,"appr")!=NULL;
        $q = "update players set ";
        if($appr){
            $str=array("password","age","phone","gamenick","abil","text","sectext");
        }else{
            $str=array("name","surname","nick","password","age","phone","gamenick","frac","abil","text","sectext");
        }
        foreach ($str as $ind){
            if(isset($_POST[$ind])){$q=$q."$ind='$_POST[$ind]',";$log.="\"$ind\":\"".valid($_POST[$ind])."\",";}
        }
        if(isset($_POST["frac"])){
            /*if($_POST["frac"]==="upiri"||$_POST["frac"]==="lovci"||$_POST["frac"]==="rodina"){
                $state="{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Daná rasa je již plná\"}";
                echo $state;
                return;
            }*/
            $frresult=mysql_query("SELECT frac FROM players WHERE id!=".$_SESSION["idx"]." AND deleted=0");
            $frnum=mysql_numrows($frresult);
            if($frnum>0){
                $frarr=array("upiri"=>0,"vlkodlaci"=>0,"lovci"=>0,"rodina"=>0,"cp"=>0,"novinari"=>0);
                for($f=0;$f<$frnum;$f++){
                    $fr=mysql_result($frresult,$f,"frac");
                    if(isset($frarr[$fr])){
                        $frarr[$fr]++;
                    }
                }
                if(isset($frarr[$_POST["frac"]])&&$_POST["frac"]!=="cp"){
                    if($frarr[$_POST["frac"]]>19){
                        $state="{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Daná rasa je již plná (má".$frarr[$_POST["frac"]]." hráčů)\"}";
                        echo $state;
                        return;
                    }
                }
                /*$frcount=$frarr["upiri"]+$frarr["upiri"]+$frarr["upiri"]+$frarr["upiri"];
                if($frcount>79){
                    $state="{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Registrace je již plná (je zde $frcount hráčů)\"}";
                    echo $state;
                    return;
                }*/
                $q=$q."race='".$_POST["frac"]."',";$log.="\"race\":\"".$_POST["frac"]."\",";
            }
            
            
            
        }
        /*if(isset($_POST[name])){$q=$q."name='$_POST[name]',";$log.="\"name\":\"$_POST[name]\",";}
        if(isset($_POST[surname])){$q=$q."surname='$_POST[surname]',";$log.="\"surname\":\"$_POST[surname]\",";}
        if(isset($_POST[nick])){$q=$q."nick='$_POST[nick]',";$log.="\"nick\":\"$_POST[nick]\",";}
        if(isset($_POST[email])&&!isset(mysql_result($result,0,"email"))){$q=$q."email='$_POST[email]',";}
        if(isset($_POST[password])){$q=$q."password='$_POST[password]',";$log.="\"name\":\"$_POST[name]\",";}
        if(isset($_POST[age])){
            $age=intval($_POST[age]);
            if($age>14){$q=$q."age='$age',";}
        }
        if(isset($_POST[phone])){$q=$q."phone='$_POST[phone]',";}
        if(isset($_POST[gamenick])){$q=$q."gamenick='$_POST[gamenick]',";}
        //if(isset($_POST[race])){$q=$q."phone='$_POST[phone]',";}
        if(isset($_POST[frac])&&!$appr){$q=$q."race='$_POST[frac]',"."fraction='$_POST[frac]',";}
        if(isset($_POST[abil])){$q=$q."abilities='$_POST[abil]',";}
        if(isset($_POST[text])){$q=$q."text='$_POST[text]',";}
        if(isset($_POST[sectext])){$q=$q."sectext='$_POST[sectext]',";}*/
        

        //echo "phase 1";
        if($_POST['foto']){
            //echo "phase 2";
            $wholedata=explode(",",$_POST['foto']);
            $imgdata=  base64_decode($wholedata[1]);
            $src = imagecreatefromstring($imgdata);
            $suf = "";$photonum=mysql_result($result,0,"photo")+1;
            if($photonum>1){
                $suf="_".$photonum;
            }
            imagepng($src,"../fotky/full/".$_SESSION["idx"].$suf."_full.png",0);
            $tmp = resizeFoto($src);
            imagejpeg($tmp,"../fotky/".$_SESSION["idx"].$suf.".jpg",75);
            imagedestroy($tmp);
            $q=$q."photo=".$photonum.",";$log.="\"foto\":".$photonum.",";
        }
//        if(!$POST['error']){
//            echo "phase 1";
//            if($_POST['foto']){
//                echo "phase 2";
//                $extension = strtolower(getExtension($_FILES['foto']['name']));
//                echo $extension;
//                if (($extension != "jpg") && ($extension != "jpeg")&& ($extension != "png") && ($extension != "gif")){
//                    echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Špatná fotka\"}";return;
//                }
//                echo "phase 3";
//                $src = prepareFoto(stripslashes($_FILES['foto']['name']),$_FILES['foto']['tmp_name']);
//                imagepng($src,"../fotky/".$_SESSION["idx"]."_full.png",0);
//                $tmp = resizeFoto($src);
//                imagejpeg($tmp,"../fotky/".$_SESSION["idx"].".jpg",75);
//                imagedestroy($tmp);
//                $q=$q."photo=1,";$log.="\"photo\":1,";
//        }}
        
        $q=substr($q,0,-1)." where id=".$_SESSION["idx"];
        
        /*$q = "update players set 
            name='$_POST[name]',
            surname='$_POST[surname]',
            nick='$_POST[nick]',
            email='$_POST[email]',
            password='$_POST[password]',
            age='$_POST[age]',
            phone='$_POST[phone]',
            gamenick='$_POST[gamenick]',
            race='$_POST[frac]',
            fraction='$_POST[frac]',
            abilities='$_POST[abil]',
            text='$_POST[text]',
            sectext='$_POST[sectext]', 
            where id=".$_SESSION["idx"];*/
        //echo $q;
        mysql_query($q);
        mysql_close();
        $state="{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"ok\",\"next\":".$_POST["next"].",\"log\":{".substr($log,0,-1)."}}";
    }else{
        if(!isset($_POST["name"])||$_POST["name"]==""){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Chybí jméno\"}";return;}
        if(!isset($_POST["surname"])||$_POST["surname"]==""){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Chybí příjmení\"}";return;}
        if(!isset($_POST["nick"])||$_POST["nick"]==""){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Chybí přezdívka\"}";return;}
        if(!isset($_POST["email"])||$_POST["email"]==""){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Chybí e-mail\"}";return;}
        if(!isset($_POST["password"])||$_POST["password"]==""){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Chybí heslo\"}";return;}
        if(!isset($_POST["age"])||$_POST["age"]==""){$age=15;}else{
            $age=intval($_POST["age"]);
            if($age<15){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Nízký věk\"}";return;}
        }
        if(!isset($_POST["phone"])||$_POST["phone"]==""){$phone="";}else{$phone=$_POST["phone"];}
        if(!isset($_POST["capt"])||!($_POST["capt"]==2||$_POST["capt"]=="dvě"||$_POST["capt"]=="dva")){echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Špatná captcha\"}";return;}
        $name=$_POST["name"];
        $surname=$_POST["surname"];
        $nick=$_POST["nick"];
        $email=strtolower($_POST["email"]);
        $password=$_POST["password"];
        
        //$phone=$_POST[phone];
        include 'connect.php';
        $result=mysql_query("SELECT nick FROM players WHERE email='".$email."' AND deleted=0");
        $num=mysql_numrows($result);
        if($num!==0){
            echo "{\"me\":\"$me\",\"su\":\"$su\",\"state\":\"Daný email již používá ".mysql_result($result,0,"nick")."\"}";mysql_close();return;
        }
        $q="insert into players (
            name,
            surname,
            nick,
            email,
            password,
            age,
            phone
            ) values (
            '$name',
            '$surname',
            '$nick',
            '$email',
            '$password',
            '$age',
            '$phone'
            )";
        mysql_query($q);
        //$result=mysql_query("SELECT id FROM players WHERE email='".$email."'");
        $result2 = mysql_query("select last_insert_id()");
        $id = mysql_result($result2,0,"last_insert_id()");
        
        include 'changes.php';
        add_change("ucastnici","all");
        mysql_close();
        $prihlasen=true;
        $_SESSION['idx'] = $id;
        $_SESSION['email'] = $email;
        $state="{
            \"me\":\"$me\",
            \"su\":\"$su\",
            \"state\":\"ok\",
            \"log\":{
                \"id\":".$id.",
                \"name\":\"".$name."\",
                \"surname\":\"".$surname."\",
                \"nick\":\"".$nick."\",
                \"email\":\"".$email."\",
                \"age\":".$age.",
                \"phone\":\"".$phone."\",
                \"title\":\"0\",
                \"zapl\":\"0\"
            }
        }";
        
    }
    echo $state;
    exit;
    
function resizeFoto($image){
    $width=imagesx($image);
    $height=imagesy($image);
    $tmp=imagecreatetruecolor(75,100);
    imagecopyresampled($tmp,$image,0,0,0,0,75,100,$width,$height);
    imagedestroy($image);
    return $tmp;
}
/*function getExtension($str) {
 $i = strrpos($str,".");
 if (!$i) { return ""; }
 $l = strlen($str) - $i;
 $ext = substr($str,$i+1,$l);
 return $ext;
}
function prepareFoto($filename,$uploadedfile){
    //global $width, $height;
    $extension = strtolower(getExtension($filename));
    if (($extension != "jpg") && ($extension != "jpeg")&& ($extension != "png") && ($extension != "gif"))echo ' Neznámý typ obrázku ';
    if($extension=="jpg" || $extension=="jpeg" ){
        $src = imagecreatefromjpeg($uploadedfile);
    }else if($extension=="png"){
        $src = imagecreatefrompng($uploadedfile);
    }else{
        $src = imagecreatefromgif($uploadedfile);
    }
    return $src;
}*/


?>
