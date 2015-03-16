<? include("inc/headerI.inc.php"); 

verifyAcess("ARZCONSAVALIACAO","S");

function situacao($value) {

	switch($value) {

		case "P":

				return "Improcedente";

			break;

		case "I":

				return "Procedente";

			break;

		case "E":

				return "Emanalise";  //somente está trocado para exibicao das imagens

		case "C":

				return "Conserto";  //somente está trocado para exibicao das imagens
		
		default:

				return "";

	}

}



function situacaoRel($value) {

	switch($value) {

		case "P":

				return "Procedente";

			break;

		case "I":

				return "Improcedente";

			break;

		case "E":

				return "Emanalise";  //somente está trocado para exibicao das imagens

		case "C":

				return "Conserto";  //somente está trocado para exibicao das imagens
		
		default:

				return "";

	}

}

?>

<form name="form" method="get" action="pesq_avaliacoes_reliazadas_arz.php">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Avalia&ccedil;&otilde;es realizadas</h4></td>

      </tr>

      </table>

	  

    <table width="100%"  border="0" class="tab_conteudo">

      <tr>

        <td width="100%" class="">

		<table width="100%"  border="0" class="">

          <tr class="">

            <td colspan="4" a href="cad_defeitos.php"><div align="left" class="tab_titulo"><strong>Informe os crit&eacute;rios de pesquisa e clique em PESQUISAR</strong></div></td>

          </tr>

          <tr  class="" >

            <td width="20%" a href="cad_defeitos.php">N.&ordm; Reclama&ccedil;&atilde;o:</td>

            <td width="30%" a href="cad_defeitos.php">

              <input name="LANCA_NUMRAR" type="text" class="form" id="LANCA_NUMRAR" size="13" maxlength="11" value="<?=$_GET['LANCA_NUMRAR']?>">

            </td>

            <td width="20%" a href="cad_defeitos.php">&nbsp;</td>

            <td width="30%" a href="cad_defeitos.php">&nbsp;</td>

          </tr>

          <tr  class="">

            <td a href="cad_defeitos.php">Cliente:</td>

            <td colspan="3" a href="cad_defeitos.php">

              <select name="LANCA_PESSOA" class="form" id="LANCA_PESSOA" >

                <option value="">...Selecione</option>

                <? $Stmt = mysql_query("SELECT USUCLI_PESSOA, NOME FROM rar_usuarioxcliente, pessoa WHERE PESSOA = USUCLI_PESSOA AND USUCLI_USUAR_IDO = " .$_SESSION['sId']. " ORDER BY USUCLI_PESSOA");

			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

                <option  <? if ($_GET['LANCA_PESSOA'] == $Rs["USUCLI_PESSOA"]){?> selected <? }?> value="<?=$Rs["USUCLI_PESSOA"]?>">

                <?=arrumaPessoa($Rs["USUCLI_PESSOA"])?>

        -

        <?=$Rs["NOME"]?>

                </option>

                <? } ?>

              </select>

            </td>

            </tr>

          <tr  class="listagem">

            <td a href="cad_defeitos.php">Data de abertura:</td>

            <td a href="cad_defeitos.php">de

                  <input name="LANCA_DATAABERTURAI" type="text" id="LANCA_DATAABERTURAI"  value="<?=$_GET['LANCA_DATAABERTURAI']?>" class="form" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

      a

      <input name="LANCA_DATAABERTURAF" type="text" id="LANCA_DATAABERTURAF"  value="<?=$_GET['LANCA_DATAABERTURAF']?>" class="form" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

             </td>

            <td a href="cad_defeitos.php"><div align="right">Data de avalia&ccedil;&atilde;o: &nbsp;</div></td>

            <td a href="cad_defeitos.php">de

                <input name="AVALI_AREZ_DATAI" type="text" id="AVALI_AREZ_DATAI"  value="<?=$_GET['AVALI_AREZ_DATAI']?>" class="form" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

a

