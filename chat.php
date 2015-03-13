<? include("inc/conn_externa.inc.php");?>

<html>

<script type="text/javascript" src="js/validacao.js"></script>

<script type="text/javascript" src="js/util.js"></script>

<script language="JavaScript" type="text/JavaScript">

<!--



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

//-->

</script>

<head>

<title>WebDevol</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Mon Apr 25 21:07:14 GMT-0300 (Hora oficial do Brasil) 2005-->

<link href="wfa.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

.style3 {color: #993300}

-->

</style>

<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>

</head>

<body bgcolor="#ffffff">

<form name="form" method="post" action="chatok.php" onSubmit="return VerificaForm();">



<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="5%"><img name="webdevol_r7_c1" src="imagens/img/webdevol_r7_c1.jpg" width="35" height="38" border="0" alt=""></td>

    <td width="94%" background="imagens/fundo_tabela_topo.jpg"><span class="titulo style3">:: Chat :: 

      

    </span></td>

    <td width="1%"><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

    <td rowspan="2" background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td height="0"></td>

    <td rowspan="2" background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td><table width="100%"  border="0" align="center" class="tabela">

        <tr>

          <td width="12%" class="style2"><strong>N&ordm; servi&ccedil;o </strong></td>

          <td width="88%"><input name="NUMERO" type="text" class="campo_amarelo" id="NUMERO" value="<?=$_GET['SERVI_NUMERO']?>" size="12" maxlength="11" readonly>

            <input name="SERVI_NUMERO" type="hidden" class="campo_amarelo" id="SERVI_NUMERO" value="<?=$_GET['SERVI_NUMERO']?>" size="5" maxlength="5" readOnly></td>

        </tr>

        <tr class="listagem_azul" >

          <td colspan="2"><div align="center"><strong>Intera&ccedil;&otilde;es</strong></div></td>

        </tr>

    </table>

      <table width="100%"  border="0" align="center">

        <tr bordercolor="#00CCFF" class="listagem">

          <td >

		  <table width="100%"  border="0" class="tabela">

            <tr class="campo_amarelo">

              <td width="3%" class="campo_amarelo"><div align="center" >#</div></td>

              <td width="3%" class="campo_amarelo">&nbsp;</td>

              <td width="15%" class="campo_amarelo"><div align="center" >DATA/HORA</div></td>

              <td width="52%" class="campo_amarelo">COMENT&Aacute;RIO</td>

              <td width="15%" class="campo_amarelo">RESPONS&Aacute;VEL</td>

              <td width="15%" class="campo_amarelo">DESTINAT&Aacute;RIO</td>

              <td width="15%" class="campo_amarelo"><div align="center">DATA LEITURA</div></td>

            </tr>

			

			<? 

			$Sql = " SELECT *";

		   	$Sql.= " FROM RAR_SERVICO ";

		   	$Sql.= " WHERE SERVI_NUMERO = '".$_GET['SERVI_NUMERO']."' ";

		   	$StmtServico = mysql_query($Sql);

			if($RsServico = mysql_fetch_assoc($StmtServico)) {

			

			}

			

		   	$Sql = " SELECT *, date_format(schat_data,'%d/%m/%Y %h:%i') DATA, date_format(schat_lido_data,'%d/%m/%Y %H:%i') SCHAT_LIDO_DATA ";

		   	$Sql.= " FROM RAR_SERVICO_CHAT, RAR_USUARIO ";

		   	$Sql.= " WHERE SCHAT_USUAR_IDO = USUAR_IDO ";

			$Sql.= "       AND SCHAT_SERVI_NUMERO = '".$_GET['SERVI_NUMERO']."' ";

			$Sql.= " ORDER BY SCHAT_DATA ";

		   	$Stmt = mysql_query($Sql);

			$x=0;

			while($Rs = mysql_fetch_assoc($Stmt)) {  

				$x++;

				?>

				<tr>

				  <td class="campo_texto"><div align="center"><?=$x?></div></td>

				  <td class="campo_texto">

				  <? if ($Rs["SCHAT_LIDO"] == "S"){?>

                    <img src="imagens/satisfeito.gif" width="17" height="17">

                    <? } else {?>

                    <img src="imagens/insatisfeito.gif" width="17" height="17">

					<? } ?>

				  </td>

				  <td class="campo_texto"><div align="center"><?=$Rs["DATA"]?></div></td>

				  <td class="campo_texto"><?=$Rs["SCHAT_TEXTO"]?></td>

				  <td class="campo_texto"><?=$Rs["USUAR_NOME"]?></td>

				  <td class="campo_texto"><?=Usuario($Rs["SCHAT_USUAR_DESTINATARIO"])?></td>

				  <td class="campo_texto"><div align="center">

				  <? if ($Rs["SCHAT_LIDO_DATA"] != "") { ?>

					  	<?=$Rs["SCHAT_LIDO_DATA"]?>

				  <? }elseif ($Rs["SCHAT_USUAR_DESTINATARIO"] == $_SESSION['sId']){ ?>

				  <input name="Button" type="button" class="style1" value="Confirmar leitura" onClick="javascript:ConfirmaLeitura('<?=$Rs["SCHAT_IDO"]?>');">

				  <? } else {?>

				  		Não lido

				  <? } ?>

				  </div></td>

				</tr>

			<? }  ?>

          </table>		  </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem">

          <td >Legenda: <img src="imagens/satisfeito.gif" width="17" height="17"> - Coment&aacute;rio lido pelo destinat&aacute;rio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="imagens/insatisfeito.gif" width="17" height="17"> - Coment&aacute;rio N&Atilde;O lido pelo destinat&aacute;rio </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem">

          <td >&nbsp;</td>

        </tr>

		<?

		if ($RsServico["SERVI_STATUS"] != "4"){

		?>

        <tr bordercolor="#00CCFF" class="listagem">

          <td ><table width="90%"  border="0" align="center" class="imp_normal_total">

            <tr bordercolor="#00CCFF" class="listagem">

              <td bgcolor="#f5f5f5" >&nbsp;Destinat&aacute;rio:</td>

            </tr>

            <tr bordercolor="#00CCFF" class="listagem">

              <td bgcolor="#f5f5f5" >

                &nbsp;

                <select name="SCHAT_USUAR_DESTINATARIO" class="style1" id="SCHAT_USUAR_DESTINATARIO">

                  <option value="">-- Selecione --</option>

                  <?

				$Sql = EnvolvidosServico($_GET['SERVI_NUMERO']);

				$Stmt = mysql_query($Sql);

				$x=0;

				while($Rs = mysql_fetch_assoc($Stmt)) {?>

                  <option value="<?=$Rs["USUAR_IDO"]?>">

                  <?=$Rs["USUAR_NOME"]?>

                  </option>

                  <? } ?>

                </select>

              </td>

            </tr>

            <tr bordercolor="#00CCFF" class="listagem">

              <td bgcolor="#f5f5f5" >&nbsp;Novo coment&aacute;rio: </td>

            </tr>

            <tr bordercolor="#00CCFF" class="listagem">

              <td bgcolor="#f5f5f5" >&nbsp;                <textarea name="SCHAT_TEXTO" cols="100%" rows="5" class="campo_texto" id="SCHAT_TEXTO"></textarea></td>

            </tr>

            <tr bordercolor="#00CCFF" class="listagem">

              <td bgcolor="#f5f5f5" >&nbsp;</td>

            </tr>

            <tr bordercolor="#00CCFF" class="listagem">

              <td bgcolor="#f5f5f5" ><div align="center">

  <input name="Button" type="submit" class="campo_texto" value="Confirmar" onClick="return VerificaForm(document.form);">

&nbsp;</div></td>

            </tr>

          </table></td>

        </tr>

		<? } ?>

        <tr bordercolor="#00CCFF" class="listagem">

          <td width="100%" ><div align="center">

              <input name="Submit2" type="button" class="campo_texto" value="Fechar" onClick="javascript:window.close();">

              <input name="VALIDADO" type="hidden" class="campo_amarelo" id="VALIDADO" size="5" maxlength="5" readOnly>

              </div></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td><img name="webdevol_r9_c1" src="imagens/img/webdevol_r9_c1.jpg" width="35" height="25" border="0" alt=""></td>

    <td background="imagens/img/webdevol_r9_c2.jpg"><div align="center">

    </div></td>

    <td><img name="webdevol_r9_c11" src="imagens/img/webdevol_r9_c11.jpg" width="33" height="25" border="0" alt=""></td>

  </tr>

</table>

</form>

<script language="javascript" type="text/javascript">

<!--







function Validar(){

	if (document.form.VALIDADO.value == "S"){

		window.opener.get_conteudo(3);;

		window.close();

		//document.form.action = "pesq_wfarec_inclusao_registrook.php?Tipo=<?=$_GET["Tipo"]?>";

		//document.form.submit();

	}

}



function VerificaForm() {

	if (document.form.SCHAT_USUAR_DESTINATARIO.value == ""){

		alert("Informe o destinatário !");

		document.form.SCHAT_USUAR_DESTINATARIO.focus();

		return false;

	}

	

	if (document.form.SCHAT_TEXTO.value == ""){

		alert("Informe o comentário !");

		document.form.SCHAT_TEXTO.focus();

		return false;

	}

	

	//formObj.action = "chatok.php";		

	//document.form.submit();

}





//-->



function ConfirmaLeitura(ID){

	document.form.action = "chatok.php?ID="+ID;

	document.form.submit();

}



</script>

</body>

</html>

