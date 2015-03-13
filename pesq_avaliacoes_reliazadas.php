<? include("inc/headerI.inc.php");

verifyAcess("CLIPESQRECLAMACAO","S");

function situacao($value) {

	switch($value) {

		case "P":

				return "Procedente";

			break;

		case "I":

				return "Improcedente";

			break;

		case "E":

				return "Emanalise";  //somente está trocado para exibicao das imagens
		
		case "F":

				return "Emanalise";

		case "C":

				return "Conserto";  //somente está trocado para exibicao das imagens
		
		default:

				return "Aguardando";

	}

}

?>

<link href="wfa.css" rel="stylesheet" type="text/css"><form name="form" method="get" action="pesq_avaliacoes_reliazadas.php">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Avalia&ccedil;&otilde;es realizadas</h4></td>

      </tr>

	  <tr>

	  	<td align="center" class="tab_titulo" style="padding-top:10px; padding-bottom:10px;">

			<strong>:: Informe os crit&eacute;rios de pesquisa que deseja realizar a pesquisa e clique em PESQUISAR :: <br>

            Obs.: preencha somente os campos nos quais deseja fazer o filtro </strong>		

		</td>

	  </tr>

    </table>

  <table width="100%"  border="0" class="tab_inclusao">

      <tr>

        <td colspan="2" class="">

		<table width="100%"  border="0" class="tab_inclusao">

        <tr  class="" >

            <td width="20%" a href="cad_defeitos.php">N.&ordm; Reclama&ccedil;&atilde;o</td>

            <td width="30%" a href="cad_defeitos.php">

              <input name="LANCA_NUMRAR" type="text" class="form" id="LANCA_NUMRAR" size="13" maxlength="12" value="<?=$_GET['LANCA_NUMRAR']?>">

            </td>

            <td width="20%" a href="cad_defeitos.php">&nbsp;</td>

            <td width="30%" a href="cad_defeitos.php">&nbsp;</td>

          </tr>

          <tr  class="">

            <td a href="cad_defeitos.php">Cliente</td>

            <td colspan="3" a href="cad_defeitos.php">

              <select name="LANCA_PESSOA" class="form" id="LANCA_PESSOA" >

                <option value="">...Selecione</option>

                	<? $Stmt = mysql_query("SELECT USUCLI_PESSOA, NOME FROM rar_usuarioxcliente, pessoa WHERE PESSOA = USUCLI_PESSOA AND USUCLI_USUAR_IDO = " .$_SESSION['sId']. " ORDER BY USUCLI_PESSOA");

			   		while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

                		<option  <? if ($_GET['LANCA_PESSOA'] == $Rs["USUCLI_PESSOA"]){?> selected <? }?> value="<?=$Rs["USUCLI_PESSOA"]?>"><?=arrumaPessoa($Rs["USUCLI_PESSOA"])?> - <?=$Rs["NOME"]?></option>

                	<? } ?>

              </select>

            </td>

            </tr>

          <tr  class="">



            <td a href="cad_defeitos.php">Data de abertura </td>

            <td a href="cad_defeitos.php" class="">de

                  <input name="LANCA_DATAABERTURAI" type="text" class="form" id="LANCA_DATAABERTURAI"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');"  value="<?=$_GET['LANCA_DATAABERTURAI']?>" size="9" maxlength="10" #invalid_attr_id="#FFF">

      a

      <input name="LANCA_DATAABERTURAF" type="text" id="LANCA_DATAABERTURAF"  value="<?=$_GET['LANCA_DATAABERTURAF']?>" class="form" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

            </td>

            <td a href="cad_defeitos.php"><div align="right">Data de avalia&ccedil;&atilde;o: &nbsp;</div></td>

            <td a href="cad_defeitos.php" class="">de

                <input name="AVALI_AREZ_DATAI" type="text" id="AVALI_AREZ_DATAI"  value="<?=$_GET['AVALI_AREZ_DATAI']?>" class="form" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

a

<input name="AVALI_AREZ_DATAF" type="text" id="AVALI_AREZ_DATAF"  value="<?=$_GET['AVALI_AREZ_DATAF']?>" class="form" size="9" maxlength="10"   onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

            </td>

          </tr>

          <tr  class=""