<input name="AVALI_AREZ_DATAF" type="text" id="AVALI_AREZ_DATAF"  value="<?=$_GET['AVALI_AREZ_DATAF']?>" class="form" size="9" maxlength="10"   onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

            </td>

          </tr>

          <tr  class="listagem">

            <td a href="cad_defeitos.php">Linha:</td>

            <td a href="cad_defeitos.php"><input name="LINHA" type="text" class="form" id="LINHA" size="6" maxlength="4" value="<?=$_GET['LINHA']?>"></td>

            <td a href="cad_defeitos.php"><div align="right">Modelo:&nbsp;</div></td>

            <td a href="cad_defeitos.php"><input name="MODELO" type="text" class="form" id="MODELO" size="6" maxlength="4" value="<?=$_GET['MODELO']?>"></td>

          </tr>

          <tr  class="listagem">

            <td a href="cad_defeitos.php">Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o: </td>

            <td a href="cad_defeitos.php">

              <select name="AVALI_SITUACAO" class="form" id="AVALI_SITUACAO" >

                <option value="">...Selecione</option>

                <option value="P" <? if ($_GET['AVALI_SITUACAO'] == "P"){?> selected <? }?>>Procedente</option>

                <option value="I" <? if ($_GET['AVALI_SITUACAO'] == "I"){?> selected <? }?>>Improcedente</option>

              </select>

            </td>

            <td a href="cad_defeitos.php"><div align="right">Categoria:&nbsp;</div></td>

            <td a href="cad_defeitos.php"><select name="LANCA_CATEGORIA" class="form" id="LANCA_CATEGORIA" >

              <option value="">...Selecione</option>

              <option value="1" <? if ($_GET['LANCA_CATEGORIA'] == "1"){?> selected <? }?>>Cal&ccedil;ados</option>

              <option value="2" <? if ($_GET['LANCA_CATEGORIA'] == "2"){?> selected <? }?>>Bolsas</option>

              <option value="3" <? if ($_GET['LANCA_CATEGORIA'] == "3"){?> selected <? }?>>Cintos</option>

              <option value="4" <? if ($_GET['LANCA_CATEGORIA'] == "4"){?> selected <? }?>>Carteiras</option>

            </select></td>

          </tr>

          <tr bordercolor="#00CCFF" class="">

            <td a href="cad_defeitos.php">Nome do consumidor:</td>

            <td colspan="3" a href="cad_defeitos.php"><input name="LANCA_CLIENTE_NOME"  value="<?=$_GET['LANCA_CLIENTE_NOME']?>" type="text" class="form" id="LANCA_CLIENTE_NOME" size="50" maxlength="50" ></td>

            </tr>

          <tr  class="listagem">

            <td a href="cad_defeitos.php">&nbsp;</td>

            <td colspan="3" a href="cad_defeitos.php">&nbsp;</td>

          </tr>

          <tr  class="">

            <td colspan="4" ><div align="center">

                <input name="Button2" type="submit" class="campo_texto" value="Pesquisar" >

