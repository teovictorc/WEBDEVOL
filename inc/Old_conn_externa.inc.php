<?
	include("cache.inc.php");
	$Conn = mysql_connect("localhost","arezzowfa","c3j6qt2"); //USUARIO,SENHA,DB
	//$Conn = mysql_connect("mysql.iphotel.com.br","freehold","ms170359"); //USUARIO,SENHA,DB
	mysql_select_db("arezzowfa",$Conn);
	//mysql_select_db("freehold",$Conn);
	$PaginaDeErro = "acesso_negado.php";
//VARIAVEIS GLOBAIS
	$MailDefault = "usuario@domain.com.br"; // um e-mail válido, preciso configurar o mail
	$PathImagens = "C:/Inetpub/wwwroot/AREZZO_mysql/fotos/"; //Precisa de permissão de Escrita e Leitura
	//$PathImagens = "D:/http/freehold/web/arezzo/Rarweb/fotos/"; //Precisa de permissão de Escrita e Leitura
	

	function newIDO() {
	   global $Conn;
	   $stmIDO = mysql_query("select max(ido) CODIGO from seq",$Conn);
	   $Rs = mysql_fetch_assoc($stmIDO);
	   mysql_query("UPDATE SEQ SET IDO = IDO + 1",$Conn);
	   return $Rs["CODIGO"];
	}
	
	function modifyData($dataValue) {
		return strtoupper($dataValue);
	}
	
	function arrumaPessoa($value) {
		return substr("00000",0,5 - strlen($value)) . $value;
	}
	
	function formatadata($value) {
		return substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);
	}
	
	function formatCurrency($value) {
		return str_replace(",",".",substr($value,0,strlen($value) - 3)) .",". substr($value,strlen($value) - 2);
	}
	function returnAcess($CodAcesso) {
		global $Conn;
		$Sql = "SELECT ACESS_TIPOACESSO FROM RAR_ACESSO WHERE ACESS_USUAR_IDO = " .$_SESSION['sId']. " AND ACESS_PROGR_CODIGO = '" .$CodAcesso. "'";
		$StmtAcess = mysql_query($Sql,$Conn);
		if ($Rs = mysql_fetch_assoc($StmtAcess))
			return $Rs["ACESS_TIPOACESSO"];
		else
			return "N";
	}
	function verifyAcess($CodAcesso,$OptionMin) {
		$option = returnAcess($CodAcesso);
		if ($option == "N" || ($option == "S" && $OptionMin == "T"))
			//die("<script>document.location.href='" .$PaginaDeErro. "';</script>");
			die("<script>document.location.href='acesso_negado.php';</script>");
	}
?>