<?php
$link = @mysql_connect("sql13.pipni.cz","us.thilisar.cz","vlkodav");
if (!$link) {
    $link = mysql_connect("localhost","root","");
    @mysql_select_db("usvit") or die( "Unable to select database");
}else{
    @mysql_select_db("us_thilisar_cz") or die( "Unable to select database");
}
//mysql_select_db("us_thilisar_cz")
mysql_query("SET NAMES 'UTF8'");
//mysql_connect("localhost","root","");
//@mysql_select_db("sw") or die( "Unable to select database");
//mysql_query("SET NAMES 'UTF8'");
?>
