<?php
include 'corrector.php';
$categ=false;
$type=false;
$id=false;
if(isset($_GET["categ"])){
    $categ=$_GET["categ"];
}
if(isset($_GET["type"])){
    $type=$_GET["type"];
}
if(isset($_GET["ID"])){
    $id=$_GET["ID"];
}
    if(isset($categ)){
        if($categ==="art"){
            if(isset($type)){
                $fil = file_get_contents("../data/articles.json");
                $arts = json_decode($fil,true);
                //echo $arts;
                $ret=array();
                if($type=="query"){
                    foreach ($arts as $art) {
                        //if($art["categ"]=="home"){continue;}
                        $art["long"]=null;
                        array_push($ret, $art);
                    }
                }
                if($type=="detail"){
                    if(isset($id)){
                        foreach ($arts as $art) {
                            if($art["id"]!=$id){continue;}
                            $ret["long"]=$art["long"];
                            break;
                        }
                    }
                }
                $jret=json_encode($ret);
                echo $jret;
                return;
            }else{
                echo "[]";
                return;
            }
        }
        if($categ=="uca"){
            if(isset($type)){
                $fil = file_get_contents("../data/ucastnici.json");
                $ucas = json_decode($fil,true);
                $ret=array();
                if($type=="list"){
                    $ret = array_map(function($uca){return $uca["nick"];}, $ucas);
                }
                if($type=="query"){
                    foreach ($arts as $art) {
                        //if($art["categ"]=="home"){continue;}
                        $art["text"]=null;
                        array_push($ret, $art);
                    }
                }
                if($type=="detail"){
                    if(isset($id)){
                        foreach ($ucas as $uca) {
                            if($uca["id"]!=$id){continue;}
                            $ret["text"]=$uca["text"];
                            break;
                        }
                    }
                }
                $jret=json_encode($ret);
                
                echo $jret;
                return;
            }else{
                echo "{}";
                return;
            }
        }
    }else{
        echo '{"state":"no_params_set"}';
    }
?>