<? include("inc/headerI.inc.php"); 

	if ($_GET["Categoria"] == "1"){

		$Categoria = "Calçados";

	}elseif ($_GET["Categoria"] == "2,3,4"){

		$Categoria = "Bolsa - Cinto - Carteira";

	}





?>

<form name="form" method="post" action="rel_indice_geral_mensalok.php" target="windowPrint">

<table width="100%"  border="0" align="center">

     <tr class="">

		 <td width="49%" class="tab_titulo" style="padding-top:15px;"><h4>Índice geral&nbsp;<?=$Categoria?></h4></td>

	</tr>

	<tr class="" >

	  <td width="100%" colspan="2" class="" style="padding-top:15px;"><div align="center"><strong>Assinale os crit&eacute;rios que deseja pesquisar e depois clique em IMPRIMIR</strong></div></td>

	</tr>

   </table></td>

   <td></td>

  </tr>

  <tr>

   <td >&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tab_inclusao">

        <tr  class="tab_inclusao" >

          <td width="4%" >

            <div align="center">

              <input name="C_LANCA_NUMRAR" onClick="checkControl(this.checked,new Array('LANCA_NUMRAR'))" type="checkbox" class="style1" id="C_LANCA_NUMRAR" value="radiobutton">

          </div></td>

          <td width="23%" a href="cad_defeitos.php">N.&ordm; Reclama&ccedil;&atilde;o</td>

          <td width="73%" a href="cad_defeitos.php">

            <input name="LANCA_NUMRAR" type="text" class="form" id="LANCA_NUMRAR" size="13" maxlength="12" disabled>

          </td>

        </tr>

        <tr  class="">

          <td >

            <div align="center">

              <input name="C_LANCA_FABRI_IDO" onClick="checkControl(this.checked,new Array('LANCA_FABRI_IDO'))" type="checkbox" class="style1" id="C_LANCA_FABRI_IDO" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Fabricante</td>

          <td a href="cad_defeitos.php">

            <select name="LANCA_FABRI_IDO" class="form" id="LANCA_FABRI_IDO" disabled>

              <option value="">...Selecione</option>

			<? $Sql = "SELECT DISTINCT PESSOA,NOME FROM rar_usuarioxcliente, pessoa, rar_lancamento ".

						"WHERE LANCA_PESSOA = USUCLI_PESSOA AND PESSOA = LANCA_FABRI_IDO ".

						"      and lanca_fabri_ido in (select usufor_pessoa from rar_usuarioxfornecedor where USUFOR_USUAR_IDO = " .$_SESSION['sId'].")";

						"      AND USUCLI_USUAR_IDO = " .$_SESSION['sId']. " ORDER BY PESSOA";

						

				$Sql = " SELECT DISTINCT PESSOA, NOME ";

				$Sql.= " FROM pessoa, rar_usuarioxfornecedor";

				$Sql.= " WHERE PESSOA = usufor_pessoa ";

				$Sql.= "       and USUFOR_USUAR_IDO = " .$_SESSION['sId']."";

				$Sql.= " ORDER BY PESSOA";					

			   $Stmt = mysql_query($Sql);



			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

			   <option value="<?=$Rs["PESSOA"]?>"><?=arrumaPessoa($Rs["PESSOA"])?> - <?=$Rs["NOME"]?>></option>

			<? } ?>

            </select>          

          </td>

        </tr>

        <tr  class=""

>

          <td >

            <div align="center">

              <input name="C_LANCA_PESSOA" onClick="checkControl(this.checked,new Array('LANCA_PESSOA'))" type="checkbox" class="style1" id="C_LANCA_PESSOA" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Cliente</td>

          <td a href="cad_defeitos.php">

              <select name="LANCA_PESSOA" class="form" id="LANCA_PESSOA" disabled>

                <option value="">...Selecione</option>

			<? 

				$Sql = " SELECT DISTINCT USUCLI_PESSOA, NOME ";

				$Sql.= " FROM rar_usuarioxcliente, pessoa ";

				$Sql.= " WHERE PESSOA = USUCLI_PESSOA ";

				$Sql.= "       AND USUCLI_USUAR_IDO = " .$_SESSION['sId'];

				$Sql.= " ORDER BY USUCLI_PESSOA";

				$Stmt = mysql_query($Sql);

			   	while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

			   		<option value="<?=$Rs["USUCLI_PESSOA"]?>"><?=arrumaPessoa($Rs["USUCLI_PESSOA"])?> - <?=$Rs["NOME"]?></option>

				<? } ?>

            </select>

          </td>

        </tr>

        <tr  class="">

          <td >

            <div align="center">

              <input name="C_LINHA" onClick="checkControl(this.checked,new Array('LINHA'))" type="checkbox" class="style1" id="C_LINHA" value="Cradiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Linha</td>

          <td a href="cad_defeitos.php">

              <input name="LINHA" type="text" class="form" id="LINHA" size="6" maxlength="4" disabled>

          </td>

        </tr>

        <tr  class="">

          <td >

            <div align="center">

              <input name="C_MODELO" type="checkbox" onClick="checkControl(this.checked,new Array('MODELO'))" class="style1" id="C_MODELO" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Modelo</td>

          <td a href="cad_defeitos.php">

              <input name="MODELO" type="text" class="form" id="MODELO" size="10" maxlength="8" disabled>

          </td>

        </tr>

        <tr class="">

          <td >

            <div align="center">

              <input name="C_LANCA_DATAABERTURA" onClick="checkControl(this.checked,new Array('LANCA_DATAABERTURAI','LANCA_DATAABERTURAF'))" type="checkbox" class="style1" id="C_LANCA_DATAABERTURA" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Data de abertura </td>

          <td a href="cad_defeitos.php">

            <span class="style1">de

            <input name="LANCA_DATAABERTURAI" type="text" id="LANCA_DATAABERTURAI" class="form" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

