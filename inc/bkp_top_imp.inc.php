<? include("inc/conn_externa.inc.php");

	function formatCurrencyPrint($Valor) {
		if (strlen($Valor) == 0)
			return "0,00";
		if (strpos($Valor,".") === false){
			$Valor.= ",";
			$positionPot = strlen($Valor) - 1;
		}else
			$positionPot = strpos($Valor,".");
			
		$Valor.= substr("00",0,2 - ((strlen($Valor) - 1) - $positionPot));
		$Valor = str_replace(".",",",$Valor);
		for ($x = 6; $x < strlen($Valor); $x+= 4)
			$Valor = substr($Valor,0,strlen($Valor) - $x) . "." . substr($Valor,strlen($Valor) - x);
		return $Valor;
	}


function situacao($value) {
	switch($value) {
		case "P":
				return "Procedente";
			break;
		case "I":
				return "Improcedente";
			break;
		default:
				return "";
	}
}
function status($value) {
	switch($value) {
		case "1":
				return "Em aberto";
			break;
		case "3":
				return "Encerrado";
			break;
		default:
				return "";
	}
}
  
	$Criterios = "";
	$SqlCriterios = "";
	if (trim($_POST['LANCA_NUMRAR'])) {
		$SqlCriterios.= "AND L.LANCA_NUMRAR = '" .$_POST['LANCA_NUMRAR']. "' ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."N.º Reclamação: " .$_POST['LANCA_NUMRAR'];
	}
	if (trim($_POST['LANCA_FABRI_IDO'])) {
		$SqlCriterios.= "AND L.LANCA_FABRI_IDO = '" .$_POST['LANCA_FABRI_IDO']. "' ";
		$Stmt = @mysql_query("SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['LANCA_FABRI_IDO']. "'");
		@ociexecute($Stmt);
		@ocifetch($Stmt);
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Fabricante: " .ociresult($Stmt,"NOME");
	}
	if (trim($_POST['LANCA_PESSOA'])) {
		$SqlCriterios.= "AND L.LANCA_PESSOA = '" .$_POST['LANCA_PESSOA']. "' ";
		$Stmt = @mysql_query("SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['LANCA_PESSOA']. "'");
		@ociexecute($Stmt);
		@ocifetch($Stmt);
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Cliente: " .ociresult($Stmt,"NOME");
	}
	if (trim($_POST['LINHA'])) {
		$SqlCriterios.= "AND SUBSTR(I.ITEM_REFERENCIA,1,4) = '" .$_POST['LINHA']. "' ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Linha: " .$_POST['LINHA'];
	}
	if (trim($_POST['MODELO'])) {
		$SqlCriterios.= "AND SUBSTR(I.ITEM_REFERENCIA,5,4) = '" .$_POST['MODELO']. "' ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Modelo: " .$_POST['MODELO'];
	}
	if (trim($_POST['LANCA_DATAABERTURAI']) && trim($_POST['LANCA_DATAABERTURAF'])) {
		$SqlCriterios.= "AND L.LANCA_DATAABERTURA BETWEEN TO_DATE('" . $_POST['LANCA_DATAABERTURAI']. " 00:00','dd/mm/yyyy HH24:MI') AND TO_DATE('" . $_POST['LANCA_DATAABERTURAF']. " 23:59','dd/mm/yyyy HH24:MI') ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data de abertura: " .$_POST['LANCA_DATAABERTURAI'] . " até ".$_POST['LANCA_DATAABERTURAF'];
	}
	if (trim($_POST['AVALI_AREZ_DATAI']) && trim($_POST['AVALI_AREZ_DATAF'])) {
		$SqlCriterios.= "AND A.AVALI_AREZ_DATA BETWEEN TO_DATE('" . $_POST['AVALI_AREZ_DATAI']. " 00:00','dd/mm/yyyy HH24:MI') AND TO_DATE('" . $_POST['AVALI_AREZ_DATAF']. " 23:59','dd/mm/yyyy HH24:MI') ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data de avaliação: " .$_POST['AVALI_AREZ_DATAI'] ." até " .$_POST['AVALI_AREZ_DATAF'];
	}
	if (trim($_POST['LANCA_STATUS'])) {
		$SqlCriterios.= "AND L.LANCA_STATUS = '" .$_POST['LANCA_STATUS']. "' ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Status da reclamação: " .status($_POST['LANCA_STATUS']);
	}
	if (trim($_POST['AVALI_SITUACAO'])) {
		$SqlCriterios.= "AND A.AVALI_SITUACAO = '" .$_POST['AVALI_SITUACAO']. "' ";
		$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Situação da reclamação: " .situacao($_POST['AVALI_SITUACAO']);
	}
?>
<html>
<head>
<link href="wfa.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 5px;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
}
-->
</style>
<title><?=$Title?></title>
<style type="text/css">
<!--
.style3 {font-size: 18px}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="77%" rowspan="2" class="imp_normal_bot"><img src="imagens/logotipo_impressao.JPG" width="141" height="41"></td>
    <td width="23%" height="10%" class="imp_normal">&nbsp;</td>
  </tr>
  <tr>
    <td  class="imp_normal_bot"><div align="right">Data de emiss&atilde;o:
        <?=date("d/m/Y")?>
    </div></td>
  </tr>
  <tr>
    <td height="39" colspan="2"><div align="center" class="TextNormal_12Negrito style3"><strong><?=$Title?><br>
</strong></div></td>
  </tr>
  <tr valign="top">
    <td height="17" colspan="2" class="imp_normal_bot"><strong>Crit&eacute;rios da pesquisa : </strong>
    <?=$Criterios?></td>
  </tr>
  <tr valign="top">
    <td height="15" colspan="2" class="imp_normal">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">