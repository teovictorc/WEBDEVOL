<? include("inc/conn_externa.inc.php"); ?>

<html>

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

//-->

</script>

<script language="javascript" type="text/javascript" src="js/util.js"></script>

<head>

<title>WEBDevol</title>

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

<form name="form" method="post" action="pesq_avaliacoes_reliazadas.php">

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="5%"><img name="webdevol_r7_c1" src="imagens/img/webdevol_r7_c1.jpg" width="35" height="38" border="0" alt=""></td>

    <td width="94%" background="imagens/fundo_tabela_topo.jpg"><span class="titulo style3">:: Pesquisa avan&ccedil;ada :: </span></td>

    <td width="1%"><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

    <td rowspan="2" background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td height="0"></td>

    <td rowspan="2" background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td><table width="100%"  border="0" align="center" class="tabela">

        <tr class="listagem_azul" >

          <td width="100%"><div align="center"><strong>Assinale os crit&eacute;rios que deseja pesquisar e depois clique em PESQUISAR</strong></div></td>

        </tr>

    </table>

      <table width="100%"  border="0" align="center">

        <tr bordercolor="#00CCFF" class="listagem" >

          <td width="4%" >

            <div align="center">

              <input name="C_LANCA_NUMRAR" onClick="checkControl(this.checked,new Array('LANCA_NUMRAR'))" type="checkbox" class="style1" id="C_LANCA_NUMRAR" value="radiobutton">

          </div></td>

          <td width="23%" a href="cad_defeitos.php">N.&ordm; Reclama&ccedil;&atilde;o</td>

          <td width="73%" a href="cad_defeitos.php">

            <input name="LANCA_NUMRAR" type="text" class="campo_texto" id="LANCA_NUMRAR" size="13" maxlength="11" disabled>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_LANCA_FABRI_IDO" onClick="checkControl(this.checked,new Array('LANCA_FABRI_IDO'))" type="checkbox" class="style1" id="C_LANCA_FABRI_IDO" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Fabricante</td>

          <td a href="cad_defeitos.php">

            <select name="LANCA_FABRI_IDO" class="campo_texto" id="LANCA_FABRI_IDO" disabled>

              <option value="">...Selecione</option>

			<? $Sql = "SELECT DISTINCT PESSOA,NOME FROM RAR_USUARIOXCLIENTE, PESSOA, RAR_LANCAMENTO ".

						"WHERE LANCA_PESSOA = USUCLI_PESSOA AND PESSOA = LANCA_FABRI_IDO ".

						"AND USUCLI_USUAR_IDO = " .$_GET['Filtro']. " ORDER BY PESSOA";					

			   $Stmt = mysql_query($Sql);

			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

			   <option value="<?=$Rs["PESSOA"]?>"><?=arrumaPessoa($Rs["NOME"])?></option>

			<? } ?>

            </select>          

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_LANCA_PESSOA" onClick="checkControl(this.checked,new Array('LANCA_PESSOA'))" type="checkbox" class="style1" id="C_LANCA_PESSOA" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Cliente</td>

          <td a href="cad_defeitos.php">

              <select name="LANCA_PESSOA" class="campo_texto" id="LANCA_PESSOA" disabled>

                <option value="">...Selecione</option>

			<? $Stmt = mysql_query("SELECT USUCLI_PESSOA, NOME FROM RAR_USUARIOXCLIENTE, PESSOA WHERE PESSOA = USUCLI_PESSOA AND USUCLI_USUAR_IDO = " .$_GET['Filtro']. " ORDER BY USUCLI_PESSOA");

			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

			   <option value="<?=$Rs["USUCLI_PESSOA"]?>"><?=arrumaPessoa($Rs["USUCLI_PESSOA"])?> - <?=$Rs["NOME"]?></option>

			<? } ?>

            </select>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_LINHA" onClick="checkControl(this.checked,new Array('LINHA'))" type="checkbox" class="style1" id="C_LINHA" value="Cradiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Linha</td>

          <td a href="cad_defeitos.php">

              <input name="LINHA" type="text" class="campo_texto" id="LINHA" size="6" maxlength="4" disabled>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_MODELO" type="checkbox" onClick="checkControl(this.checked,new Array('MODELO'))" class="style1" id="C_MODELO" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Modelo</td>

          <td a href="cad_defeitos.php">

              <input name="MODELO" type="text" class="campo_texto" id="MODELO" size="10" maxlength="8" disabled>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_LANCA_DATAABERTURA" onClick="checkControl(this.checked,new Array('LANCA_DATAABERTURAI','LANCA_DATAABERTURAF'))" type="checkbox" class="style1" id="C_LANCA_DATAABERTURA" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Data de abertura </td>

          <td a href="cad_defeitos.php">

            <span class="style1">de

            <input name="LANCA_DATAABERTURAI" type="text" id="LANCA_DATAABERTURAI" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