>

            <td a href="cad_defeitos.php">Linha</td>

            <td a href="cad_defeitos.php"><input name="LINHA" type="text" class="form" id="LINHA" size="6" maxlength="4" value="<?=$_GET['LINHA']?>"></td>

            <td a href="cad_defeitos.php"><div align="right">Modelo:&nbsp;</div></td>

            <td a href="cad_defeitos.php"><input name="MODELO" type="text" class="form" id="MODELO" size="6" maxlength="4" value="<?=$_GET['MODELO']?>"></td>

          </tr>

          <tr class="">

            <td>Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </td>

            <td>

              <select name="AVALI_SITUACAO" class="form" id="AVALI_SITUACAO" >

                <option value="">...Selecione</option>

                <option value="P" <? if ($_GET['AVALI_SITUACAO'] == "P"){?> selected <? }?>>Procedente</option>

                <option value="I" <? if ($_GET['AVALI_SITUACAO'] == "I"){?> selected <? }?>>Improcedente</option>

				<option value="E" <? if ($_GET['AVALI_SITUACAO'] == "E"){?> selected <? }?>>Em Análise</option>

				<option value="A" <? if ($_GET['AVALI_SITUACAO'] == "A"){?> selected <? }?>>Avaliação não iniciada</option>

              </select>

            </td>

            <td><div align="right">Categoria:&nbsp;</div></td>

            <td><select name="LANCA_CATEGORIA" class="form" id="LANCA_CATEGORIA" >

              <option value="">...Selecione</option>
              <option value="1" <? if ($_GET['LANCA_CATEGORIA'] == "1"){?> selected <? }?>>Calçados</option>
		      <option value="2" <? if ($_GET['LANCA_CATEGORIA'] == "2"){?> selected <? }?>>Sandálias</option>
			  <option value="3" <? if ($_GET['LANCA_CATEGORIA'] == "3"){?> selected <? }?>>Botas</option>
			  <option value="4" <? if ($_GET['LANCA_CATEGORIA'] == "4"){?> selected <? }?>>Tamancos</option>
			  <option value="5" <? if ($_GET['LANCA_CATEGORIA'] == "5"){?> selected <? }?>>Bolsas</option>
			  <option value="6" <? if ($_GET['LANCA_CATEGORIA'] == "6"){?> selected <? }?>>Cintos</option>
			  <option value="7" <? if ($_GET['LANCA_CATEGORIA'] == "7"){?> selected <? }?>>Carteiras</option>
			  <option value="8" <? if ($_GET['LANCA_CATEGORIA'] == "8"){?> selected <? }?>>Acessórios</option>
            </select></td>

          </tr>

          <tr bordercolor="#00CCFF" class=""

>

            <td a href="cad_defeitos.php">Nome do consumidor</td>

            <td colspan="3" a href="cad_defeitos.php"><input name="LANCA_CLIENTE_NOME"  value="<?=$_GET['LANCA_CLIENTE_NOME']?>" type="text" class="form" id="LANCA_CLIENTE_NOME" size="50" maxlength="50" ></td>

          </tr>

          <tr  class="">



            <td a href="cad_defeitos.php">&nbsp;</td>

            <td colspan="3" a href="cad_defeitos.php">&nbsp;</td>

          </tr>

          <tr  class="">

            <td colspan="4" ><div align="center">

                <input name="Button2" type="submit" class="form" value="Pesquisar" >

&nbsp;

        <input name="Submit2" type="reset" class="form" value="Limpar filtros" onClick="clearForm();">

