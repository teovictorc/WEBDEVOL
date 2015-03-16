<? include("inc/headerI.inc.php"); 

verifyAcess("ARZ_AUTORIZACAOCOLET","S");

?>

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}

//-->

</script>

<body onLoad="MM_preloadImages('imagens/gerar_autorizacao2.jpg','imagens/enviar_autorizacao2.jpg')">

<form name="form" method="get" action="pesq_avaliacoes_pendentes.php">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Gerenciamento de autoriza&ccedil;&atilde;o de coleta</h4></td>

      </tr>

    </table>



    <table width="100%"  border="0" class="">

      <tr>

        <td width="100%"> <div align="center">

          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios" >

              <td width="" ><div align="center"><input type="checkbox" name="IDS" value="" onClick="chk_checkAll(document.form.ID,this.checked)"></div></td>

			  <td width="12%" ><div align="center">N&ordm; RAR</div></td>

              <td width="10%" ><div align="center">DATA ABERTURA </div></td>

              <td width="10%" ><div align="center">DATA AVALIA&Ccedil;&Atilde;O </div></td>

              <td width="10%" ><div align="center">C&Oacute;DIGO CLIENTE </div></td>

              <td width="30%" >NOME DO CLIENTE

                <div align="center"></div></td>

              <td width="28%" >FABRICANTE</td>

              </tr>

<? 

	$Sql = " SELECT item.ITEM_QTDE,
	  avaliacao.AVALI_SITUACAO,
	  date_format(avaliacao.AVALI_AREZ_DATA,'%d/%m/%Y') AS DATAA,
	  lancamento.LANCA_NUMRAR,
	  date_format(lancamento.lanca_dataabertura,'%d/%m/%Y') AS DATA,
	  fabrica.NOME AS FABRICA,
	  pessoa.PESSOA,
	  pessoa.NOME
	  FROM rar_lancamento lancamento
	  JOIN pessoa fabrica ON (lancamento.LANCA_FABRI_IDO = fabrica.PESSOA)
	  JOIN pessoa pessoa ON (lancamento.lanca_pessoa = pessoa.pessoa)
	  JOIN rar_item item ON (lancamento.lanca_numrar = item.item_numrar)
	  JOIN rar_avaliacao avaliacao ON (avaliacao.avali_numrar = lancamento.lanca_numrar)
	  LEFT JOIN rar_autorizacao autorizacao ON (autorizacao.AUTOR_NUMAUT = avaliacao.AVALI_AUTOR_NUMAUT)
	  LEFT JOIN rar_usuarioxcliente usuarioxcliente ON (usuarioxcliente.USUCLI_PESSOA = lancamento.LANCA_PESSOA)
	  WHERE avaliacao.AVALI_SITUACAO = 'P' 
		  AND avaliacao.AVALI_AUTOR_NUMAUT IS NULL 
		  AND lancamento.LANCA_PRENFI_IDO IS NULL 
		  AND lancamento.lanca_status <> 'I'
		  AND usuarioxcliente.USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";

		   if ($_SESSION['Menu'] == "3"){

				$Sql.= " AND lancamento.LANCA_NUMRAR LIKE 'M%'";

			}else{

				$Sql.= " AND lancamento.LANCA_NUMRAR NOT LIKE 'M%'";

			}	

		   $Sql.= " ORDER BY lancamento.lanca_dataabertura, pessoa.pessoa, lancamento.lanca_numrar";

	// die($Sql);

	$Stmt = mysql_query($Sql);

	$TotalReclamacao = 0;

	$TotalPares = 0;

	

	while($Rs2 = mysql_fetch_assoc($Stmt)){

		$TotalReclamacao = $TotalReclamacao + 1;

		$TotalPares 	 = $TotalPares + $Rs2["ITEM_QTDE"];	

	}

	

	$_pagi_sql = $Sql;
	$_pagi_cuantos =  1000;
	

	include_once("inc/paginator.inc.php");

	

	while($Rs = mysql_fetch_assoc($_pagi_result)) { 

			?>

            <tr bordercolor="#00CCFF" class="tab_usuarios_info">

              <td width="" ><div align="center"><input type="checkbox" name="ID" value="'<?=$Rs["LANCA_NUMRAR"]?>'" onClick="isCheckedAll();"></div></td>

			  <td width="10%" >

                <div align="center"><a href="pesq_avaliacao_pendente.php?Id=<?=$Rs["LANCA_NUMRAR"]?>"><?=$Rs["LANCA_NUMRAR"]?></a></div></td>

              <td width="10%"><div align="center"><?=$Rs["DATA"]?></div></td>

              <td width="10%"><div align="center"><?=$Rs["DATAA"]?></div></td>

			  

              <td width="10%"><div align="center"><?=$Rs["PESSOA"]?></div></td>

              <td width="30%"><?=$Rs["NOME"]?>

                <div align="center"></div></td>

              <td width="30%"><?=$Rs["FABRICA"]?></td>

              </tr>

	<? } ?>

          </table>

		   <div id="idButtons" style="display:" align="center">

          <div align="left"><a href="javascript:gerarPreNota();"><img src="imagens/gerar_autorizacao.jpg" alt="Gerar autoriza&ccedil;&atilde;o de coleta" name="Image34" width="98" height="22" border="0"></a>&nbsp;

            <table width="100%"  border="0" align="center" class="">

              <tr>

                <td colspan="3"><div align="center" class="style1"></div></td>

              </tr>

              <tr>

                <td width="20%"><div align="center">

                          </div></td>

                <td width="20%"><div align="right"></div></td>

                <td width="60%"><div align="center" class="">

                    <div align="right"><strong class="">Resumo da pesquisa</strong>: Total de reclama&ccedil;&otilde;es:

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

            <br></div>

		  </div>

        </div></td>

        </tr>

    </table>

