<? 	include('inc/conn.inc.php');
	include("pdo/Db.class.php");
	include("pdo/easyCRUD/LogAvaliacoes.class.php");
	session_start();

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



	$sel_id_baca=$_GET['Id'];



	if($_GET["destino"]=="R")

     {

	  echo("Reenviando...");

	  $mensagem  = $_GET['MENSAGEM'];

	  $lanca_num = $_GET['Id'];

	 }

    else

	 {

	  echo("Enviando...");

	  $mensagem  = $_POST['MENSAGEM'];

	  $lanca_num = $Rs['LANCA_NUMRAR'];

	 }



	$Sql = "SELECT L.*,I.*,F.NOME As FABRICA, date_format(i.item_data,'%d/%m/%Y') As DATA_NF ,date_format(L.lanca_dataabertura,'%d/%m/%Y') As DATA ,P.PESSOA,P.NOME,P.LOGRADOURO,P.BAIRRO,P.NM_MUNICIPIO,P.SG_UF FROM PESSOA P, RAR_LANCAMENTO L, PESSOA F, RAR_ITEM I ".

			"WHERE L.LANCA_FABRI_IDO = F.PESSOA AND L.lanca_pessoa = P.PESSOA AND I.item_numrar = L.lanca_numrar AND L.LANCA_NUMRAR = '$sel_id_baca'";

	$Stmt = mysql_query($Sql);

	if (!$Rs = mysql_fetch_assoc($Stmt))

		die('<script>document.location.href = "pesq_emails_enviados.php";</script>');