&nbsp;

        <input name="Submit2" type="reset" class="campo_texto" value="Limpar filtros" onClick="clearForm();">

            </div></td>

          </tr>

        </table>

		</td>

        </tr>

	<? if ($_GET['PESQUISAR'] != "") {	?>

      <tr>

        <td> <div align="">

          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios" >

              <td width="4%" ><div align="center">&nbsp;</td>

              <td width="3%" ><div align="center">&nbsp;</td>

              <td width="5%" ><div align="center">Cat.</div></td>

              <td width="13%" ><div align="center">N&ordm; RAR</div></td>

              <td width="13%" ><div align="center">N&ordm; BLOCO DE AN&Aacute;LISE</div></td>

              <td width="10%" ><div align="center">DATA AVALIA&Ccedil;&Atilde;O </div></td>

              <td width="5%" ><div align="center">SITUA&Ccedil;&Atilde;O AVALIA&Ccedil;&Atilde;O</div></td>

              <td ><div align="left">CLIENTE</div></td>

              <td width="30%" >FABRICANTE</td>

              </tr>

<? 

	$Sql = "SELECT I.ITEM_QTDE, A.AVALI_SITUACAO, L.LANCA_NUMRAR, L.LANCA_NBLOCO_ANALISE, LANCA_CATEGORIA, date_format(L.lanca_dataabertura,'%d/%m/%Y') AS DATA,".

	        " F.NOME As FABRICA,P.PESSOA,P.NOME, date_format(A.avali_arez_data,'%d/%m/%Y') AS DATA_AVAL ".

	        " FROM pessoa P, rar_lancamento L, pessoa F, rar_avaliacao A, rar_item I, rar_usuarioxcliente ".

			" WHERE L.LANCA_FABRI_IDO = F.PESSOA ".

			"       AND L.lanca_pessoa = P.PESSOA ".

			"       AND (A.avali_numrar = L.lanca_numrar or A.avali_numrar is null) ".

			"       AND I.ITEM_NUMRAR = L.LANCA_NUMRAR AND USUCLI_PESSOA = L.LANCA_PESSOA AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";



	if (trim($_GET['LANCA_NUMRAR'])) {

		$Sql.= "AND L.LANCA_NUMRAR = '" .$_GET['LANCA_NUMRAR']. "' ";

	}

	

	if (trim($_GET['LANCA_CLIENTE_NOME'])) {

		$Sql.= "AND L.LANCA_CLIENTE_NOME ilke '%" .$_GET['LANCA_CLIENTE_NOME']. "%' ";

	}

	

	if (trim($_GET['LANCA_FABRI_IDO'])) {

		$Sql.= "AND L.LANCA_FABRI_IDO = '" .$_GET['LANCA_FABRI_IDO']. "' ";

	}

	if (trim($_GET['LANCA_PESSOA'])) {

		$Sql.= "AND L.LANCA_PESSOA = '" .$_GET['LANCA_PESSOA']. "' ";

	}

	if (trim($_GET['LINHA'])) {

		$Sql.= "AND SUBSTR(I.ITEM_REFERENCIA,1,4) = '" .$_GET['LINHA']. "' ";

	}

	if (trim($_GET['MODELO'])) {

		$Sql.= "AND SUBSTR(I.ITEM_REFERENCIA,5,4) = '" .$_GET['MODELO']. "' ";

	}

	if (trim($_GET['LANCA_DATAABERTURAI']) && trim($_GET['LANCA_DATAABERTURAF'])) {

		$Sql.= "AND L.LANCA_DATAABERTURA BETWEEN '" . strdata2db($_GET['LANCA_DATAABERTURAI']). "' AND '" . strdata2db($_GET['LANCA_DATAABERTURAF']). "' ";

	}

	if (trim($_GET['AVALI_AREZ_DATAI']) && trim($_GET['AVALI_AREZ_DATAF'])) {

		//$Sql.= "AND A.AVALI_AREZ_DATA BETWEEN date_format('" . $_GET['AVALI_AREZ_DATAI']. " 00:00','%d/%m/%Y %h:%%i') AND date_format('" . $_GET['AVALI_AREZ_DATAF']. " 23:59','%d/%m/%Y %h:%%i') ";

		$Sql.= "AND A.AVALI_AREZ_DATA BETWEEN '" . strdata2db($_GET['AVALI_AREZ_DATAI']). "' AND '" . strdata2db($_GET['AVALI_AREZ_DATAF']). "' ";

	}

	if (trim($_GET['LANCA_STATUS'])) {

		$Sql.= "AND L.LANCA_STATUS = '" .$_GET['LANCA_STATUS']. "' ";

	}

	if (trim($_GET['AVALI_SITUACAO'])) {

		$Sql.= "AND A.AVALI_SITUACAO = '" .$_GET['AVALI_SITUACAO']. "' ";

	}

	

	if (trim($_GET['LANCA_CATEGORIA'])) {

		$Sql.= "AND L.LANCA_CATEGORIA = '" .$_GET['LANCA_CATEGORIA']. "' ";

	}

			

	if (trim($_GET['DT_INICIAL']) && trim($_GET['DT_FINAL']))

		$Sql.= " AND (L.LANCA_DATAABERTURA BETWEEN '".strdata2db($_GET['DT_INICIAL'])."'".

			   " AND '".strdata2db($_GET['DT_FINAL'])."')";

	$Sql.= " order by lanca_numrar";

	//die($Sql);

	$Stmt = mysql_query($Sql);

	$TotalReclamacao = 0;

		$TotalPares = 0;

	

	while($Rs2 = mysql_fetch_assoc($Stmt)) {

		$TotalReclamacao = $TotalReclamacao + 1;

		$TotalPares = $TotalPares + $Rs2["ITEM_QTDE"];

	}

	

	$_pagi_sql = $Sql;

	

	include_once("inc/paginator.inc.php");

		

	while($Rs = mysql_fetch_assoc($_pagi_result)) { 

		if ($Rs["LANCA_CATEGORIA"] == "1"){

			$Categoria = "sapato.jpg";

			$Descricao = "Calçado";

		}elseif ($Rs["LANCA_CATEGORIA"] == "2"){

			$Categoria = "bolsa.jpg";

			$Descricao = "Bolsa";

		}elseif ($Rs["LANCA_CATEGORIA"] == "3"){

			$Categoria = "cinto.jpg";

			$Descricao = "Cinto";

		}elseif ($Rs["LANCA_CATEGORIA"] == "4"){

			$Categoria = "carteira.jpg";

			$Descricao = "Carteira";

		}

		

		?>

            <tr bordercolor="#00CCFF" class="tab_usuarios_info">

              <td width="4%" ><div align="center"><a href="<?=((trim(situacaoRel($Rs["AVALI_SITUACAO"]))) ? "javascript:abrir_janela_popup('relatorio_" .strtolower(situacaoRel($Rs["AVALI_SITUACAO"])). ".php?Referencia=" .$Rs["LANCA_NUMRAR"]. "','popup_nf','width=700,height=480,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')" : "#")?>"><img src="imagens/imprimir.gif" alt="Imprimir carta-resposta para o cliente" width="20" height="20" border="0"></a></div></td>

              <td width="3%" ><div align="center"><a onclick="abrir_janela_popup('email_avaliacoes_realizadas.php?Referencia=<?=$Rs["LANCA_NUMRAR"]?>','prenota','width=400,height=400,top=0,left=0, scrollbars=no,status=no,resizable=no,dependent=yes')" href="#"><img src="imagens/email.gif" alt="Encaminhar reclama&ccedil;&atilde;o para agenciador" width="20" height="20" border="0"></a></div></td>

              <td width="5%"><div align="center"><img src="imagens/<?=$Categoria?>" width="40" height="40" border="0" alt="<?=$Descricao?>"></div></td>

              <td><div align="center"><a href="pesq_avaliacao_realizada.php?Id=<?=$Rs["LANCA_NUMRAR"]?>">

                  <?=$Rs["LANCA_NUMRAR"]?>

              </a></div></td>

              <td><div align="center"><?=$Rs["LANCA_NBLOCO_ANALISE"]?></div></td>

              <td width="10%"><div align="center">

                <?=$Rs["DATA_AVAL"]?>

              </div></td>

              <td width="5%"><div align="center"><img src="imagens/<?=((trim(situacao($Rs["AVALI_SITUACAO"]))) ? "" .strtolower(situacao($Rs["AVALI_SITUACAO"])) : "naoavaliado")?>.gif" width="15" height="15"></div></td>

              <td><?=$Rs["PESSOA"]?> 

                - 

                    <?=$Rs["NOME"]?>                </td>

              <td width="30%"><?=$Rs["FABRICA"]?></td>

              </tr>

	<? } ?>

          </table>

          <table width="100%"  border="0" align="center" class="">

            <tr>

              <td colspan="3"><div align="center" class=""></div></td>

            </tr>

            <tr class="">

              <td width="20%"><div align="center">              </div></td>

              <td width="20%"><div align="right"></div></td>

              <td width="60%"><div align="center" class="">

                  <div align="right" class="tab_inclusao"><strong class="">Resumo da pesquisa</strong>: Total de reclama&ccedil;&otilde;es:

                      <?=$TotalReclamacao?>

&nbsp;- Total de pares:

          <?=$TotalPares?>

                  </div>

                </div>

                  <div align="center" class="style1">

                    <div align="right"></div>

                </div></td>

            </tr>

          </table>

          <br>

          <table width="100%"  border="0">

            <tr class="">

              <td width="10%" class=""><strong>Legenda:</strong></td>

              <td width="3%" class=""><div align="center"><img src="imagens/procedente.gif" width="13" height="14"></div></td>

              <td width="20%" class=""><strong>Avalia&ccedil;&otilde;es procedentes </strong></td>

              <td width="3%" class=""><div align="center"><img src="imagens/improcedente.gif" width="15" height="15"></div></td>

              <td width="20%" class=""><strong>Avalia&ccedil;&otilde;es improcedentes </strong></td>

              <td width="3%" class=""><div align="center"><img src="imagens/emanalise.gif" width="13" height="14"></div></td>

              <td width="20%" class=""><strong>Avalia&ccedil;&otilde;es em an&aacute;lise </strong></td>
			  
			  <td width="3%" class=""><div align="center"><img src="imagens/conserto.gif" width="13" height="14"></div></td>

              <td width="20%" class=""><strong>Avalia&ccedil;&otilde;es em conserto </strong></td>

            </tr>
          </table>

		  <br />

		  <table width="748" border="0" cellspacing="0" cellpadding="0">

      		<tr>

        		<td><div align="left"><p>P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?></p></div></td>

      		</tr>

		  </table>

          </div></td>

        </tr>

		<? } ?>

    </table>

<input type="hidden" name="PESQUISAR" value="S">	

   </form>

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

function FilterSearch() {

	if (document.form.DT_INICIAL.value == "" || document.form.DT_FINAL.value == "") {

		alert("Preencha os campos data final e inicial");

		return;

	}

	if (!JSUtilValidaData(document.form.DT_INICIAL.value,false) || !JSUtilValidaData(document.form.DT_FINAL.value,false)) {

		alert("As datas informadas devem ser datas válidas !");

		return;

	}

	document.form.submit();

}



function clearForm() {

		for(x = 0; x < document.form.elements.length - 2; x++) {

			if (document.form.elements[x].name.substring(0,2) != "C_")

				document.form.elements[x].disabled = false;

		}

	}

//-->

</script>