a

<input name="LANCA_DATAABERTURAF" type="text" id="LANCA_DATAABERTURAF" class="form" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

            </span>                      

          </td>

        </tr>

        <tr  class="">

          <td >

            <div align="center">

              <input name="C_AVALI_AREZ_DATA" onClick="checkControl(this.checked,new Array('AVALI_AREZ_DATAI','AVALI_AREZ_DATAF'))" type="checkbox" class="style1" id="C_AVALI_AREZ_DATA" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Data de avalia&ccedil;&atilde;o </td>

          <td a href="cad_defeitos.php">

              <span class="style1">de

              <input name="AVALI_AREZ_DATAI" type="text" id="AVALI_AREZ_DATAI" class="form" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

      a

      <input name="AVALI_AREZ_DATAF" type="text" id="AVALI_AREZ_DATAF" class="form" size="9" maxlength="10"  disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

              </span>

          </td>

        </tr>

        <tr  class="">

          <td >

            <div align="center">

              <input name="C_LANCA_STATUS" onClick="checkControl(this.checked,new Array('LANCA_STATUS'))" type="checkbox" class="style1" id="C_LANCA_STATUS" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Status da reclama&ccedil;&atilde;o</td>

          <td a href="cad_defeitos.php">

              <select name="LANCA_STATUS" class="form" id="LANCA_STATUS" disabled>

                <option value="">...Selecione</option>

                <option value="1">Em aberto</option>

                <option value="3">Encerrado</option>

            </select>

          </td>

        </tr>

        <tr  class="">

          <td >

            <div align="center">

              <input name="C_AVALI_SITUACAO" type="checkbox" onClick="checkControl(this.checked,new Array('AVALI_SITUACAO'))" class="style1" id="C_AVALI_SITUACAO" value="radiobutton">

          </div></td>

          <td a href="cad_defeitos.php">Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </td>

          <td a href="cad_defeitos.php">

              <select name="AVALI_SITUACAO" class="form" id="AVALI_SITUACAO" disabled>

                <option value="">...Selecione</option>

                <option value="P">Procedente</option>

                <option value="I">Improcedente</option>
				
				<option value="C">Conserto</option>

            </select>

          </td>

        </tr>
        
        <tr  class="">
          <td >&nbsp;</td>
          <td>Agrupar relat&oacute;rio por</td>
          <td>
              <select name="AGRUPAR_RELATORIO_POR" class="form" id="AGRUPAR_RELATORIO_POR">
                <option value="DATA_AVALIACAO">Data avalia&ccedil;&auml;o</option>
                <option value="DATA_ABERTURA">Data abertura</option>
            </select>
          </td>
        </tr>

        <tr  class="">

          <td >&nbsp;</td>

          <td a href="cad_defeitos.php">&nbsp;</td>

          <td a href="cad_defeitos.php"><span class="style1">

            <input name="LANCA_CATEGORIA" type="hidden" id="LANCA_CATEGORIA" value="<?=$_GET["Categoria"]?>">

          </span></td>

        </tr>

        <tr  class="">

          <td colspan="3" ><div align="center">

              <input name="Button" type="button" class="campo_texto" value="Imprimir" onClick="validaForm(document.form);">

              &nbsp;

              <input name="Submit2" type="reset" class="campo_texto" value="Limpar" onClick="clearForm();">

          </div></td>

        </tr>

      </table>

</form>



<table width="100%" cellpadding="0" cellspacing="0" border="0">

	<br/ ><br/ >

	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>



<script language="javascript" type="text/javascript">

<!--

function checkControl(option,elements) {

	for (x = 0; x < elements.length; x++) {

		document.form.elements[elements[x]].disabled = !option;

		if (!option)

			document.form.elements[elements[x]].value = "";

	}

}

function clearForm() {

	for(x = 0; x < document.form.elements.length - 2; x++) {

		if (document.form.elements[x].name.substring(0,2) != "C_")

			document.form.elements[x].disabled = true;

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

	abrir_janela_popup('','windowPrint','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');

	document.form.submit();

}

//-->

</script>