$Html = "<style type='text/css'>".

		".style2 {".

		"	font-family: tahoma;".

		"	font-size: 11px;".

		"}".

		".style1 {".

		"	font-family: tahoma;".

		"	font-size: 11px;".

		"	color: #000000;".

		"	font-style: normal;".

		"}".

		".campo_amarelo {".

		"	background: #FFFFCC;".

		"	border: 1px solid #999;".

		"	color: #000000;".

		"	font-size: 11px;".

		"	padding: 3px;".

		"	vertical-align: middle;".

		"	font-family: tahoma;".

		"	line-height: 10px;".

		"	text-transform: uppercase;".

		"	font-style: normal;".

		"}".

		".style3 {".

		"	font-size: 14px;".

		"	font-weight: bold;".

		"}".

		".borda_full {".

		"	border: 1px solid #666666;".

		"}".

		"</style>".

		"<table>".

		"<tr><td>&nbsp;</td>".

		"   <td colspan='9'><table width='100%'  border='0' class='tabela'>".

		"     <tr class='borda_full'>".

		"       <td height='10' colspan='4' class='style2'><div align='center' class='style3'>Encaminhamento de reclama&ccedil;&atilde;o </div></td>".

		"       </tr>".

		"     <tr class='borda_full'>".

		"       <td height='10' colspan='4' class='style2'><div align='center' class='style3'>N.&deg; da reclama&ccedil;&atilde;o: <span class='style3'>".

		"       " .$lanca_num.

		"       </span></div></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' colspan='4' class='style2'>&nbsp;</td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' colspan='4' class='style2'>&nbsp;</td>".

		"     </tr>".

		"     <tr class='borda_full'>".

		"       <td height='10' colspan='4' class='style2'><div align='left' class='style3'>Assunto:<span class='style2'>".

		"       " .$mensagem.

		"       </span></div></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' colspan='4' class='style2'>&nbsp;</td>".

		"     </tr>".

		"     <tr>".

		"       <td width='18%' height='10' class='style2'><strong>C&oacute;digo</strong></td>".

		"       <td width='34%' height='10'><span class='style1'>".

		"         <input name='textfield52225' type='text' disabled class='campo_amarelo'  value='" .$Rs['PESSOA'] ."' size='5' maxlength='5'>".

		"       </span></td>".

		"       <td width='11%' height='10'>&nbsp;</td>".

		"       <td width='37%' height='10'>&nbsp;</td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' class='style2'><strong>Nome do cliente </strong></td>".

		"       <td height='10' colspan='3' class='style1'><input name='textfield5' type='text' disabled class='campo_amarelo'  value='" .$Rs['NOME'] ."' size='50' maxlength='50'></td>".

		"       </tr>".

		"     <tr>".

		"       <td height='10' class='style2'><strong>Endere&ccedil;o</strong></td>".

		"       <td height='10' class='style1'><input name='textfield52' type='text' disabled class='campo_amarelo'  value='" .$Rs['LOGRADOURO'] ."' size='50' maxlength='50'></td>".

		"       <td height='10' class='style1'><strong>Bairro</strong></td>".

		"       <td height='10' class='style1'><input name='textfield5222' type='text' disabled class='campo_amarelo'  value='" .$Rs['BAIRRO'] ."' size='20' maxlength='50'></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' class='style2'><strong>Cidade</strong></td>".

		"       <td height='10' class='style1'><input name='textfield522' type='text' disabled class='campo_amarelo'  value='" .$Rs['NM_MUNICIPIO'] ."' size='50' maxlength='50'></td>".

		"       <td height='10'><strong class='style1'>UF</strong></td>".

		"       <td height='10' class='style1'><input name='textfield52222' type='text' disabled class='campo_amarelo'  value='" .$Rs['SG_UF'] ."' size='5' maxlength='5'></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' class='style2'><strong>Solicitante</strong></td>".

		"       <td height='10' colspan='3'><span class='style1'>".

		"         <input name='textfield5224' type='text' disabled class='campo_amarelo'  value='" .$Rs['LANCA_SOLICITANTE'] ."' size='50' maxlength='50'>".

		"       </span></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' class='style2'><strong>Fabricante</strong></td>".

		"       <td height='10' colspan='3'><span class='style1'>".

		"         <input name='textfield5223' type='text' disabled class='campo_amarelo'  value='" .$Rs['FABRICA'] ."' size='50' maxlength='50'>".

		"       </span></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='10' class='style2'><strong>Motivo da solicita&ccedil;&atilde;o </strong></td>".

		"       <td height='10' colspan='3'><textarea name='textarea' disabled cols='100%' rows='5' class='campo_amarelo'>" .$Rs['LANCA_MOTIVO'] ."</textarea></td>".

		"     </tr>".

		"     <tr bgcolor='#FFFFFF' class='listagem_azul'>".

		"       <td colspan='4' class='style2'><strong>Descri&ccedil;&atilde;o do &iacute;tem com problema </strong></td>".

		"       </tr>".

		"     <tr>".

		"       <td height='15' class='style2'><strong>Refer&ecirc;ncia</strong></td>".

		"       <td height='15' class='style2'><span class='style1'>".

		"         <input name='textfield522232' type='text' disabled class='campo_amarelo'  value='" .$Rs['ITEM_REFERENCIA'] ."' size='30' maxlength='50'>".

		"       </span></td>".

		"       <td height='15' class='style2'><strong>Cole&ccedil;&atilde;o</strong></td>".

		"       <td height='15' class='style2'><span class='style1'>".

		"         <input name='textfield52223' type='text' disabled class='campo_amarelo'  value='" .$Rs['ITEM_COLECAO'] ."' size='30' maxlength='50'>".

		"       </span></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='15' class='style2'><strong>N. NF origem </strong></td>".

		"       <td height='15'><span class='style2'><span class='style1'>".

		"         <input name='textfield5222322' type='text' disabled class='campo_amarelo'  value='" .$Rs['ITEM_NF'] ."' size='6' maxlength='6'>".

		"       </span></span></td>".

		"       <td height='15'><strong class='style1'>Data NF</strong></td>".

		"       <td height='15'><span class='style1'>".

		"         <input name='textfield52224' type='text' disabled class='campo_amarelo'  value='" .$Rs['DATA_NF'] ."' size='20' maxlength='50'>".

		"       </span></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='15' class='style2'><strong>N. par reclamado </strong></td>".

		"       <td height='15'><span class='style2'><span class='style1'>".

		"         <input name='textfield52223222' type='text' disabled class='campo_amarelo'  value='" .$Rs['ITEM_PAR'] ."' size='2' maxlength='2'>".

		"       </span></span></td>".

		"       <td height='15' class='style2'><strong>Quantidade</strong></td>".

		"       <td height='15'><span class='style2'><span class='style1'>".

		"         <input name='ITEM_QTDE' type='text' disabled class='campo_amarelo' id='ITEM_QTDE'  value='" .$Rs['ITEM_QTDE'] ."' size='6' maxlength='6'>".

		"       </span></span></td>".

		"     </tr>".

		"     <tr>".

		"       <td height='15' class='style2'><strong>Valor unit&aacute;rio </strong></td>".

		"       <td height='15'><span class='style1'>".

		"         <input name='ITEM_VALOR_UNITARIO' type='text' disabled class='campo_amarelo' id='ITEM_VALOR_UNITARIO'  value='R$ " .formatCurrencyPrint(str_replace(",",".",$Rs['ITEM_VALOR'])) ."' size='20' maxlength='20'>".

		"       </span></td>".

		"       <td height='15'><strong class='style1'>Valor total</strong></td>".

		"       <td height='15'><span class='style1'>".

		"         <input name='ITEM_VALOR_TOTAL' type='text' disabled class='campo_amarelo' id='ITEM_VALOR_TOTAL' size='20' maxlength='20' value='" .formatCurrencyPrint(floatval(str_replace(",",".",$Rs['ITEM_VALOR'])) * floatval($Rs['ITEM_QTDE'])). "'>".

		"       </span></td>".

		"     </tr>".

		"     <tr>".

		"       <td colspan='4' class='style2'><div align='center'>".

		"       </div></td>".

		"       </tr>".

		"     <tr>".

		"       <td colspan='4' class='style2'><table width='100%'  border='0'>".

		"         <tr class='style1'>".

		"           <td ><div align='center'>As fotos dos produtos seguem em anexo a este email. </div>             </td>".

		"           </tr>".

		"       </table>         </td>".

		"       </tr>".

		"     <tr>";



