<? include("inc/headerI.inc.php"); ?>

<form name="form" method="post" action="rel_gerenciamento_etapa_servicook.php" target="windowPrint">

<table width="100%"  border="0" align="center">

     <tr class="listagem" >

		 <td width="49%"><span class="titulo">:: Gerenciamento de etapas ::

		   

		 </span></td>

       	 <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#relindicedefeitosxpar');">Help</a></span>&nbsp;</div></td>

	</tr>

	<tr class="listagem" >

	  <td width="100%" colspan="2"><div align="center"><strong>Assinale os crit&eacute;rios que deseja pesquisar e depois clique em IMPRIMIR</strong></div></td>

	</tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

        <tr  class="listagem" >

          <td width="4%" >

            <div align="center">

              <input name="C_SERVI_NUMERO" onClick="checkControl(this.checked,new Array('SERVI_NUMERO'))" type="checkbox" class="style1" id="C_SERVI_NUMERO" value="radiobutton">

          </div></td>

          <td width="23%" >N.&ordm; Servi&ccedil;o </td>

          <td width="73%" >

            <input name="SERVI_NUMERO" type="text" class="campo_texto" id="SERVI_NUMERO" size="13" maxlength="12" disabled>

          </td>

        </tr>

        <tr  class="listagem"

>

          <td >

            <div align="center">

              <input name="C_SERVI_PESSO_IDO" onClick="checkControl(this.checked,new Array('SERVI_PESSO_IDO'))" type="checkbox" class="style1" id="C_SERVI_PESSO_IDO" value="radiobutton">

          </div></td>

          <td >Cliente</td>

          <td >

            <select name="SERVI_PESSO_IDO" class="campo_texto" id="SERVI_PESSO_IDO" disabled>

              <option value="">...Selecione</option>

              <? $Stmt = mysql_query("SELECT USUCLI_PESSOA, NOME FROM RAR_USUARIOXCLIENTE, PESSOA WHERE PESSOA = USUCLI_PESSOA AND USUCLI_USUAR_IDO = " .$_SESSION['sId']. " ORDER BY USUCLI_PESSOA");

			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

              <option value="<?=$Rs["USUCLI_PESSOA"]?>">

              <?=arrumaPessoa($Rs["USUCLI_PESSOA"])?>

  -

  <?=$Rs["NOME"]?>

              </option>

              <? } ?>

            </select>

</td>

        </tr>

        <tr  class="listagem"

>

          <td >

            <div align="center">

              <input name="C_SERVI_TIPPR_IDO" onClick="checkControl(this.checked,new Array('SERVI_TIPPR_IDO'))" type="checkbox" class="style1" id="C_SERVI_TIPPR_IDO" value="radiobutton">

          </div></td>

          <td >Departamento de produto </td>

          <td ><select name="SERVI_TIPPR_IDO" class="campo_texto" id="SERVI_TIPPR_IDO" disabled >

            <option value="" selected>...Selecione</option>

            <?

			  $Sql = " select * ";

			  $Sql.= " from RAR_TIPOPRODUTO ";

			  $Sql.= " order by TIPPR_DESCRICAO ";

			  $Stmt = mysql_query($Sql);

			  while($Rs = mysql_fetch_assoc($Stmt)) {  

			  ?>

            <option value="<?=$Rs["TIPPR_IDO"]?>" <? if ($_GET['SERVI_TIPPR_IDO'] == $Rs["TIPPR_IDO"]){?> selected <? }?>>

            <?=$Rs["TIPPR_DESCRICAO"]?>

            </option>

            <? 

				}

			?>

          </select>

          </td>

        </tr>

        <tr  class="listagem">

          <td >

            <div align="center">

              <input name="C_SERVI_EQUIP_IDO" onClick="checkControl(this.checked,new Array('SERVI_EQUIP_IDO'))" type="checkbox" class="style1" id="C_SERVI_EQUIP_IDO" value="Cradiobutton">

          </div></td>

          <td >Equipe</td>

          <td >

            <select name="SERVI_EQUIP_IDO" class="campo_texto" id="SERVI_EQUIP_IDO" disabled >

              <option value="" selected>...Selecione</option>

              <?

			  $Sql = " select EQUIP_IDO, EQUIP_NOME ";

			  $Sql.= " from rar_equipe ";

			  $Sql.= " order by equip_nome ";

			  $Stmt = mysql_query($Sql);

			  while($Rs = mysql_fetch_assoc($Stmt)) {  

			  ?>

              <option value="<?=$Rs["EQUIP_IDO"]?>" <? if ($_GET['SERVI_EQUIP_IDO'] == $Rs["EQUIP_IDO"]){?> selected <? }?>>

              <?=$Rs["EQUIP_NOME"]?>

              </option>

              <? 

				}

			?>

            </select>

