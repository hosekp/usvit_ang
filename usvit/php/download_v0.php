<?php
    include 'corrector.php';
    if (isset($_GET["u1"])){
        $u1=$_GET["u1"];
    }else{$u1=null;}
    if (isset($_GET["u2"])){
        $u2=$_GET["u2"];
    }else{$u2=null;}
    if (isset($_GET["u3"])){
        $u3=$_GET["u3"];
    }else{$u3=null;}
    if(isset($u1)){
        if($u1==="articles"){
            if(isset($u2)){
                $fil = file_get_contents("../data/articles.json");
                $arts = json_decode($fil);
                $ret=array();
                if($u2=="art"){
                    if(isset($u3)){
                        foreach ($arts as $art) {
                            if($art["id"]!=$u3){continue;}
                            $ret=$art;
                            break;
                        }
                    }
                }else
                if($u1=="all"){
                    foreach ($arts as $art) {
                        if($art["categ"]=="home"){continue;}
                        $art["long"]=null;
                        array_push($ret, $art);
                    }
                }else{
                    foreach ($arts as $art) {
                        if($art["categ"]!==$u2){continue;}
                        $art["long"]=null;
                        array_push($ret, $art);
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
        if($u1=="ucastnici"){
            $fil = file_get_contents("../data/ucastnici.json");
            $ucas = json_decode($fil);
            if(isset($u2)){
                $ret=array();
                foreach ($ucas as $uca) {
                    if($uca["id"]==$u2){
                        $ret["id"]=$u2;
                        $ret["text"]=$uca["text"];
                        break;
                    }
                }
                $jret=json_encode($ret);
                
                echo $jret;
                return;
            }else{
                $ret=[];
                foreach ($ucas as $uca) {
                    $cuca = array();
                    foreach ( array(["id","name","surname","nick","gamenick","frac","title","photo","appr","zapl"]) as $key) {
                        $cuca[$key] = $uca[$key];
                    }
                    array_push($ret, $cuca);
                }
                $jret=json_encode($ret);
                echo $jret;
                return;
            }
        }
        if($u1=="uca_right"){
            $fil = file_get_contents("../data/ucastnici.json");
            $ucas = json_decode($fil);
            
            $ret = array_map(function($uca){return $uca["nick"];}, $ucas);
            $jret=json_encode($ret);
            echo $jret;
            return;
        }
        if(isset($u2)){
            
        }
    }else{
        echo '{"state":"no_params_set"}';
    }
?>