$Sql =	"SELECT AVALI_NUMRAR,AVALI_AREZ_DEFEI_IDO,AVALI_AREZ_DATA,AVALI_AREZ_ENCERRADO,AVALI_AREZ_DETALHE,AVALI_AREZ_USUAR_IDO, LANCA_STATUS, ".

		"AVALI_STAR_DEFEI_IDO,AVALI_STAR_DATA,AVALI_STAR_ENCERRADO,AVALI_STAR_DETALHE,AVALI_STAR_USUAR_IDO,AVALI_SITUACAO,AVALI_AUTOR_NUMAUT, date_format(AVALI_AREZ_DATA,'%d/%m/%Y') As ADATA, date_format(AVALI_STAR_DATA,'%d/$m/$Y') As SDATA, USUAR_NOME FROM RAR_AVALIACAO, RAR_USUARIO, RAR_LANCAMENTO ".

		"WHERE AVALI_NUMRAR = '" .$_GET['Id']. "' AND LANCA_NUMRAR = AVALI_NUMRAR AND USUAR_IDO (+) = AVALI_STAR_USUAR_IDO AND AVALI_SITUACAO IS NOT NULL ";



$Sql =	"SELECT AVALI_NUMRAR, AVALI_AREZ_DEFEI_IDO, AVALI_AREZ_DATA, AVALI_AREZ_ENCERRADO,".

        "       AVALI_AREZ_DETALHE,AVALI_AREZ_USUAR_IDO, LANCA_STATUS, ".

		"       AVALI_SITUACAO, AVALI_AUTOR_NUMAUT, date_format(AVALI_AREZ_DATA,'%d/%m/%Y') As ADATA ".

		" FROM RAR_AVALIACAO, RAR_LANCAMENTO ".

		" WHERE AVALI_NUMRAR = '" .$_GET['Id']. "' ".

		"       AND LANCA_NUMRAR = AVALI_NUMRAR ".

		"       AND AVALI_SITUACAO IS NOT NULL ";

		$Stmt2 = mysql_query($Sql);

		$VAR = false;

		if ($RsI = mysql_fetch_assoc($Stmt2)) {

			$VAR = true;

			$AVALI_AREZ_DEFEI_IDO = $RsI['AVALI_AREZ_DEFEI_IDO'];

			$AVALI_AREZ_DATA = (trim($RsI['ADATA'])) ? $RsI['ADATA'] : date('d/m/Y');

			$AVALI_AREZ_ENCERRADO = $RsI['AVALI_AREZ_ENCERRADO'];

			$AVALI_AREZ_DETALHE = $RsI['AVALI_AREZ_DETALHE'];



			//$AVALI_STAR_DEFEI_IDO = $RsI['AVALI_STAR_DEFEI_IDO'];

			//$AVALI_STAR_DATA = (trim($RsI['SDATA'])) ? $RsI['SDATA'] : date('d/m/Y');

			//$AVALI_STAR_ENCERRADO = $RsI['AVALI_STAR_ENCERRADO'];

			//$AVALI_STAR_DETALHE = $RsI['AVALI_STAR_DETALHE'];

			//$USUARIO = $RsI['USUAR_NOME'];



			$AVALI_SITUACAO = $RsI['AVALI_SITUACAO'];

			$LANCA_STATUS = $RsI['LANCA_STATUS'];

			$USUARIO = (trim($USUARIO)) ? $USUARIO : $_SESSION['sNome'];

		}





