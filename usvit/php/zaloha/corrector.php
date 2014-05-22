<?php
function correct($data){
    $data=preg_replace("/\r/","",$data);
    //$data=preg_replace("/\n/","",$data);
    //$data=preg_replace("/\"/","\\\"",$data);
    $data=preg_replace("/\n\s/","",$data);
    $data=preg_replace("/\s\s+/","",$data);
    return $data;
}
function valid($data){
    $data = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
 '|[\x00-\x7F][\x80-\xBF]+'.
 '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
 '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
 '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
 '?', $data );
 
//reject overly long 3 byte sequences and UTF-16 surrogates and replace with ?
$data = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]'.
 '|\xED[\xA0-\xBF][\x80-\xBF]/S','?', $data );
    $data=preg_replace("/\r/","\\r",$data);
    $data=preg_replace("/\n/","\\n",$data);
    $data=preg_replace("/\"/","\\\"",$data);
    return $data;
}
/*entries.add("\"" + varName + "\""" + (readFile(file, false)
                .replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("/", "\\/")
                .replace("\b", "\\\b")
                .replace("\f", "\\\f")
                .replace("\n", "\\\n")
                .replace("\r", "\\\r")
                .replace("\t", "")) + "\"");*/
?>