</form>

<form action="pesq_autorizacao_coletaok.php" method="post" name="form1">

  <input type="hidden" name="Ids" id="Ids">

   <input type="hidden" name="Categoria" id="Categoria" value="<?=$_GET['Categoria']?>">

</form>

	<br/ >

    <table width="748" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td><p>P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?></p></td>

      </tr>

    </table>

	<br/ ><br/ >

	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>



<? 





$Erro = $_GET['Erro'];



if ($Erro == "0"){

	?>

	<script>

	alert("Pré-notas geradas com sucesso !");

	</script>

	<?

}







?>

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

function gerarPreNota() {

	Values = chk_checkedAllValues(document.form.ID,true,",",true);

	if (Values == "") {

		alert("Nenhuma reclamação assinalada para a geração do número de coleta !");

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	document.form1.Ids.value = Values;

	document.form1.submit();

//	document.location.href = "pesq_autorizacao_coletaok.php?Ids=" + Values;

}



function chk_checkAll(elementForm,checked) {

	if (elementForm) {

		if (elementForm.length == undefined)

			elementForm.checked = checked;

		else{

			for(x = 0; x < elementForm.length; x++)

				elementForm[x].checked = checked;

		}

	}

}



function isCheckedAll() {

	document.form.IDS.checked = chk_isCheckedAll(document.form.ID,true);

}

function chk_isCheckedAll(elementForm,checked) {

	if (elementForm){

		if (elementForm.length == undefined)

			return (elementForm.checked == checked);

		else{

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].checked != checked) 

					return false;

			}

			return true;

		}

	}

	return false;

}



function chk_checkedAllValues(elementForm,checked,optionDiv,valueEncode) {

	if (elementForm) {

		if (elementForm.length == undefined) {

			if (elementForm.checked == checked)

				return elementForm.value;

			return "";

		}else{

			var Values = "";

			optionDiv = (optionDiv == undefined) ? "," : optionDiv;

			valueEncode = (valueEncode == undefined) ? false : valueEncode;

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].checked == checked) 

					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? elementForm[x].value : elementForm[x].value);

			}

			return Values;

		}

	}

	return "";

}

//-->

</script>