$Html.= "<td colspan='4' class='style2'><table width='100%'  border='0'>".

         "<tr class='listagem_azul'>";

if ($VAR == true) {

    $Html.=  "<td colspan='4' class='style2'><strong>Avalia&ccedil;&atilde;o t&eacute;cnica WEBDevol </strong></td>".

         	"</tr>".

         "<tr class='tabela'>".

           "<td width='17%' class='style2'><strong>Defeito encontrado</strong></td>".

           "<td colspan='3' class='style2'><select name='AVALI_AREZ_DEFEI_IDO' class='campo_amarelo' id='AVALI_AREZ_DEFEI_IDO' disabled>";



		 $Stmt3 = mysql_query('SELECT * FROM RAR_DEFEITO ORDER BY DEFEI_DESCRICAO');

		   while($RsD = mysql_fetch_assoc($Stmt3)) {

		  $Html.= "<option value='".$RsD['DEFEI_IDO']."'".(($AVALI_AREZ_DEFEI_IDO == $RsD['DEFEI_IDO']) ? ' Selected' : '').">".$RsD['DEFEI_DESCRICAO']."</option>";

		 }

          $Html.= "</select></td>".

           		  "</tr>".

         	"<tr class='tabela'>".

           "<td class='style2'><strong>Detalhamento</strong></td>".

           "<td colspan='3' class='style2'><span class='style1'>".

             "<textarea name='AVALI_AREZ_DETALHE' cols='100%' rows='5' class='campo_amarelo' id='AVALI_AREZ_DETALHE' disabled>".$AVALI_AREZ_DETALHE."</textarea>".

           "</span></td>".

         "</tr>".

         "<tr class='tabela'>".

           "<td class='style2'><strong>Data avalia&ccedil;&atilde;o </strong></td>".

           "<td width='7%' class='style2'><span class='style1'>".

           "  <input name='AVALI_AREZ_DATA' value='".$AVALI_AREZ_DATA."' type='text' class='campo_amarelo' id='AVALI_AREZ_DATA'  size='10' maxlength='50' disabled>".

           "</span></td>".

           "<td width='12%' class='style2'><strong>Avalia&ccedil;&atilde;o encerrada </strong></td>".

           "<td width='56%' class='style2'><input name='AVALI_AREZ_ENCERRADO' type='checkbox' id='AVALI_AREZ_ENCERRADO' value='S' ".(($AVALI_AREZ_ENCERRADO == 'S') ? 'checked' : '')." disabled></td>".

         "</tr>".

         "<tr class='tabela'>".

         	"<td class='style2'><strong>Responsável</strong></td>".

          	"<td colspan='3' class='style2'><span class='style1'>".

           	"<input name='textfield52242' type='text' disabled class='campo_amarelo'  value='".$USUARIO."' size='50' maxlength='50'>".

           "</span></td>".

         "</tr>".

         "<tr class='listagem_azul'>".

         "  <td colspan='4' class='style2'><strong>Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </strong></td>".

         "</tr>".

         "<tr class='tabela'>".

         "  <td colspan='4' class='style2'><input name='AVALI_SITUACAO' type='radio' value='P' ".(($AVALI_SITUACAO == 'P') ? 'checked' : '')." disabled>".

    "Procedente".

     " <input name='AVALI_SITUACAO' type='radio' value='I'  ".(($AVALI_SITUACAO == 'I') ? 'checked' : '')." disabled>".

    "Improcedente".

    "<input name='AVALI_SITUACAO' type='radio' value='E' ".(($AVALI_SITUACAO == 'E') ? 'checked' : '')." disabled>".

    "Enviar para an&aacute;lise </td>".

    "     </tr>".

    "     <tr class='tabela'>".

    "       <td class='style2'><strong>Status da reclama&ccedil;&atilde;o </strong></td>".

    "       <td colspan='3' class='style2'><span class='style1'>".

    "         <select name='LANCA_STATUS' class='campo_amarelo' onChange='updateAvaliacao()' disabled>".

    "           <option value=''>...Selecione</option>".

	"		   <option value='1'".(($LANCA_STATUS == '1') ? ' selected' : '').">Em andamento</option>".

    "           <option value='3'".(($LANCA_STATUS == '3') ? ' selected' : '').">Encerrada</option>".

    "        </select>".

"</span></td>";

 }else{

	$Html.=	"<Td width='8%'><div class='style2' align='center'><strong>Avalia&ccedil;&atilde;o n&atilde;o realizada !</strong></div></Td>";

 }



    $Html.=	"</tr>".

       "</table></td>".

       "</tr>".

     "<tr>".

       "<td colspan='4'> <div align='center'></div></td>".

       "</tr>".

  "</table>";


