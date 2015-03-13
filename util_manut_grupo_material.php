<? include("inc/headerI.inc.php");

verifyAcess("DES_MANUT_GRUPOMAT","S");

function situacao($value) {

	switch($value) {

		case "P":

				return "Procedente";

			break;

		case "I":

				return "Improcedente";

			break;

		case "E":

				return "Em Análise";  //somente está trocado para exibicao das imagens

		default:

				return "";

	}

}

?>

<link href="wfa.css" rel="stylesheet" type="text/css">



<form name="form" method="get" action="util_manut_grupo_material.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Pesquisa de servi&ccedil;os ::</span></td>

	   <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#serv_cliente_consulta');">Help</a></span></div></td>

       <!--<td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#pesqavaliacoesreliazadas');">Help</a></span>&nbsp;</div></td>-->

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td colspan="2" class="style2"><table width="100%"  border="0" class="tabela">

          <tr  class="listagem" >

            <td colspan="2" ><div align="center" class="link">

              <p><strong>:: Informe os crit&eacute;rios de pesquisa que deseja realizar a pesquisa e clique em PESQUISAR :: <br>

                Obs.: preencha somente os campos nos quais deseja fazer o filtro </strong></p>

              </div></td>

            </tr>

          <tr  class="listagem"

>



            <td width="20%" >Data de abertura </td>

            <td  class="style1">de

                  <input name="SERVI_DATAABERTURAI" type="text" id="SERVI_DATAABERTURAI"  value="<?=$_GET['SERVI_DATAABERTURAI']?>" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">

      a

      <input name="SERVI_DATAABERTURAF" type="text" id="SERVI_DATAABERTURAF"  value="<?=$_GET['SERVI_DATAABERTURAF']?>" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10"  onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">            </td>

            </tr>

          <tr  class="listagem">



            <td >&nbsp;</td>

            <td >&nbsp;</td>

          </tr>

          <tr  class="listagem">

            <td colspan="2" ><div align="center">

                <input name="Button2" type="submit" class="campo_texto" value="Pesquisar" >