</div></td>

          </tr>

        </table></td>

        </tr>

      <!--

	  <tr>

        <td width="47%" class="style2"><div align="right"><strong>Per&iacute;odo de pesquisa: </strong></div></td>

        <td width="53%" height="50" valign="middle" class="style1"> <strong>de

            <input name="DT_INICIAL" type="text" class="campo_texto" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_INICIAL']?>" size="9" maxlength="10">

          a

          <input name="DT_FINAL" type="text" class="campo_texto" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_FINAL']?>" size="9" maxlength="10">

        </strong>          <a href="javascript:FilterSearch();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/pesquisar2.jpg',1)"><img src="imagens/pesquisar.jpg" name="Image34" width="78" height="20" border="0" align="middle"></a> :: <a href="javascript:abrir_janela_popup('pesq_avancada.php?Filtro=<?=$_SESSION['sId']?>','popup_nf','width=600,height=400,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')">Pesquisa avan&ccedil;ada</a> :: </td>

        </tr>

		-->

	<? if ($_GET['PESQUISAR'] != "1") {	?>

      <tr>

        <td colspan="2"> <div align="center">

          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios" >

              <td width="4%" ><div align="center">&nbsp;</div></td>

              <td width="3%" ><div align="center"><img src="../img/bts/selecionar.jpg" border="0"></div></td>

              <td width="5%" ><div align="center">Cat.</div></td>

              <td width="12%" ><div align="center">N&ordm; RAR</div></td>

              <td width="10%" ><div align="center">DATA ABERTURA </div></td>

              <td width="10%" ><div align="center">SITUA&Ccedil;&Atilde;O AVALIA&Ccedil;&Atilde;O </div></td>
			  <td width="10%" ><div align="center">DATA AVALIAÇÃO </div></td>

              <td width="10%" ><div align="center">C&Oacute;DIGO CLIENTE </div></td>

              <td width="30%" >NOME DO CLIENTE

                <div align="center"></div></td>

              <td width="28%" >FABRICANTE</td>

              </tr>

<?



	$Sql = "SELECT DS_RESUMIDA_ITEM DESCRICAO, I.ITEM_QTDE, A.AVALI_SITUACAO, L.LANCA_CATEGORIA, 
	               L.LANCA_NUMRAR, date_format(L.lanca_dataabertura,'%d/%m/%Y') AS DATA,F.NOME As FABRICA,P.PESSOA,
				   P.NOME , date_format(A.AVALI_AREZ_DATA,'%d/%m/%Y') AS DATA_AVALIACAO
			  FROM pessoa P, rar_lancamento L, pessoa F, rar_avaliacao A, rar_item I, rar_usuarioxcliente, item_material IM ".
			"WHERE L.LANCA_FABRI_IDO = F.PESSOA ".
			"      AND L.lanca_pessoa = P.PESSOA ".
			"      AND (A.avali_numrar = L.lanca_numrar or A.avali_numrar is null) ".
			"      AND I.ITEM_NUMRAR = L.LANCA_NUMRAR ".
			"      AND USUCLI_PESSOA = L.LANCA_PESSOA ".
			"      AND I.item_REFERENCIA = IM.cd_item_material".
			"      AND L.LANCA_STATUS <> 'I' ".
			"      AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
			if ($_SESSION['Menu'] == "3"){
				$Sql.= " AND LANCA_NUMRAR LIKE 'M%'";
			}else{
				$Sql.= " AND LANCA_NUMRAR NOT LIKE 'M%'";
			}	
 
	if (trim($_GET['LANCA_NUMRAR'])) {

		$Sql.= "AND L.LANCA_NUMRAR = '" .$_GET['LANCA_NUMRAR']. "' ";

	}



	if (trim($_GET['LANCA_CLIENTE_NOME'])) {

		$Sql.= "AND L.LANCA_CLIENTE_NOME like '%" .$_GET['LANCA_CLIENTE_NOME']. "%' ";

	}



	if (trim($_GET['LANCA_PESSOA'])) {

		$Sql.= "AND L.LANCA_PESSOA = '" .$_GET['LANCA_PESSOA']. "' ";

	}

	

	if (trim($_GET['LANCA_CATEGORIA'])) {

		$Sql.= "AND L.LANCA_CATEGORIA = '" .$_GET['LANCA_CATEGORIA']. "' ";

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

		$Sql.= "AND A.AVALI_AREZ_DATA BETWEEN '" . strdata2db($_GET['AVALI_AREZ_DATAI']). "' AND '" .strdata2db($_GET['AVALI_AREZ_DATAF']). "' ";

	}

	if (trim($_GET['AVALI_SITUACAO'])) {

		if ($_GET['AVALI_SITUACAO'] == "A"){

			$Sql.= "AND (A.AVALI_SITUACAO is null or A.AVALI_SITUACAO = '' ) ";

		}else{

			$Sql.= "AND A.AVALI_SITUACAO = '" .$_GET['AVALI_SITUACAO']. "' ";

		}

	}else{

		//$Sql.= "AND (A.AVALI_SITUACAO is null or A.AVALI_SITUACAO = '' or A.AVALI_SITUACAO = 'E' ) ";

	}



	$Sql.= " ORDER BY lanca_dataabertura, lanca_numrar ";

	//echo($Sql);

	

	$_pagi_sql = $Sql;

	

	$Stmt = mysql_query($Sql);

    $Num = 0;

	$TotalReclamacao = 0;

	$TotalPares = 0;

	

	while($Rs2 = mysql_fetch_assoc($Stmt)){

		$Num = $Num + 1;

		$TotalReclamacao = $TotalReclamacao + 1;

		$TotalPares = $TotalPares + $Rs2["ITEM_QTDE"];	

	}	



	include_once("inc/paginator.inc.php");

		

	while($Rs = mysql_fetch_assoc($_pagi_result)) {

			//$Num = $Num + 1;

            //$TotalReclamacao = $TotalReclamacao + 1;

			//$TotalPares = $TotalPares + $Rs["ITEM_QTDE"];

			

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

              <td width="4%" ><div align="center"><a href="<?=((trim(situacao($Rs["AVALI_SITUACAO"]))) ? "javascript:abrir_janela_popup('relatorio_" .strtolower(situacao($Rs["AVALI_SITUACAO"])). ".php?Referencia=" .$Rs["LANCA_NUMRAR"]. "','popup_nf','width=700,height=480,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')" : "#")?>"><img src="imagens/imprimir.gif" alt="Imprimir carta-resposta para cliente" width="20" height="20" border="0"></a></div></td>

              <td width="3%"><input name="ch_numrar" type="checkbox" id="ch_numrar" value="<?=$Rs["LANCA_NUMRAR"]?>"></td>

              <td width="5%"><div align="center">
                  <?=$Rs["DESCRICAO"]?>
              </div></td>

              <td width="5%"><div align="center"><a href="pesq_avaliacao_realizada.php?Id=<?=$Rs["LANCA_NUMRAR"]?>"> <?=$Rs["LANCA_NUMRAR"]?></a></div></td>

              <td width="10%"><div align="center"><?=$Rs["DATA"]?></div></td>

              <td width="10%"><div align="center"><img src="imagens/<?=((trim(situacao($Rs["AVALI_SITUACAO"]))) ? "" .strtolower(situacao($Rs["AVALI_SITUACAO"])) : "naoavaliado")?>.gif" width="15" height="15"></div></td>
			  
			  <td width="10%"><div align="center"><?=$Rs["DATA_AVALIACAO"]?></div></td>

              <td width="10%"><div align="center"><?=$Rs["PESSOA"]?></div></td>

              <td width="30%"><div align="left"><?=$Rs["NOME"]?></div></td>

              <td width="30%"><?=$Rs["FABRICA"]?></td>

              </tr>

	<? } ?>

          </table>

          <div align="left">

             <table width="100%"  border="0" align="center" class="tab_conteudo">

              <tr>

                <td colspan="3"><div align="center" class=""></div></td>

              </tr>

              <tr>

                <td width="20%"><div align="center">

                  <input type="button" name="Button" class="imp_normal" value="Imprimir etiquetas" onClick="ImprimirEtiqueta();">

                </div></td>

                <td width="20%"><div align="right"></div></td>

                <td width="60%">

					<div align="right">

						<strong class="">Resumo da pesquisa</strong>: 

						Total de reclama&ccedil;&otilde;es: <?=$TotalReclamacao?>

						&nbsp;- Total de pares:<?=$TotalPares?>

					</div>

                </td>

              </tr>

			  <tr>

			  	<td colspan="3" style="padding-top:10px;">

					<table width="77%" border="0" align="center">

					  <? if ($_SESSION["Menu"] == "3"){

							$Legenda = "Autorizado coleta para posterior análise";

						}else{

							$Legenda = "Avaliações procedentes";

						}

						?>

					  <tr class="">

						<td width="12%" class=""><strong>Legenda:</strong></td>

						<td width="5%" class=""><div align="center"><img src="imagens/procedente.gif" width="15" height="15"></div></td>

						<td width="17%" nowrap="nowrap"><strong>Avalia&ccedil;&atilde;o procedente </strong></td>

						<td width="8%" class=""><div align="center"><img src="imagens/improcedente.gif" width="15" height="15"></div></td>

						<td width="28%" class="" nowrap="nowrap"><strong>Avalia&ccedil;&atilde;o improcedente</strong></td>

						<td width="4%"><div align="center"><img src="imagens/conserto.gif" width="16" height="16" /></div></td>
						<td width="26%" nowrap="nowrap"><strong>Conserto</strong></td>
					  </tr>

					  <tr class="">

					    <td class="">&nbsp;</td>

					    <td><div align="center"><img src="imagens/emanalise.gif" width="15" height="15" /></div></td>

					    <td nowrap="nowrap"><strong>Avalia&ccedil;&atilde;o em an&aacute;lise </strong></td>

					    <td class=""><div align="center"><img src="imagens/aguardando.gif" width="16" height="16" /></div></td>

					    <td nowrap="nowrap"><strong>Avalia&ccedil;&atilde;o n&atilde;o iniciada  </strong></td>

					    <td class="">&nbsp;</td>

					    <td class="" nowrap="nowrap">&nbsp;</td>
					    </tr>
			        </table>

				</td>

			  </tr>

			  <tr>

                <td colspan="3">

					<div align="left" class="">

						<br />

						P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?>

					</div>

				</td>

              </tr>

            </table>

          </div>

        </div></td>

        </tr>

		<? } ?>

      <tr>

        <td colspan="2">

		<!--<table width="100%"  border="0">

          <tr class="">

            <td colspan="7" class="">&nbsp;</td>

          </tr>

		  <? if ($_SESSION["Menu"] == "3"){

		  		$Legenda = "Autorizado coleta para posterior análise";

			}else{

				$Legenda = "Avaliações procedentes";

			}

		  	?>

          <tr class="">

            <td width="10%" class=""><strong>Legenda:</strong></td>

            <td width="3%" class=""><div align="center"><img src="imagens/procedente.gif" width="13" height="14"></div></td>

            <td width="28%" class=""><strong><?=$Legenda?></strong></td>

            <td width="3%" class=""><div align="center"><img src="imagens/improcedente.gif" width="15" height="15"></div></td>

            <td width="28%" class=""><strong>Avalia&ccedil;&otilde;es improcedentes </strong></td>

            <td width="3%" class=""><div align="center"><img src="imagens/emanalise.gif" width="13" height="14"></div></td>

            <td width="28%" class=""><strong>Avalia&ccedil;&otilde;es em an&aacute;lise </strong></td>

          </tr>

        </table>--></td>

      </tr>

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



	function abrir_janela_popup(theURL,winName,features) {

		window.open(theURL,winName,features);

	}



	function PesquisaAvancada(){

		abrir_janela_popup('pesq_avancada.php?Filtro=<?=$_SESSION['sId']?>','popup_nf','width=600,height=400,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

	}



	function checkControl(option,elements) {

		alert('aqui...');

		for (x = 0; x < elements.length; x++) {

			document.form.elements[elements[x]].disabled = !option;

			if (!option)

				document.form.elements[elements[x]].value = "";

		}

	}



	function clearForm() {

		for(x = 0; x < document.form.elements.length - 2; x++) {

			if (document.form.elements[x].name.substring(0,2) != "C_")

				document.form.elements[x].disabled = false;

		}

	}



	<? //if ($_GET['PESQUISAR'] != "")
       if (1 == 1)	{ ?>

		function ImprimirEtiqueta(){
			rar = "";

			total = document.form.ch_numrar.length;

			if (<?=$Num?> == "1"){

				rar = "'" + document.form.ch_numrar.value + "',"

			}else{

				for(x=0;x < total; x++) {

					if (document.form.ch_numrar[x].checked){

						rar = rar + "'" + document.form.ch_numrar[x].value + "',"

					}

				}

			}

			rar = rar + ","

			abrir_janela_popup('imp_etiqueta.php?Rar='+rar,'popup_nf','width=700,height=280,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

		}

	<? } ?>



//-->

</script>

</body>

</html>