<?php

function get_changes($frac,$last_visit){
    //if(!isset($_SESSION['idx'])){return "{}";}
    //$c_id=$_SESSION['idx'];
    $c_qadd="(permis='$frac' OR permis='all') AND";
    if($frac==="cp"){$c_qadd="";}
    $c_q="SELECT section FROM changes WHERE $c_qadd time > '$last_visit'";
//    echo $c_q;
    $c_result=mysql_query($c_q);
    $c_num=mysql_numrows($c_result);
    if($c_num==0){return "{}";}
    $c_arr=array("forum" => 0,"znalosti" => 0, "ucastnici" => 0, "pravidla" => 0, "news" => 0,"home" => 0, "info" => 0);
    for ($c=0;$c<$c_num;$c++){
        $c_sec=mysql_result($c_result,$c,"section");
        if(!isset($c_arr[$c_sec])){continue;}
        $c_arr[$c_sec]++;
    };
    $c_ret="{";$c_first=true;
    foreach ($c_arr as $c_key => $c_value) {
        if($c_first){$c_first=false;}else{$c_ret.=",";}
        $c_ret.="\"$c_key\":$c_value";
    }
    return $c_ret."}";
    
    
}
function add_change($c_sec,$c_permis){
    $c_q="insert into changes (section,permis) values ('$c_sec','$c_permis')";
    mysql_query($c_q);
}
function renew($c_id){
    $c_q="update players set last_visit=NOW() WHERE id=$c_id";
    mysql_query($c_q);
}
?>