require_once ("class.phpmailer.php");

include("inc/mail.inc.php");

  if($_GET["destino"]=="R")
  {

		  $lln=$_GET['Id'];

		  $IDSX = str_replace("<br>","|",$_GET['IDS']);

		  $IDS = explode("|",$IDSX);

		  $men=$_GET['MENSAGEM'];

		  for($x = 0; $x < count($IDS); $x++)



		  {



$mail = new PHPMailer(); //

// Define o método de envio
$mail->Mailer     = "smtp";

// Define que a mensagem poderá ter formatação HTML
$mail->IsHTML(true); //

// Define que a codificação do conteúdo da mensagem será utf-8
$mail->CharSet    = "iso-8859-1";

// Define que os emails enviadas utilizarão SMTP Seguro tls
$mail->SMTPSecure = "auto";

// Define que o Host que enviará a mensagem é o Gmail
$mail->Host       = "smtp.andarella.com.br";

//Define a porta utilizada pelo Gmail para o envio autenticado
$mail->Port       = "587";

// Deine que a mensagem utiliza método de envio autenticado
$mail->SMTPAuth   = "true";

// Define o usuário do gmail autenticado responsável pelo envio
$mail->Username   = "tiago.silva@andarella.com.br";

// Define a senha deste usuário citado acima
$mail->Password   = "ts1234a2014";

// Defina o email e o nome que aparecerá como remetente no cabeçalho
$mail->From       = "tiago.silva@andarella.com.br";
$mail->FromName   = "Andarella-Analise de Produto";

// Define o destinatário que receberá a mensagem

$mail->AddAddress($IDS[$x]);

/*
Define o email que receberá resposta desta
mensagem, quando o destinatário responder
*/
$mail->AddReplyTo("tiago.silva@andarella.com.br", $mail->FromName);
/*
Define o email no email anexo
*/

$mail->AddAttachment($PathImagens. $Rs["ITEM_FOTOPROD"], "IMAGEM_PRO.jpeg" );

$mail->AddAttachment($PathImagens. $Rs["ITEM_FOTOSOLA"], "IMAGEM_SOLA.jpeg" );

$mail->AddAttachment($PathImagens. $Rs["ITEM_FOTODEFEITO"],"IMAGEM_DEFEITO.jpeg" );

// Assunto da mensagem
//$mail->Subject    = "ENVIADO PELO PHP: Teste de e-mail";

$mail->Subject=("RARWEB - Encaminhamento da RAR  " .$Rs["LANCA_NUMRAR"]);

// Toda a estrutura HTML e corpo da mensagem
$mail->Body       = $Html;

// Controle de erro ou sucesso no envio
$mail->Send();
		  }

	  echo "<script language='javascript' type='text/javascript'>

	            alert('E-mail enviado com sucesso !');

		        window.history.go(-1);

               </script>";
  }