&nbsp;

        <input name="Submit2" type="reset" class="campo_texto" value="Limpar filtros" onClick="clearForm();">

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

	<? if ($_GET['PESQUISAR'] != "") {	?>

      <tr>

        <td colspan="2"> <div align="center">

          <table width="100%"  border="0" align="center">

            <tr class="topo_listagem" >

              <td width="5%" ><div align="center">Cat.</div></td>

			  <td width="15%" ><div align="center">N&ordm; Servi&ccedil;o </div></td>

              <td width="15%" ><div align="center">Data Abertura </div></td>

              <td width="40%" ><div align="left">Descri&ccedil;&atilde;o</div></td>

              <td width="15%" ><div align="center">Refer&ecirc;ncia</div></td>

              <td width="5%" ><div align="center">Qtde</div></td>

              <td width="5%" ><div align="center">Entregue</div></td>

              </tr>

<?

	$Sql = "SELECT * ".

			" FROM RAR_SERVICO, RAR_SERVICO_SOLICITACAOMATERIAL ".

			" WHERE SERVI_NUMERO = SERSM_SERVI_NUMERO ".

			"       AND (SERSM_MATERG_IDO IS NULL OR SERSM_MATERG_IDO = '')";

			

	if (trim($_GET['SERVI_DATAABERTURAI']) && trim($_GET['SERVI_DATAABERTURAF'])) {

		$Sql.= "AND SERVI_DATAABERTURA BETWEEN '" . strdata2db($_GET['SERVI_DATAABERTURAI']). "' AND '" . strdata2db($_GET['SERVI_DATAABERTURAF']). "' ";

	}

	

	$Sql.= " ORDER BY SERVI_DATAABERTURA, SERVI_NUMERO";

	$Stmt = mysql_query($Sql);

	$Num = 0;

	$TotalReclamacao = 0;

	$TotalPares = 0;

	while($Rs = mysql_fetch_assoc($Stmt)) {

			$Num = $Num + 1;

            $TotalReclamacao = $TotalReclamacao + 1;

			$TotalPares = $TotalPares + $Rs["ITEM_QTDE"];

			

			if ($Rs["SERVI_TIPPR_IDO"] == "1"){

				$Categoria = "sapato.jpg";

				$Descricao = "Calçado";

			}elseif ($Rs["SERVI_TIPPR_IDO"] == "2"){

				$Categoria = "bolsa.jpg";

				$Descricao = "Bolsa";

			}elseif ($Rs["SERVI_TIPPR_IDO"] == "3"){

				$Categoria = "cinto.jpg";

				$Descricao = "Cinto";

			}elseif ($Rs["SERVI_TIPPR_IDO"] == "4"){

				$Categoria = "carteira.jpg";

				$Descricao = "Carteira";

			}elseif ($Rs["SERVI_TIPPR_IDO"] == "5"){

				$Categoria = "bijoux.jpg";

				$Descricao = "Bijoux/Acess";

			}elseif ($Rs["SERVI_TIPPR_IDO"] == "6"){

				$Categoria = "vestuario.jpg";

				$Descricao = "Vestuário";

			}elseif ($Rs["SERVI_TIPPR_IDO"] == "7"){

				$Categoria = "embalagem.jpg";

				$Descricao = "Embalagem";

			}

			

			if ($Rs["SERVI_STATUS"] == "4"){

				$Imagem = "procedente.gif";

			}else{

				$Imagem = "improcedente.gif";

			}

			

			

            ?>

            <tr bordercolor="#00CCFF" class="<?=$Cor?>">

              <td><div align="center"><img src="imagens/<?=$Categoria?>" width="40" height="40" border="0" alt="<?=$Descricao?>"></div></td>

              <td class="style1"><div align="center"><a href="util_manut_grupo_materialcad.php?SERVI_DATAABERTURAI=<?=$_GET['SERVI_DATAABERTURAI']?>&SERVI_DATAABERTURAF=<?=$_GET['SERVI_DATAABERTURAF']?>&Id=<?=$Rs["SERSM_IDO"]?>"><?=$Rs["SERVI_NUMERO"]?></a></div></td>

              <td class="style1"><div align="center"><?=FormataDataHora($Rs["SERVI_DATAABERTURA"])?></div></td>

              <td align="center" class="style1"><div align="left"><?=$Rs["SERSM_DESCRICAO"]?></div></td>

              <td align="center" class="style1"><div align="center"><?=$Rs["SERSM_REFERENCIA"]?></div></td>

			  <td align="center" class="style1"><div align="center"><?=$Rs["SERSM_QUANTIDADE"]?></div></td>

			  <td align="center" class="style1"><div align="center"><?=$Rs["SERSM_ENTREGUE"]?></div></td>

              </tr>

	<? } ?>

          </table>

          <div align="left">

                <table width="100%"  border="0" align="center" class="tabela">

              <tr>

                <td colspan="3"><div align="center" class="style1"></div></td>

              </tr>

              <tr>

                <td width="20%">&nbsp;</td>

                <td width="20%">&nbsp;</td>

                <td width="60%"><div align="center" class="style1"><div align="right"><strong class="style1">Resumo da pesquisa</strong>: Total de servi&ccedil;os:<?=$TotalReclamacao?></div>

                </div>                  <div align="center" class="style1">

                  <div align="right"></div>

                  </div></td>

                </tr>

            </table>

          </div>

        </div></td>

        </tr>

		<? } ?>

      <tr>

        <td colspan="2"><table width="100%"  border="0">

          <tr class="tabela">

            <td width="103" class="style1">&nbsp;</td>

            </tr>

        </table></td>

      </tr>

    </table>

<input type="hidden" name="PESQUISAR" value="S">

</form>

<? include("inc/headerF.inc.php"); ?>

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

		for(x = 0; x < document.form.elements.length - 3; x++) {

			//if (document.form.elements[x].name.substring(0,2) != "C_")

				//document.form.elements[x].disabled = false;

				document.form.elements[x].value = "";

		}

	}



	<? if ($_GET['PESQUISAR'] != "") { ?>

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

	

function Chat(Servico){

	abrir_janela_popup('chat.php?SERVI_NUMERO='+Servico+'&ClienteNome=<?=$NomeCliente?>','chat','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')

}



//-->

</script>