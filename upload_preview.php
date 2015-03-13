<?php
$dataAtual = getdate();
$dataStr = $dataAtual["mday"] . "-". $dataAtual["wday"] . "-" . $dataAtual["year"] . "--" . $dataAtual["hours"] . "_" . $dataAtual["minutes"] . "_" . $dataAtual["seconds"];

$uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/webdevol/uploads/';
$uploadfile = $uploaddir . $dataStr . basename($_FILES['foto']['name']);

move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);

if ((filesize($uploadfile) / 1024) < 200)
{
    echo ('/webdevol/uploads/' . $dataStr . basename($_FILES['foto']['name']));
}
else
{
    unlink($uploadfile);
    echo ("#TAMANHOINVALIDO#");
}

?>