a

<input name="LANCA_DATAABERTURAF" type="text" id="LANCA_DATAABERTURAF" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

            </span>                      

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_AVALI_AREZ_DATA" onClick="checkControl(this.checked,new Array('AVALI_AREZ_DATAI','AVALI_AREZ_DATAF'))" type="checkbox" class="style1" id="C_AVALI_AREZ_DATA" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Data de avalia&ccedil;&atilde;o </td>

          <td a href="cad_defeitos.php">

              <span class="style1">de

              <input name="AVALI_AREZ_DATAI" type="text" id="AVALI_AREZ_DATAI" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

      a

      <input name="AVALI_AREZ_DATAF" type="text" id="AVALI_AREZ_DATAF" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10"  disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

              </span>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_LANCA_STATUS" onClick="checkControl(this.checked,new Array('LANCA_STATUS'))" type="checkbox" class="style1" id="C_LANCA_STATUS" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Status da reclama&ccedil;&atilde;o</td>

          <td a href="cad_defeitos.php">

              <select name="LANCA_STATUS" class="campo_texto" id="LANCA_STATUS" disabled>

                <option value="">...Selecione</option>

                <option value="1">Em aberto</option>

                <option value="3">Encerrado</option>

            </select>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >

            <div align="center">

              <input name="C_AVALI_SITUACAO" type="checkbox" onClick="checkControl(this.checked,new Array('AVALI_SITUACAO'))" class="style1" id="C_AVALI_SITUACAO" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </td>

          <td a href="cad_defeitos.php">

              <select name="AVALI_SITUACAO" class="campo_texto" id="AVALI_SITUACAO" disabled>

                <option value="">...Selecione</option>

                <option value="P">Procedente</option>

                <option value="I">Improcedente</option>

            </select>

          </td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td ><div align="center">

            <input name="C_LANCA_CLIENTE_NOME" type="checkbox" onClick="checkControl(this.checked,new Array('LANCA_CLIENTE_NOME'))" class="style1" id="C_LANCA_CLIENTE_NOME" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Nome do consumidor</td>

          <td a href="cad_defeitos.php"><input name="LANCA_CLIENTE_NOME" type="text" class="campo_texto" id="LANCA_CLIENTE_NOME" size="50" maxlength="50" disabled></td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem"

>

          <td >&nbsp;</td>

          <td a href="cad_defeitos.php">&nbsp;</td>

          <td a href="cad_defeitos.php">&nbsp;</td>

        </tr>

        <tr bordercolor="#00CCFF" class="listagem">

          <td colspan="3" ><div align="center">

              <input name="Button" type="button" class="campo_texto" value="Pesquisar" onClick="validaForm(document.form);">

              &nbsp;

              <input name="Submit2" type="reset" class="campo_texto" value="Cancelar" onClick="javascript:window.close();">

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

</body>

</html>

<script language="javascript" type="text/javascript">

<!--

function checkControl(option,elements) {

	for (x = 0; x < elements.length; x++) {

		document.form.elements[elements[x]].disabled = !option;

		if (!option)

			document.form.elements[elements[x]].value = "";

	}

}

function validaForm(formObj) {

	if (!JSUtilValidaData(formObj.LANCA_DATAABERTURAI.value,formObj.C_LANCA_DATAABERTURA.checked)

		|| !JSUtilValidaData(formObj.LANCA_DATAABERTURAF.value,formObj.C_LANCA_DATAABERTURA.checked)) {

		alert("Preencha o campo \"Data de abertura\" ou desabilite a opção !");

		formObj.LANCA_DATAABERTURAI.focus();

		return;

	}

	if (!JSUtilValidaData(formObj.AVALI_AREZ_DATAI.value,formObj.C_AVALI_AREZ_DATA.checked)

		|| !JSUtilValidaData(formObj.AVALI_AREZ_DATAF.value,formObj.C_AVALI_AREZ_DATA.checked)) {

		alert("Preencha o campo \"Data de abertura\" ou desabilite a opção !");

		formObj.AVALI_AREZ_DATAI.focus();

		return;

	}

	for(x = 0; x < document.form.elements.length - 2; x++) {

		if (document.form.elements[x].name.substring(0,2) != "C_") {

			window.opener.document.form.elements[document.form.elements[x].name].value = document.form.elements[x].value;

		}

	}

	window.opener.document.form.method = "POST"

	window.opener.document.form.submit();

	self.close();

}

//-->

</script>