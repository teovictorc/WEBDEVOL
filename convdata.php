<?
function convdata($dt) { 
    if ($dt=="0000-00-00") return ''; 
    $yr=strval(substr($dt,0,4)); 
    $mo=strval(substr($dt,5,2)); 
    $da=strval(substr($dt,8,2)); 
    return date("d/m/Y", mktime (0,0,0,$mo,$da,$yr));
}
?>