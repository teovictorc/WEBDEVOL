<?	include("cache.inc.php");	
    //$Conn = mysql_connect("mysql1070.locaweb.com.br","andarella1","c3j6qt2"); 
    //USUARIO,SENHA,DB

	$Conn = mysql_connect("192.168.10.251:7543","root","c3j6qt2"); //USUARIO,SENHA,DB    
	mysql_select_db("andarella1",$Conn);	
	$NomeDesenvolvedor = "";	
	$FoneDesenvolvedor = "";	
	$CelDesenvolvedor  = "";	
	$EmailDesenvolvedor= '<a href="mailto:freehold@freehold.com.br" class="email">freehold@freehold.com.br</a>';	
	$EmailDesenvolvedor= '';	
	$RodapeDesenvolvedor= $NomeDesenvolvedor . "<br>" . $FoneDesenvolvedor . " - " . $CelDesenvolvedor . " - " . $EmailDesenvolvedor;		
	//VARiAVEIS P/ PAGINACAO DO SCRIPT 
	//inc/paginator.inc.php - site: http:
	//jpinedo.webcindario.com/scripts/paginator/	
	$_pagi_cuantos 			= 20;		
	//qtd de registros exibidos por pagina	
	$_pagi_nav_num_enlaces	= 30;		
	//qtd de paginas de resultado	
	$_pagi_nav_anterior 	= "&lt;";	
	//simbologia p/ indicar pagina anterior	
	$_pagi_nav_siguiente 	= "&gt;";	
	//simbologia p/ indicar proxima pagina	
	$_pagi_separador		= " - "	;	
	//simbolo utilizado como separador das paginas	
	$_pagi_conteo_alternativo = true;	
	$PaginaDeErro = "acesso_negado.php";	
	$NomeSistema = "WebDevol | Andarella";		
	//VARIAVEIS GLOBAIS	
	$MailDefault = "webdevol@freehold.com.br"; 
	// um e-mail válido, preciso configurar o mail	
	//$PathImagens = "C:/Inetpub/wwwroot/andarella_mysql/fotos/"; 
	//Precisa de permissão de Escrita e Leitura	
	$PathImagens = "C:/Inetpub/wamp/www/webdevol/fotos/"; 
	//Precisa de permissão de Escrita e Leitura	
	$PathImportacao = "/home/andarella1/public_html/importacao/"; 
	//Precisa de permissão de Escrita e Leitura	
	$PathImportacaoVirtual = "/importacao/"; 
	//Precisa de permissão de Escrita e Leitura	
	$PathPdvDownload = "/home/andarella1/public_html/rv/"; 
	//Precisa de permissão de Escrita e Leitura	
	
	
	function newIDO() {

	   global $Conn;

	   $stmIDO = mysql_query("select max(ido) CODIGO from ido",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   mysql_query("UPDATE IDO SET IDO = IDO + 1",$Conn);

	   return $Rs["CODIGO"];

	}

	

	function newIDOCob() {

	   global $Conn;

	   $stmIDO = mysql_query("select max(nota_debito) CODIGO from ido",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   mysql_query("UPDATE IDO SET nota_debito = nota_debito + 1",$Conn);

	   return $Rs["CODIGO"];

	}

	

	function newIDORARCom() {

	   global $Conn;

	   $stmIDO = mysql_query("select max(rar_comercial) CODIGO from ido",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   mysql_query("UPDATE IDO SET rar_comercial = rar_comercial + 1",$Conn);

	   return $Rs["CODIGO"];

	}

	

	function newIDOPDV() {

	   global $Conn;

	   $stmIDO = mysql_query("select max(rar_pdv) CODIGO from ido",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   mysql_query("UPDATE IDO SET rar_pdv = rar_pdv + 1",$Conn);

	   return $Rs["CODIGO"];

	}

	

	function newIDOIAF() {

	   global $Conn;

	   $stmIDO = mysql_query("select max(rar_iaf) CODIGO from ido",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   mysql_query("UPDATE IDO SET rar_iaf = rar_iaf + 1",$Conn);

	   return $Rs["CODIGO"];

	}

	

	function Usuario($Usuar_ido) {

	   global $Conn;

	   $stmIDO = mysql_query("select usuar_nome from rar_usuario where usuar_ido = '".$Usuar_ido."'",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   return $Rs["usuar_nome"];

	}

	

	function Pessoa($Pessoa) {

	   global $Conn;

	   $stmIDO = mysql_query("select nome from pessoa where pessoa = '".$Pessoa."'",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   return $Rs["nome"];

	}

	

	function Fabricante($cd_item_material) {

	   global $Conn;

	   $Sql = "select distinct".

			   " peco.PESSOA_FORNECEDOR as CODIGO_PESSOA".

			   " ,pess.NOME as NOME".

			   " ,pess.CGCCPF as CNPJ".

			   " ,itpv.CD_ITEM_MATERIAL as REFERENCIA".

		" from item_pedido_compra itpv".

			  " ,pedido_compra      peco".

			  " ,pessoa             pess".

		" where peco.num_pedd_compra   = itpv.num_pedd_compra ".

		  " and peco.pessoa_empresa    = itpv.pessoa_empresa".

		  " and peco.pessoa_fornecedor = pess.pessoa ".

		  " and itpv.cd_item_material = '".$cd_item_material. "' ";

	   	$stmIDO = mysql_query($Sql,$Conn);

		

	  	if ($Rs = mysql_fetch_assoc($stmIDO)){

			return $Rs["NOME"];

		}else{

			return $Rs["Não encontrado"];

		}

	}

	

	function CodigoFabricante($cd_item_material) {

	   global $Conn;

	   $Sql = "select distinct".

			   " peco.PESSOA_FORNECEDOR as CODIGO_PESSOA".

			   " ,pess.NOME as NOME".

			   " ,pess.CGCCPF as CNPJ".

			   " ,itpv.CD_ITEM_MATERIAL as REFERENCIA".

		" from item_pedido_compra itpv".

			  " ,pedido_compra      peco".

			  " ,pessoa             pess".

		" where peco.num_pedd_compra   = itpv.num_pedd_compra ".

		  " and peco.pessoa_empresa    = itpv.pessoa_empresa".

		  " and peco.pessoa_fornecedor = pess.pessoa ".

		  " and itpv.cd_item_material = '".$cd_item_material. "' ";

	   	$stmIDO = mysql_query($Sql,$Conn);

		

	  	if ($Rs = mysql_fetch_assoc($stmIDO)){

			return $Rs["CODIGO_PESSOA"];

		}else{

			return "Null";

		}

	}

	

	/*function PrevisaoConclusao($Servi_numero) {

	   global $Conn;

	   $stmIDO = mysql_query("SELECT DATE_ADD( servi_dataabertura, INTERVAL servi_prazo1 + servi_prazo2 DAY ) PREVISAO FROM rar_servico where Servi_numero = '".$Servi_numero."'",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   return $Rs["PREVISAO"];

	}*/

	

	function PrevisaoConclusao($Servi_numero) {

	   	global $Conn;

		$Sql = "SELECT servi_dataabertura, ";

		$Sql.= "       DATE_ADD( servi_dataabertura, INTERVAL servi_prazo1 + servi_prazo2 DAY ) PREVISAO, ";

		$Sql.= "       servi_prazo1 + servi_prazo2 prazo ";

		$Sql.= "  FROM rar_servico ";

		$Sql.= " where Servi_numero = '".$Servi_numero."'";

	   	$stmIDO = mysql_query($Sql,$Conn);

	   	$Rs = mysql_fetch_assoc($stmIDO);

		$Prazo = $Rs["prazo"];

		

		$Data = "Diferença: ".$Rs["DIFERENCA_DIAS"]." - Abertura: ".$Rs["servi_dataabertura"] ." - Prazo: " .$Rs["prazo"] ." - Previsao: " .$Rs["PREVISAO"];

		$Data1 = "";

		$x = 0;

		for ($i = 1; $i <= $Rs["prazo"]; $i++) {

			$Sql = "SELECT weekday(DATE_ADD( servi_dataabertura, INTERVAL " .$i." DAY )) dia ";

			$Sql.= "  FROM rar_servico ";

			$Sql.= " where Servi_numero = '".$Servi_numero."'";

			$stmIDO = mysql_query($Sql,$Conn);

	   		$RsD = mysql_fetch_assoc($stmIDO);

			if ($RsD["dia"] == "5"){

				$Prazo = $Prazo + 2;

			}

			

			if ($RsD["dia"] == "6"){

				$Prazo = $Prazo + 1;

			}

	    }

		

		$Sql = "SELECT servi_dataabertura, ";

		$Sql.= "       DATE_ADD( servi_dataabertura, INTERVAL " .$Prazo." DAY ) PREVISAO";

		$Sql.= "  FROM rar_servico ";

		$Sql.= " where Servi_numero = '".$Servi_numero."'";

		$stmIDO = mysql_query($Sql,$Conn);

	   	$Rs = mysql_fetch_assoc($stmIDO);

	   	return $Rs["PREVISAO"];

	}

	

	function Atraso($Servi_numero) {

	   global $Conn;

	   $stmIDO = mysql_query("SELECT datediff(now(), servi_dataabertura) DIAS_DECORRIDOS, servi_prazo1 + servi_prazo2 AS PRAZO FROM rar_servico where Servi_numero = '".$Servi_numero."'",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   if ($Rs["PRAZO"] < $Rs["DIAS_DECORRIDOS"]){

		   	return "NOK"; //atrasado

	   }else{

	   		return "OK"; //no prazo

	   }

	}

	

	



		

	function Equipe($Equip_ido) {

	   global $Conn;

	   $stmIDO = mysql_query("select equip_nome from rar_equipe where Equip_ido = '".$Equip_ido."'",$Conn);

	   $Rs = mysql_fetch_assoc($stmIDO);

	   return $Rs["equip_nome"];

	}

	

	function FormataDataHora($Data){

		if ($Data != ""){

			$Temp = substr($Data,8,2)."/".substr($Data,5,2)."/".substr($Data,0,4).substr($Data,10,6);

		}else{

			$Temp = "";

		}

		return $Temp;

	}

	

	function FormataCnpj($Cnpj){

		if ($Cnpj != ""){

			$Temp = substr($Cnpj,0,2).".".substr($Cnpj,2,3).".".substr($Cnpj,5,3)."/".substr($Cnpj,8,4)."-".substr($Cnpj,12,2);

		}else{

			$Temp = "";

		}

		return $Temp;

	}

	

	function newServico($Pessoa){

		$Sql = "SELECT * FROM RAR_CLIENTE_COLETA WHERE CLIEN_COL_PESSOA = '" .$Pessoa. "'";

		$Stmt = mysql_query($Sql);

		if (!$Rs = mysql_fetch_assoc($Stmt)){

			$SQL = "insert into rar_cliente_coleta (clien_col_pessoa) values ('".$Pessoa."')";

			$StmtE = mysql_query($SQL);

		}

			

		$Sql = "SELECT * FROM RAR_CLIENTE_COLETA WHERE CLIEN_COL_PESSOA = '" .$Pessoa. "'";

		$Stmt = mysql_query($Sql);

	

		$ID = intval($Rs["CLIEN_SEQ_SERVICO"]) + 1;

		$Sql = "UPDATE RAR_CLIENTE_COLETA SET CLIEN_SEQ_SERVICO = CLIEN_SEQ_SERVICO + 1 WHERE CLIEN_COL_PESSOA = '" .$Pessoa. "'";

		$Stmt = mysql_query($Sql);

		return $ID;

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

		return number_format($value, 2, ',', '.');

		//return str_replace(",",".",substr($value,0,strlen($value) - 3)) .",". substr($value,strlen($value) - 2);

	}



	function formatNumber( $number, $decimals=2, $dec_point=".", $thousands_sep=",") {

	   $nachkomma = abs($in - floor($in));

	   $strnachkomma = number_format($nachkomma , $decimals, ".", "");



	   for ($i = 1; $i <= $decimals; $i++) {

		   if (substr($strnachkomma, ($i * -1), 1) != "0") {

			   break;

		   }

	   }



	   return number_format($in, ($decimals - $i +1), $dec_point, $thousands_sep);

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



	function TipoUsuario() {

		global $Conn;

		$Sql = "SELECT USUAR_TIPOUSUARIO FROM RAR_USUARIO WHERE USUAR_IDO = " .$_SESSION['sId']. "";

		$StmtAcess = mysql_query($Sql,$Conn);

		if ($Rs = mysql_fetch_assoc($StmtAcess))

			return $Rs["USUAR_TIPOUSUARIO"];

		else

			return "";

	}



	function strdata2db($strdata){

        $posbarra = strpos($strdata,"/");

        $dia = substr($strdata,0,$posbarra);

        $strdata = substr($strdata,$posbarra + 1);

        $posbarra = strpos($strdata,"/");

        $mes = substr($strdata,0,$posbarra);

        $ano = substr($strdata,$posbarra + 1);

        if(!checkdate($mes,$dia,$ano))

            {

            return false;

            }

        else

            {

            $data_db = $ano."-".$mes."-".$dia;

            return $data_db;

            }

        }



	function verifyAcess2($CodAcesso,$OptionMin,$CodAcesso2) {

		$option = returnAcess($CodAcesso);

		if ($option == "N" || ($option == "S" && $OptionMin == "T")){

			$option = returnAcess($CodAcesso2);

			if ($option == "N" || ($option == "S" && $OptionMin == "T")){

				die("<script>document.location.href='acesso_negado.php';</script>");

			}

		}

	}

	

	function verifyAcess($CodAcesso,$OptionMin) {

		$option = returnAcess($CodAcesso);

		if ($option == "N" || ($option == "S" && $OptionMin == "T"))

			die("<script>document.location.href='acesso_negado.php';</script>");

	}

	

	function ConverteHora($Hora) {

	   	switch($Hora){

		   	case  0:

				return "07:00";

			  	break;

		   	case  1:

				return "07:30";

			  	break;

			case 2:

				return "08:00";

			  	break;

			case 3:

				return "08:30";

			  	break;

			case 4:

				return "09:00";

			  	break;

			case 5:

				return "09:30";

			  	break;

			case 6:

				return "10:00";

			  	break;

			case 7:

				return "10:30";

			  	break;

			case 8:

				return "11:00";

			  	break;

			case 9:

				return "11:30";

			  	break;

			case 10:

				return "12:00";

			  	break;

			case 11:

				return "12:30";

			  	break;

			case 12:

				return "13:00";

			  	break;

			case 13:

				return "13:30";

			  	break;

			case 14:

				return "14:00";

			  	break;

			case 15:

				return "14:30";

			  	break;

			case 16:

				return "15:00";

			  	break;

			case 17:

				return "15:30";

			  	break;

			case 18:

				return "16:00";

			  	break;

			case 19:

				return "16:30";

			  	break;

			case 20:

				return "17:00";

			  	break;

			case 21:

				return "17:30";

			  	break;

			case 22:

				return "18:00";

			  	break;

			case 23:

				return "18:30";

			  	break;

			case 24:

				return "19:00";

			  	break;

			case 25:

				return "19:30";

			  	break;

			case 26:

				return "20:00";

			  	break;

			case 27:

				return "20:30";

			  	break;

			case 28:

				return "21:00";

			  	break;

			case 29:

				return "21:30";

			  	break;

			case 30:

				return "22:00";

			  	break;

			case 31:

				return "22:30";

			  	break;

			case 32:

				return "23:00";

			  	break;

		}  

	}

	

	function ReConverteHora($Hora) {

		

		if (substr($Hora,3,2) != "00" && substr($Hora,3,2) != "30"){

			switch (substr($Hora,3,1)){

				case "0":

					$Hora = substr($Hora,0,3)."00";

				case "1":

					$Hora = substr($Hora,0,3)."00";

				case "2":

					$Hora = substr($Hora,0,3)."00";

				case "3":

					$Hora = substr($Hora,0,3)."30";

				case "4":

					$Hora = substr($Hora,0,3)."30";

				case "5":

					$Hora = substr($Hora,0,3)."30";

			}

		}

		

	   	switch($Hora){

		   	case "07:00":

				return 0;

			  	break;

		   	case "07:30":

				return 1;

			  	break;

			case "08:00":

				return 2;

			  	break;

			case "08:30":

				return 3;

			  	break;

			case "09:00":

				return 4;

			  	break;

			case "09:30":

				return 5;

			  	break;

			case "10:00":

				return 6;

			  	break;

			case "10:30":

				return 7;

			  	break;

			case "11:00":

				return 8;

			  	break;

			case "11:30":

				return 9;

			  	break;

			case "12:00":

				return 10;

			  	break;

			case "12:30":

				return 11;

			  	break;

			case "13:00":

				return 12;

			  	break;

			case "13:30":

				return 13;

			  	break;

			case "14:00":

				return 14;

			  	break;

			case "14:30":

				return 15;

			  	break;

			case "15:00":

				return 16;

			  	break;

			case "15:30":

				return 17;

			  	break;

			case "16:00":

				return 18;

			  	break;

			case "16:30":

				return 19;

			  	break;

			case "17:00":

				return 20;

			  	break;

			case "17:30":

				return 21;

			  	break;

			case "18:00":

				return 22;

			  	break;

			case "18:30":

				return 23;

			  	break;

			case "19:00":

				return 24;

			  	break;

			case "19:30":

				return 25;

			  	break;

			case "20:00":

				return 26;

			  	break;

			case "20:30":

				return 27;

			  	break;

			case "21:00":

				return 28;

			  	break;

			case "21:30":

				return 29;

			  	break;

			case "22:00":

				return 30;

			  	break;

			case "22:30":

				return 31;

			  	break;

			case "23:00":

				return 32;

			  	break;

		}  

	}



	function EncaixaHorario($hora) {

		$Horas = (substr($hora,0,2));

		$Minutos = (substr($hora,3,2));

		

		if ($Minutos == 0){

			$Hora = $Horas.":00";

		}

		

		if ($Minutos > 0 && $Minutos < 15){

			$Hora = $Horas.":00";

		}

		if ($Minutos >= 15 && $Minutos < 30){

			$Hora = $Horas.":30";

		}

		if ($Minutos >= 30 && $Minutos <= 45){

			$Hora = $Horas.":30";

		}

		if ($Minutos > 45 && $Minutos <= 60){

			$Horas = $Horas+1;

			if ($Horas < 10){

				$Hora = "0".$Horas.":00";

			}else{

				$Hora = $Horas.":00";

			}

		}

		

		return $Hora;

	}





	function mes($mes){

		switch($mes){

		   	case "1":

				return "Jan";

			  	break;

		   	case "2":

				return "Fev";

			  	break;

			case "3":

				return "Mar";

			  	break;

			case "4":

				return "Abr";

			  	break;

			case "5":

				return "Mai";

			  	break;

			case "6":

				return "Jun";

			  	break;

			case "7":

				return "Jul";

			  	break;

			case "8":

				return "Ago";

			  	break;

			case "9":

				return "Set";

			  	break;

			case "10":

				return "Out";

			  	break;

			case "11":

				return "Nov";

			  	break;

			case "12":

				return "Dez";

			  	break;

		}  

	}

	

	//1 - verifica se tem codigo pessoa

	$Sql = " select * ";

	$Sql.= " from rar_usuario ";

	$Sql.= " where usuar_ido = '" .$_SESSION['sId']."'";

	$Stmt = mysql_query($Sql);

	if ($Rs = mysql_fetch_assoc($Stmt)){

		if ($Rs["USUAR_EFRANQUEADO"] == "S"){

			$CategoriaUsuario = "4";

			$ConsuPessoa = "";

			$AcessaTodaCarteira = "N";

		}else{

			if ($Rs["USUAR_CONSU_PESSOA"] == ""){

				$CategoriaUsuario = "1";

				$ConsuPessoa = "";

				$AcessaTodaCarteira = "N";

			}else{

				$ConsuPessoa = $Rs["USUAR_CONSU_PESSOA"];

				$AcessaTodaCarteira = $Rs["USUAR_ACESSATODACARTEIRA"];

				

				//2 - verifica se é consultor

				$Sql = " select * ";

				$Sql.= " from rar_cliente_estrutura ";

				$Sql.= " where clien_est_consultor = '".$Rs["USUAR_CONSU_PESSOA"]."'";

				$Stmt2 = mysql_query($Sql);

				if (!$Rs2 = mysql_fetch_assoc($Stmt2)){

					$consultor = false;

				}else{

					$consultor = true;

				}

				

				//3 - verifica se é coordenador

				$Sql = " select * ";

				$Sql.= " from rar_cliente_estrutura ";

				$Sql.= " where clien_est_coordenador = '".$Rs["USUAR_CONSU_PESSOA"]."'";

				$Stmt2 = mysql_query($Sql);

				if (!$Rs2 = mysql_fetch_assoc($Stmt2)){

					$coordenador = false;

				}else{

					$coordenador = true;

				}

				

				//se nao for coordenador, nem consultor pode ver tudo

				if ($consultor == false && $coordenador == false){

					$CategoriaUsuario = "1";

				}

				

				//se for coordenador pode ver apropriações cadastradas pelo usuário e por usuários cuja o código de pessoas seja igual um de seus consultores 

				if ($coordenador == true){

					$CategoriaUsuario = "2";

				}

				

				//se for consultor, então somente as apropriações cadastradas pelo usuário poderão ser vistas

				if ($consultor == true){

					$CategoriaUsuario = "3";

				}

			}

		}

		

		//echo("Categoria usuário = ".$CategoriaUsuario. " - ConsuPessoa = ".$ConsuPessoa);

	}

	

	$SqlCoordenador = " SELECT DISTINCT PC.PESSOA, PC.NOME ";

	$SqlCoordenador.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA, PESSOA PC";

	$SqlCoordenador.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$SqlCoordenador.= "       AND PC.PESSOA = CLIEN_EST_COORDENADOR ";

	if ($CategoriaUsuario == "2"){

		$SqlCoordenador.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	if ($CategoriaUsuario == "3"){

		$SqlCoordenador.= "   AND CLIEN_EST_CONSULTOR = '".$ConsuPessoa."'";

	}

	$SqlCoordenador.= " ORDER BY PC.PESSOA";

	

	$SqlConsultor = " SELECT DISTINCT PC.PESSOA, PC.NOME ";

	$SqlConsultor.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA, PESSOA PC";

	$SqlConsultor.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$SqlConsultor.= "       AND PC.PESSOA = CLIEN_EST_CONSULTOR ";

	if ($CategoriaUsuario == "2"){

		$SqlConsultor.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	if ($CategoriaUsuario == "3"){

		$SqlConsultor.= "   AND CLIEN_EST_CONSULTOR = '".$ConsuPessoa."'";

	}

	$SqlConsultor.= " ORDER BY PC.PESSOA";

	

	function IDOUsuarioCoordCons($Pessoa) {

	   	global $Conn;

		if ($Pessoa == ""){

			return "";

		}else{

			$Sql = "select * from rar_usuario where usuar_consu_pessoa = '".$Pessoa."'";

			$stmIDO = mysql_query($Sql,$Conn);

			if ($Rs = mysql_fetch_assoc($stmIDO)){

				return $Rs["USUAR_IDO"];

			}else{

				return "";

			}

		}

	}

	

	function EmailCoordenador($Pessoa) {

	   	global $Conn;

		if ($Pessoa == ""){

			return "";

		}else{

			$Sql = " select * ";

			$Sql.= " from rar_usuario, rar_cliente_estrutura ";

			$Sql.= " where clien_est_consultor = '".$Pessoa."'";

			$Sql.= "       and clien_est_coordenador = usuar_consu_pessoa";

			$stmIDO = mysql_query($Sql,$Conn);

			if ($Rs = mysql_fetch_assoc($stmIDO)){

				if ($Rs["USUAR_EMAILPADRAO"] == "1"){

					return $Rs["USUAR_EMAIL1"];

				}else{

					return $Rs["USUAR_EMAIL2"];

				}

			}else{

				return "-";

			}

		}

	}

	

	function EnvolvidosServico($Servico) {

		$SqlUsuarServico = " select USUAR_IDO, USUAR_NOME ";

		$SqlUsuarServico.= " from rar_usuario, rar_servico ";

		$SqlUsuarServico.= " where usuar_ido = servi_usuar_abertura";

		$SqlUsuarServico.= "       and servi_numero = '".$Servico."'";

		$SqlUsuarServico.= " union ";

		$SqlUsuarServico.= " select USUAR_IDO, USUAR_NOME ";

		$SqlUsuarServico.= "   from rar_usuario, rar_servico";

		$SqlUsuarServico.= "  where usuar_ido = servi_usuar_responsavel";

		$SqlUsuarServico.= "    and servi_numero = '".$Servico."'";

		$SqlUsuarServico.= " union";

		$SqlUsuarServico.= " select USUAR_IDO, USUAR_NOME ";

		$SqlUsuarServico.= " from rar_usuario, rar_servico ";

		$SqlUsuarServico.= " where usuar_ido = servi_usuar_responsavel2 ";

		$SqlUsuarServico.= " 	  and servi_numero = '".$Servico."' ";

		$SqlUsuarServico.= " union ";

		$SqlUsuarServico.= " select USUAR_IDO, USUAR_NOME  ";

		$SqlUsuarServico.= " from rar_usuario, rar_servico ";

		$SqlUsuarServico.= " where usuar_ido = servi_usuar_anjo ";

		$SqlUsuarServico.= " 	  and servi_numero = '".$Servico."' ";

		$SqlUsuarServico.= " union ";

		$SqlUsuarServico.= " select USUAR_IDO, USUAR_NOME  ";

		$SqlUsuarServico.= " from rar_usuario, rar_servico, rar_cliente_estrutura ";

		$SqlUsuarServico.= " where usuar_consu_pessoa = clien_est_consultor ";

		$SqlUsuarServico.= "       and servi_numero = '".$Servico."' ";

		$SqlUsuarServico.= "       and servi_pesso_ido = clien_est_cliente ";

		$SqlUsuarServico.= " union ";

		$SqlUsuarServico.= " select USUAR_IDO, USUAR_NOME  ";

		$SqlUsuarServico.= " from rar_usuario, rar_servico, rar_cliente_estrutura ";

		$SqlUsuarServico.= " where usuar_consu_pessoa = clien_est_coordenador ";

		$SqlUsuarServico.= "       and servi_numero = '".$Servico."' ";

		$SqlUsuarServico.= "       and servi_pesso_ido = clien_est_cliente ";

		$SqlUsuarServico.= " order by usuar_nome";

		return $SqlUsuarServico;

	}

	

	function checkEmail($endereco) {

		if (ereg('^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9\-\.]+$', $endereco)){

			return true;

		}

    	return false;

    }

	

	function verificar_email($email){ 

	   	$mail_correcto = 0; 

	   	//verifico umas coisas 

		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 

		  	if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 

			 	//vejo se tem caracter . 

			 	if (substr_count($email,".")>= 1){ 

					//obtenho a terminação do dominio 

					$term_dom = substr(strrchr ($email, '.'),1); 

					//verifico que a terminação do dominio seja correcta 

				 	if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 

						//verifico que o de antes do dominio seja correcto 

						$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 

						$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 

						if ($caracter_ult != "@" && $caracter_ult != "."){ 

					   		$mail_correcto = 1; 

						} 

				 	} 

		  		} 

	   		} 

		}

		return $mail_correcto;

	} 

	

	$SqlPesqGeral = " SELECT * ";

	$SqlPesqGeral.= " FROM WFA_PESQUISA ";

	$SqlPesqGeral.= " WHERE 1 = 1 ";

	if ($CategoriaUsuario == "2"){

		$SqlPesqGeral.= "   AND PESQU_COORDENADOR = 1";

	}

	if ($CategoriaUsuario == "3"){

		$SqlPesqGeral.= "   AND PESQU_CONSULTOR = 1";

	}

	if ($CategoriaUsuario == "4"){

		$SqlPesqGeral.= "   AND PESQU_FRANQUEADO = 1";

	}

	$SqlPesqGeral.= " ORDER BY PESQU_NOMEMENU";

	

	$SqlPesqAtivo = " SELECT * ";

	$SqlPesqAtivo.= " FROM WFA_PESQUISA ";

	$SqlPesqAtivo.= " WHERE PESQU_ATIVO = 1 ";

	$SqlPesqAtivo.= "       AND date(now()) BETWEEN PESQU_DATA_ini AND pesqu_data_fim ";

	if ($CategoriaUsuario == "2"){

		$SqlPesqAtivo.= "   AND PESQU_COORDENADOR = 1";

	}

	if ($CategoriaUsuario == "3"){

		$SqlPesqAtivo.= "   AND PESQU_CONSULTOR = 1";

	}

	if ($CategoriaUsuario == "4"){

		$SqlPesqAtivo.= "   AND PESQU_FRANQUEADO = 1";

	}

	$SqlPesqAtivo.= " ORDER BY PESQU_NOMEMENU";

	

	$SqlPesqTodas = " SELECT * ";

	$SqlPesqTodas.= " FROM WFA_PESQUISA ";

	$SqlPesqTodas.= " WHERE PESQU_ATIVO = 1 ";

	if ($CategoriaUsuario == "2"){

		$SqlPesqTodas.= "   AND PESQU_COORDENADOR = 1";

	}

	if ($CategoriaUsuario == "3"){

		$SqlPesqTodas.= "   AND PESQU_CONSULTOR = 1";

	}

	if ($CategoriaUsuario == "4"){

		$SqlPesqTodas.= "   AND PESQU_FRANQUEADO = 1";

	}

	$SqlPesqTodas.= " ORDER BY PESQU_NOMEMENU";

	

	$SqlCliente = " SELECT DISTINCT P.PESSOA, P.NOME ";

	$SqlCliente.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA";

	$SqlCliente.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	

	if ($ClienteInativo == false){

		$SqlCliente.= "   AND CLIENTE_ATIVO <> 'N'";

	}

	

	if ($IAFCliente == true){

		if ($IAFPQ_IDO != ""){

			//Seleciona quais categorias vão entrar no IAF

			$SqlTemp = "select * from iaf_pesquisa where iafpq_ido = '".$IAFPQ_IDO."'";

			$stmTemp = mysql_query($SqlTemp,$Conn);

			$SqlTemp = "";

			if ($RsIAF = mysql_fetch_assoc($stmTemp)){

				if ($RsIAF["IAFPQ_FRANQUIA"] == "1"){

					$SqlTemp = "8";

				}

				

				if ($RsIAF["IAFPQ_MULTIMARCAFRANQUIA"] == "1"){

					if ($SqlTemp != ""){

						$SqlTemp.=",";

					}

					$SqlTemp.= "9";

				}

				

				if ($RsIAF["IAFPQ_MULTIMARCA"] == "1"){

					if ($SqlTemp != ""){

						$SqlTemp.=",";

					}

					$SqlTemp.= "10";

				}

			}

			$SqlCliente.= "   AND CATEGORIA_CLIENTE IN (".$SqlTemp.")";

		}else{

			$SqlCliente.= "   AND CATEGORIA_CLIENTE IN (8)";

		}

	}

	

	if ($CategoriaUsuario == "2"){

		$SqlCliente.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	

	if ($CategoriaUsuario == "3"){

		if ($IAFCliente == true){

			$SqlCliente.= "       and clien_est_consultor = '".$ConsuPessoa."'";

		}else{

			if ($AcessaTodaCarteira == "S"){  // se tem a flag ACESSATODACARTEIRA = S

				$SqlCliente.= "       and clien_est_coordenador in (select clien_est_coordenador ";

				$SqlCliente.= "                                       from rar_cliente_estrutura ";

				$SqlCliente.= "                                      where clien_est_consultor = '".$ConsuPessoa."')";

			}else{

				$SqlCliente.= "       and clien_est_consultor = '".$ConsuPessoa."'";

			}

		}

	}

	

	if ($CategoriaUsuario == "4"){

		$SqlCliente.= " and (";

		$SqlCliente.= "      PESSOA in (select distinct usucli_pessoa ";

		$SqlCliente.= "                           from rar_usuarioxcliente";

		$SqlCliente.= "                          where usucli_usuar_ido = '".$_SESSION['sId']."')";

		$SqlCliente.= " ) ";

	}

	$SqlCliente.= " ORDER BY P.PESSOA";

	

	$SqlClienteMatriz = " SELECT DISTINCT PM.PESSOA, PM.NOME ";

	$SqlClienteMatriz.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA, PESSOA PM";

	$SqlClienteMatriz.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$SqlClienteMatriz.= "       AND PM.PESSOA = P.GRUPO_EMPRESARIAL ";

	if ($CategoriaUsuario == "2"){

		$SqlClienteMatriz.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	if ($CategoriaUsuario == "3"){

		if ($AcessaTodaCarteira == "S"){  // se tem a flag ACESSATODACARTEIRA = S

			$SqlClienteMatriz.= "       and clien_est_coordenador in (select clien_est_coordenador ";

			$SqlClienteMatriz.= "                                       from rar_cliente_estrutura ";

			$SqlClienteMatriz.= "                                      where clien_est_consultor = '".$ConsuPessoa."')";

		}else{

			$SqlClienteMatriz.= "       and clien_est_consultor = '".$ConsuPessoa."'";

		}

	}

	if ($CategoriaUsuario == "4"){

		$SqlClienteMatriz.= " and (";

		$SqlClienteMatriz.= "      P.PESSOA in (select distinct usucli_pessoa ";

		$SqlClienteMatriz.= "                           from rar_usuarioxcliente";

		$SqlClienteMatriz.= "                          where usucli_usuar_ido = '".$_SESSION['sId']."')";

		$SqlClienteMatriz.= " ) ";

	}

	$SqlClienteMatriz.= " ORDER BY PM.PESSOA";

	

	$SqlClienteSemMM = " SELECT DISTINCT P.PESSOA, P.NOME ";

	$SqlClienteSemMM.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA";

	$SqlClienteSemMM.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$SqlClienteSemMM.= "       AND P.CATEGORIA_CLIENTE in (8) ";

	if ($CategoriaUsuario == "2"){

		$SqlClienteSemMM.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	if ($CategoriaUsuario == "3"){

		if ($AcessaTodaCarteira == "S"){  // se tem a flag ACESSATODACARTEIRA = S

			$SqlClienteSemMM.= "       and clien_est_coordenador in (select clien_est_coordenador ";

			$SqlClienteSemMM.= "                                       from rar_cliente_estrutura ";

			$SqlClienteSemMM.= "                                      where clien_est_consultor = '".$ConsuPessoa."')";

		}else{

			$SqlClienteSemMM.= "       and clien_est_consultor = '".$ConsuPessoa."'";

		}

	}

	if ($CategoriaUsuario == "4"){

		$SqlClienteSemMM.= " and (";

		$SqlClienteSemMM.= "      PESSOA in (select distinct usucli_pessoa ";

		$SqlClienteSemMM.= "                           from rar_usuarioxcliente";

		$SqlClienteSemMM.= "                          where usucli_usuar_ido = '".$_SESSION['sId']."')";

		$SqlClienteSemMM.= " ) ";

	}

	$SqlClienteSemMM.= " ORDER BY P.PESSOA";

	

	$SqlClienteMatrizSemMM = " SELECT DISTINCT PM.PESSOA, PM.NOME ";

	$SqlClienteMatrizSemMM.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA, PESSOA PM";

	$SqlClienteMatrizSemMM.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$SqlClienteMatrizSemMM.= "       AND PM.PESSOA = P.GRUPO_EMPRESARIAL ";

	$SqlClienteMatrizSemMM.= "       and pm.categoria_cliente in (8)";

	if ($CategoriaUsuario == "2"){

		$SqlClienteMatrizSemMM.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	if ($CategoriaUsuario == "3"){

		if ($AcessaTodaCarteira == "S"){  // se tem a flag ACESSATODACARTEIRA = S

			$SqlClienteMatrizSemMM.= "       and clien_est_coordenador in (select clien_est_coordenador ";

			$SqlClienteMatrizSemMM.= "                                       from rar_cliente_estrutura ";

			$SqlClienteMatrizSemMM.= "                                      where clien_est_consultor = '".$ConsuPessoa."')";

		}else{

			$SqlClienteMatrizSemMM.= "       and clien_est_consultor = '".$ConsuPessoa."'";

		}

	}

	if ($CategoriaUsuario == "4"){

		$SqlClienteMatrizSemMM.= " and (";

		$SqlClienteMatrizSemMM.= "      P.PESSOA in (select distinct usucli_pessoa ";

		$SqlClienteMatrizSemMM.= "                           from rar_usuarioxcliente";

		$SqlClienteMatrizSemMM.= "                          where usucli_usuar_ido = '".$_SESSION['sId']."')";

		$SqlClienteMatrizSemMM.= " ) ";

	}

	$SqlClienteMatrizSemMM.= " ORDER BY PM.PESSOA";

	

	$SqlClienteAtivo = " SELECT DISTINCT P.PESSOA, P.NOME ";

	$SqlClienteAtivo.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA";

	$SqlClienteAtivo.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$SqlClienteAtivo.= "       AND CLIENTE_ATIVO = 'S'";

	if ($CategoriaUsuario == "2"){

		$SqlClienteAtivo.= "   AND CLIEN_EST_COORDENADOR = '".$ConsuPessoa."'";

	}

	if ($CategoriaUsuario == "3"){

		if ($AcessaTodaCarteira == "S"){  // se tem a flag ACESSATODACARTEIRA = S

			$SqlClienteAtivo.= "       and clien_est_coordenador in (select clien_est_coordenador ";

			$SqlClienteAtivo.= "                                       from rar_cliente_estrutura ";

			$SqlClienteAtivo.= "                                      where clien_est_consultor = '".$ConsuPessoa."')";

		}else{

			$SqlClienteAtivo.= "       and clien_est_consultor = '".$ConsuPessoa."'";

		}

	}

	if ($CategoriaUsuario == "4"){

		$SqlClienteAtivo.= " and (";

		$SqlClienteAtivo.= "      PESSOA in (select distinct usucli_pessoa ";

		$SqlClienteAtivo.= "                           from rar_usuarioxcliente";

		$SqlClienteAtivo.= "                          where usucli_usuar_ido = '".$_SESSION['sId']."')";

		$SqlClienteAtivo.= " ) ";

	}

	$SqlClienteAtivo.= " ORDER BY P.PESSOA";

	

	function VerificaChatPendente($Servico){

		$Sql = " select * ";

		$Sql.= " from rar_servico_chat ";

		$Sql.= " where SCHAT_SERVI_NUMERO = '".$Servico."'";

		$Sql.= "       and SCHAT_LIDO = 'N'";

		$Stmt = mysql_query($Sql);

		if($Rs = mysql_fetch_assoc($Stmt)) { 

			return "S";

		}else{

			return "";

		}

	}

	

	function CategoriaProduto($Categoria) {

	   	switch($Categoria){

		   	case  1:

				return "CALÇADOS";

			  	break;

			case 2:

				return "BOLSAS";

			  	break;

			case 3:

				return "CINTOS";

			  	break;

			case 4:

				return "CARTEIRAS";

			  	break;

		}  

	}

	

	function BuscaAgente($FABRI_IDO){

		$Sql = " select AGENT_NOME";

		$Sql.= " from rar_agente, rar_fabrica";

		$Sql.= " where fabri_agent_ido = agent_ido ";

		$Sql.= "       and fabri_pessoa = '".$FABRI_IDO."'";

		$StmtAgente = mysql_query($Sql);

		if($RsAgente = mysql_fetch_assoc($StmtAgente)) {

			return trim($RsAgente["AGENT_NOME"]);

		}

	}

	

	function RetornaCategoriaRAR($Categoria){

		switch($Categoria){

		   	case "1":

				return "CALÇADOS";

			  	break;

			case "2":

				return "LICENSE";

			  	break;

		}

	}

	

	function BuscaMotivo($LANCA_NUMRAR){

		$Sql = " select LANCA_MOTIVO";

		$Sql.= " from rar_lancamento";

		$Sql.= " where lanca_numrar = '".$LANCA_NUMRAR."'";

		$StmtMotivo = mysql_query($Sql);

		if($RsMotivo = mysql_fetch_assoc($StmtMotivo)) {

			return str_replace(chr(10)," ",trim($RsMotivo["LANCA_MOTIVO"]));

		}

	}

	

	function BuscaLancamento($PRENF_PESSOA_DESTINATARIO, $PRENF_PESSOA_EMITENTE_ORIGINAL, $NUM_NF_ORIGEM, $SERIE_NF_ORIGEM, $REFERENCIA, $COLECAO){

		$Sql = " select min(lancamento) LANCAMENTO";

		$Sql.= " from item_nota_fiscal it, nota_fiscal nf";

		$Sql.= " where it.num_nf = nf.num_nf ";

		$Sql.= "       and it.serie_nf = nf.serie_nf ";

		$Sql.= "       and it.pessoa_emitente = nf.pessoa_emitente ";

		$Sql.= "       and nf.pessoa_destinatario in (";

		$Sql.= "                                     select CLIEN_COL_PESSOA from rar_cliente_coleta where clien_col_pessoa = '".$PRENF_PESSOA_DESTINATARIO."'";

		$Sql.= "                                     union select CLIEN_COL_LOJAANT from rar_cliente_coleta where clien_col_pessoa = '".$PRENF_PESSOA_DESTINATARIO."'";

		$Sql.= "                                     union select CLIEN_COL_LOJAANT_1 from rar_cliente_coleta where clien_col_pessoa = '".$PRENF_PESSOA_DESTINATARIO."'";

		$Sql.= "                                     union select CLIEN_COL_LOJAANT_2 from rar_cliente_coleta where clien_col_pessoa = '".$PRENF_PESSOA_DESTINATARIO."'";

		$Sql.= "                                     union select CLIEN_COL_LOJAANT_3 from rar_cliente_coleta where clien_col_pessoa = '".$PRENF_PESSOA_DESTINATARIO."'";

		$Sql.= "                                     union select CLIEN_COL_LOJAANT_4 from rar_cliente_coleta where clien_col_pessoa = '".$PRENF_PESSOA_DESTINATARIO."'";

		$Sql.= "                                     )";

		$Sql.= "       and nf.pessoa_emitente = '".$PRENF_PESSOA_EMITENTE_ORIGINAL."'";

		$Sql.= "       and nf.num_nf = '".$NUM_NF_ORIGEM."'";

		$Sql.= "       and nf.serie_nf = '".$SERIE_NF_ORIGEM."'";

		$Sql.= "       and cd_item_material = '".$REFERENCIA."'";

		$Sql.= "       and cd_colecao = '".$COLECAO."'";  //incluida essa linha em 15/01/2008

		$StmtNF = mysql_query($Sql);

		if($RsNF = mysql_fetch_assoc($StmtNF)) {

			return trim($RsNF["LANCAMENTO"]);

		}

	}

	

	function Regiao($Regiao) {

	   	switch($Regiao){

		   	case "RS":

				return "S";

			  	break;

			case "SC":

				return "S";

			  	break;

			case "PR":

				return "S";

			  	break;

			case "SP":

				return "SU";

			  	break;

			case "RJ":

				return "SU";

			  	break;

			case "MG":

				return "SU";

			  	break;

			case "ES":

				return "SU";

			  	break;

			case "MT":

				return "CO";

			  	break;

			case "MS":

				return "CO";

			  	break;

			case "GO":

				return "CO";

			  	break;

			case "TO":

				return "CO";

			  	break;

			case "DF":

				return "CO";

			  	break;

			case "AC":

				return "N";

			  	break;

			case "RO":

				return "N";

			  	break;

			case "AM":

				return "N";

			  	break;

			case "RR":

				return "N";

			  	break;

			case "PA":

				return "N";

			  	break;

			case "AP":

				return "N";

			  	break;

			case "BA":

				return "NE";

			  	break;

			case "SE":

				return "NE";

			  	break;

			case "AL":

				return "NE";

			  	break;

			case "PE":

				return "NE";

			  	break;

			case "PB":

				return "NE";

			  	break;

			case "RN":

				return "NE";

			  	break;

			case "MA":

				return "NE";

			  	break;

			case "CE":

				return "NE";

			  	break;

			case "PI":

				return "NE";

			  	break;

		}  

	}

	

	

	//Variaveis para IAF

	$SqlPesqIAFGeral = " SELECT * ";

	$SqlPesqIAFGeral.= " FROM IAF_PESQUISA ";

	$SqlPesqIAFGeral.= " WHERE 1 = 1 ";

	$SqlPesqIAFGeral.= " ORDER BY IAFPQ_NOMEMENU";

	

	$SqlPesqIAFAtivo = " SELECT * ";

	$SqlPesqIAFAtivo.= " FROM IAF_PESQUISA ";

	$SqlPesqIAFAtivo.= " WHERE IAFPQ_ATIVO = 1 ";

	$SqlPesqIAFAtivo.= "       AND date(now()) BETWEEN IAFPQ_DATA_ini AND IAFPQ_data_fim ";

	$SqlPesqIAFAtivo.= " ORDER BY IAFPQ_NOMEMENU";

	

	$SqlPesqIAFTodas = " SELECT * ";

	$SqlPesqIAFTodas.= " FROM IAF_PESQUISA ";

	$SqlPesqIAFTodas.= " WHERE IAFPQ_ATIVO = 1 ";

	$SqlPesqIAFTodas.= " ORDER BY PESQU_NOMEMENU";

	

	function RetornaDataLimitePlanoAcao($IAFPQ_IDO){

		$Sql = " select date_format(iafpq_datalimiteplanoacao,'%d/%m/%Y') As DATALIMITE";

		$Sql.= " from iaf_pesquisa";

		$Sql.= " where iafpq_ido = '".$IAFPQ_IDO."'";

		$StmtTemp = mysql_query($Sql);

		if($RsTemp = mysql_fetch_assoc($StmtTemp)) {

			return $RsTemp["DATALIMITE"];

		}

	}

	

	function RetornaAnoQuestionario($QUEST_IDO){

		$Sql = " select date_format(iafpq_data_ini,'%Y') As DATAINI";

		$Sql.= " from iaf_pesquisa, iaf_questionario";

		$Sql.= " where quest_ido = '".$QUEST_IDO."'";

		$Sql.= "       and quest_iafpq_ido = iafpq_ido ";

		$StmtTemp = mysql_query($Sql);

		if($RsTemp = mysql_fetch_assoc($StmtTemp)) {

			return $RsTemp["DATAINI"];

		}

	}

	

	function RetornaStatusIAF($QUEST_IDO){

		$Sql = " select QUEST_STATUS";

		$Sql.= " from iaf_questionario";

		$Sql.= " where quest_ido = '".$QUEST_IDO."'";

		$StmtTemp = mysql_query($Sql);

		if($RsTemp = mysql_fetch_assoc($StmtTemp)) {

			return $RsTemp["QUEST_STATUS"];

		}

	}

	

	function AtualizaStatusIAF($QUEST_IDO) {

		$Sql = " select * from iaf_questionario, iaf_pesquisa";

		$Sql.= " where quest_ido = '".$QUEST_IDO."'";

		$Sql.= "       and quest_iafpq_ido = iafpq_ido ";

		$Stmt = mysql_query($Sql);

		if ($Rs = mysql_fetch_assoc($Stmt)){

			$QUEST_STATUS_Q 	= $Rs["QUEST_STATUS_Q"];

			$QUEST_STATUS_PA 	= $Rs["QUEST_STATUS_PA"];

			$QUEST_STATUS_PL 	= $Rs["QUEST_STATUS_PL"];

			

			if ($Rs["IAFPQ_PLANEJAMENTO"] == 0){  //se IAF nao solicitar planejamento já encerra PLANEJAMENTO

				$QUEST_STATUS_PL = 1;

			}

			

			if ($Rs["IAFPQ_PLANOACAO"] == 0){  //se IAF nao solicitar planejamento já encerra PLANEJAMENTO

				$QUEST_STATUS_PA = 1;

			}else{

				//se necessitar plano de ação, verifica se tem algum ítem que necessita plano de ação

				$Sql = " select * ";

				$Sql.= " from iaf_questionario, iaf_questionario_item, iaf_indicador_item_criterio ";

				$Sql.= " where quest_ido = queit_quest_ido ";

				$Sql.= "       and quest_ido = '".$QUEST_IDO."'";

				$Sql.= "       and queit_intcr_ido = intcr_ido ";

				$Sql.= "       and intcr_planoacao = '1' ";

				$StmtPA = mysql_query($Sql);

				if (!$RsPA = mysql_fetch_assoc($StmtPA)) {

					$QUEST_STATUS_PA = 1;

				}

			}

			

			if ($QUEST_STATUS_Q == 0 || $QUEST_STATUS_PA == 0 || $QUEST_STATUS_PL == 0){

				$Status = 0;

			}else{

				$Status = 1;

			}

		}

		$Sql = "update iaf_questionario set quest_status = '".$Status."' where quest_ido = '".$QUEST_IDO."'";

		$Stmt = mysql_query($Sql);

		return $Status;

	}

	

	function DiaSemana($Dia) {

	   	switch($Dia){

		   	case  "D":

				return "DOMINGO";

			  	break;

		   	case  "S":

				return "SEGUNDA-FEIRA";

			  	break;

			case "T":

				return "TERÇA-FEIRA";

			  	break;

			case "Q":

				return "QUARTA-FEIRA";

			  	break;

			case "I":

				return "QUINTA-FEIRA";

			  	break;

			case "X":

				return "SEXTA-FEIRA";

			  	break;

			case "B":

				return "SÁBADO";

			  	break;

		}  

	}


	
	