else

{
$IDS = explode("|",$_POST['ID']);

          $men=$_POST['MENSAGEM'];

		  $lln=$Rs["LANCA_NUMRAR"];

		  for($x = 0; $x < count($IDS); $x++)

		  {
			$mail = new PHPMailer(); //

// Define o método de envio
$mail->Mailer     = "smtp";

// Define que a mensagem poderá ter formatação HTML
$mail->IsHTML(true); //

// Define que a codificação do conteúdo da mensagem será utf-8
$mail->CharSet    = "iso-8859-1";

// Define que os emails enviadas utilizarão SMTP Seguro tls
$mail->SMTPSecure = "auto";

// Define que o Host que enviará a mensagem é o Gmail
$mail->Host       = "smtp.andarella.com.br";

//Define a porta utilizada pelo Gmail para o envio autenticado
$mail->Port       = "587";

// Deine que a mensagem utiliza método de envio autenticado
$mail->SMTPAuth   = "true";

// Define o usuário do gmail autenticado responsável pelo envio
$mail->Username   = "tiago.silva@andarella.com.br";

// Define a senha deste usuário citado acima
$mail->Password   = "ts1234a2014";

// Defina o email e o nome que aparecerá como remetente no cabeçalho
$mail->From       = "tiago.silva@andarella.com.br";
$mail->FromName   = "Andarella-Analise de Produto  ";

// Define o destinatário que receberá a mensagem

$mail->AddAddress($IDS[$x]);

/*
Define o email que receberá resposta desta
mensagem, quando o destinatário responder
*/
$mail->AddReplyTo("tiago.silva@andarella.com.br", $mail->FromName);

$dta_log=date("Y-m-d H:i:s", time());

/*
Define o email no email anexo
*/

$mail->AddAttachment($PathImagens. $Rs["ITEM_FOTOPROD"], "IMAGEM_PRO.jpeg" );

$mail->AddAttachment($PathImagens. $Rs["ITEM_FOTOSOLA"], "IMAGEM_SOLA.jpeg" );

$mail->AddAttachment($PathImagens. $Rs["ITEM_FOTODEFEITO"],"IMAGEM_DEFEITO.jpeg" );

// Assunto da mensagem
//$mail->Subject    = "ENVIADO PELO PHP: Teste de e-mail";

$mail->Subject=("RARWEB - Encaminhamento da RAR  " .$Rs["LANCA_NUMRAR"]);

// Toda a estrutura HTML e corpo da mensagem
$mail->Body  = $Html;

$mail->Send();
	$log = new LogAvaliacoes();
	//$log->_writeAccess($_SESSION['sId'], $_SESSION['NUM_RAR']);
	$log->created = date('Y-m-d H:i:s');
	$log->usuario_id = $_SESSION['sId'];
	$log->num_rar = $Rs["LANCA_NUMRAR"];
	$log->token = session_id();
	$log->texto = "<i>Usuário <strong>{$Rs['NOME']}</strong>strong> foi notificado da avaliação por <strong>{$USUARIO}</strong></i>";
	$log->type = 2;
	$log->Create();

	echo("Email = " .$IDS[$x]."<br>");

	$emails = str_replace("|","<br>",$_POST['ID']);

		  $Comando = "INSERT INTO rar_logemail (LOG_CONT_IDO,LOG_MENSAGEM,LOG_LANCA_NUMRAR,LOG_USUAR_IDO,LOG_DATA) VALUES ('$emails','$men','$lln','$user','$dta_log')";

		  mysql_query($Comando);


		  }


		  $emailx = str_replace("<br>",", ",$emails);

		  echo "<script language='javascript' type='text/javascript'>

	            alert('E-mail enviado com sucesso para $emailx !');

	            self.close();

               </script>";

}







 ?>