</td>

        </tr>

        <tr  class="listagem">

          <td >

            <div align="center">

              <input name="C_SERVI_TISER_IDO" type="checkbox" onClick="checkControl(this.checked,new Array('SERVI_TISER_IDO'))" class="style1" id="C_SERVI_TISER_IDO" value="radiobutton">

          </div></td>

          <td >Servi&ccedil;o</td>

          <td ><select name="SERVI_TISER_IDO" class="campo_texto" id="SERVI_TISER_IDO" disabled >

            <option value="" selected>...Selecione</option>

            <?

			  $Sql = " select * ";

			  $Sql.= " from rar_tiposervico ";

			  $Sql.= " order by tiser_nome ";

			  $Stmt = mysql_query($Sql);

			  while($Rs = mysql_fetch_assoc($Stmt)) {  

			  ?>

            <option value="<?=$Rs["TISER_IDO"]?>" <? if ($_GET['SERVI_TISER_IDO'] == $Rs["TISER_IDO"]){?> selected <? }?>>

            <?=$Rs["TISER_NOME"]?>

            </option>

            <? 

				}

			?>

          </select>

          </td>

        </tr>

        <tr  class="listagem">

          <td >

            <div align="center">

              <input name="C_SERVI_USUAR_ANJO" type="checkbox" onClick="checkControl(this.checked,new Array('SERVI_USUAR_ANJO'))" class="style1" id="C_SERVI_USUAR_ANJO" value="radiobutton">

          </div></td>

          <td >Anjo</td>

          <td ><select name="SERVI_USUAR_ANJO" class="campo_texto" id="SERVI_USUAR_ANJO" disabled >

              <option value="" selected>...Selecione</option>

              <?

			  $Sql = " select distinct USUAR_IDO, USUAR_NOME ";

			  $Sql.= " from rar_servico, rar_usuario ";

			  $Sql.= " where servi_usuar_anjo = usuar_ido";

			  $Sql.= " order by usuar_nome ";

			  $Stmt = mysql_query($Sql);

			  while($Rs = mysql_fetch_assoc($Stmt)) {  

			  ?>

              <option value="<?=$Rs["USUAR_IDO"]?>" <? if ($_GET['SERVI_USUAR_ANJO'] == $Rs["USUAR_IDO"]){?> selected <? }?>>

              <?=$Rs["USUAR_NOME"]?>

              </option>

              <? 

				}

			?>

            </select>

          </td>

        </tr>

        <tr  class="listagem"

>

          <td >

            <div align="center">

              <input name="C_SERVI_DATAABERTURA" onClick="checkControl(this.checked,new Array('SERVI_DATAABERTURAI','SERVI_DATAABERTURAF'))" type="checkbox" class="style1" id="C_SERVI_DATAABERTURA" value="radiobutton">

          </div></td>

          <td >Data de abertura </td>

          <td >

            <span class="style1">de

            <input name="SERVI_DATAABERTURAI" type="text" id="SERVI_DATAABERTURAI" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

a

<input name="SERVI_DATAABERTURAF" type="text" id="SERVI_DATAABERTURAF" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

            </span>                      

          </td>

        </tr>

        <tr  class="listagem"

>

          <td >

            <div align="center">

              <input name="C_SERVI_DATA_ENCERRAMENTO" onClick="checkControl(this.checked,new Array('SERVI_DATA_ENCERRAMENTOI','SERVI_DATA_ENCERRAMENTOF'))" type="checkbox" class="style1" id="C_SERVI_DATA_ENCERRAMENTO" value="radiobutton">

          </div></td>

          <td >Data de conclus&atilde;o </td>

          <td >

              <span class="style1">de

              <input name="SERVI_DATA_ENCERRAMENTOI" type="text" id="SERVI_DATA_ENCERRAMENTOI" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

      a

      <input name="SERVI_DATA_ENCERRAMENTOF" type="text" id="SERVI_DATA_ENCERRAMENTOF" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10"  disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

              </span>

          </td>

        </tr>

        <tr  class="listagem"

>

          <td >

            <div align="center">

              <input name="C_SERVI_STATUS" onClick="checkControl(this.checked,new Array('SERVI_STATUS'))" type="checkbox" class="style1" id="C_SERVI_STATUS" value="radiobutton">

          </div></td>

          <td >Status do servi&ccedil;o </td>

          <td >

            <select name="SERVI_STATUS" class="campo_texto" id="SERVI_STATUS" disabled>

              <option value="" selected>...Selecione</option>

              <option value="1,2,3" <? if ($_GET['SERVI_STATUS'] == "1,2,3"){?> <? }?>>Pendente</option>

              <option value="4" <? if ($_GET['SERVI_STATUS'] == "4"){?> <? }?>>Conclu&iacute;do</option>

                        </select>

</td>

        </tr>

        <tr  class="listagem">

          <td >&nbsp;</td>

          <td >&nbsp;</td>

          <td ><span class="style1">

            <input type="hidden" name="SERVICO" value="S">

          </span></td>

        </tr>

        <tr  class="listagem">

          <td colspan="3" ><div align="center">

              <input name="Button" type="button" class="campo_texto" value="Imprimir" onClick="validaForm(document.form);">

              &nbsp;

              <input name="Submit2" type="reset" class="campo_texto" value="Limpar" onClick="clearForm();">

          </div></td>

        </tr>

      </table>

</form>

<? include("inc/headerF.inc.php"); ?>

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

	if (!JSUtilValidaData(formObj.SERVI_DATAABERTURAI.value,formObj.C_SERVI_DATAABERTURA.checked)

		|| !JSUtilValidaData(formObj.SERVI_DATAABERTURAF.value,formObj.C_SERVI_DATAABERTURA.checked)) {

		alert("Preencha o campo \"Data de abertura\" ou desabilite a opção !");

		formObj.SERVI_DATAABERTURAI.focus();

		return;

	}

	if (!JSUtilValidaData(formObj.SERVI_DATA_ENCERRAMENTOI.value,formObj.C_SERVI_DATA_ENCERRAMENTO.checked)

		|| !JSUtilValidaData(formObj.SERVI_DATA_ENCERRAMENTOF.value,formObj.C_SERVI_DATA_ENCERRAMENTO.checked)) {

		alert("Preencha o campo \"Data de abertura\" ou desabilite a opção !");

		formObj.SERVI_DATA_ENCERRAMENTOI.focus();

		return;

	}

	abrir_janela_popup('','windowPrint','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');

	document.form.submit();

}

//-->

</script>

