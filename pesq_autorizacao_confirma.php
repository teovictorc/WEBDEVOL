<? include("inc/headerI.inc.php"); 

	verifyAcess("ARZ_AUTORIZACAOCOLET","S");

	$IDS = str_replace("\'","'",$_POST['Ids']);

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



//-->

</script>



<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}

//-->

</script>

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_reloadPage(init) {  //reloads the window if Nav4 resized

  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {

    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}

  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();

}

MM_reloadPage(true);

//-->

</script>



<body onLoad="MM_preloadImages('imagens/gerar_autorizacao2.jpg','imagens/enviar_autorizacao2.jpg')">

<div id="mensagem" name="mensagem" style="position:absolute; left:157px; top:200px; width:494px; height:48px; z-index:1; background-color: #FFFF99; layer-background-color: #FFFF99; visibility: hidden; border: 1px none #000000;">

  <div align="center">

    <p class="texto_obrigatorio"><br>

      <strong>Aguarde...gerando autoriza&ccedil;&atilde;o de coleta !</strong><br>

    </p>

  </div>

</div>

<form name="form" method="get" action="pesq_avaliacoes_pendentes.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Gerenciamento de autoriza&ccedil;&atilde;o de coleta::</span></td>

       <td width="51%"><div align="right"></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td width="100%"> <div align="center">

          <table width="100%"  border="0" align="center">

            <tr class="topo_listagem" >

              <td height="25" colspan="7" ><div align="center">Listagem de reclama&ccedil;&otilde;es n&atilde;o autorizadas com menos de 14 pares </div></td>

              </tr>

            <tr class="topo_listagem" >

              <td width="" ><div align="center"><input type="checkbox" name="IDS" value="" onClick="chk_checkAll(document.form.ID,this.checked);chk_checkAll(document.form.ID2,this.checked)"></div></td>

			  <td width="12%" ><div align="center">N&ordm; RAR</div></td>

              <td width="10%" ><div align="center">Data Abertura </div></td>

              <td width="10%" ><div align="center">Data Avalia&ccedil;&atilde;o</div></td>

              <td width="10%" ><div align="center">C&oacute;digo do Cliente </div></td>

              <td width="30%" >Nome do cliente

                <div align="center"></div></td>

              <td width="28%" >Fabricante</td>

              </tr>

<? 

	$Sql = "SELECT A.AVALI_SITUACAO, date_format(A.AVALI_AREZ_DATA,'%d/%m/%Y') DATAA, L.LANCA_NUMRAR, date_format(L.lanca_dataabertura,'%d/%m/%Y') AS DATA,F.NOME As FABRICA,P.PESSOA,P.NOME FROM PESSOA P, RAR_LANCAMENTO L, PESSOA F, RAR_AVALIACAO A, RAR_USUARIOXCLIENTE ".

			"WHERE L.LANCA_FABRI_IDO = F.PESSOA ".

			" AND L.lanca_pessoa = P.PESSOA ".

			" AND A.avali_numrar = L.lanca_numrar ".

			" AND AVALI_SITUACAO = 'P'".

			" AND AVALI_AUTOR_NUMAUT IS NULL AND L.LANCA_NUMRAR IN(" .$IDS. ")".

			" AND USUCLI_PESSOA = L.LANCA_PESSOA AND L.LANCA_PESSOA IN (" .$_GET['PESSSOAN']. ") AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";

	$Stmt = mysql_query($Sql);



	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

            <tr bordercolor="#00CCFF" class="listagem_naoavaliado">

              <td width="" ><div align="center"><input type="checkbox" name="ID" value="'<?=$Rs["LANCA_NUMRAR"]?>'" onClick="isCheckedAll();isCheckedAllID2(this.value.substring(1,6))"></div></td>

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

          <div align="left">&nbsp;<br>

          </div>

        </div></td>

        </tr>

      <tr>

        <td><table width="100%"  border="0" align="center">

          <tr class="topo_listagem" >

            <td height="25" colspan="5" ><div align="center">Resumo por cliente </div></td>

            </tr>

          <tr class="topo_listagem" >

            <td width="3%" ><div align="center">

            </div></td>

            <td width="12%" ><div align="center">C&oacute;d. cliente </div></td>

            <td width="61%" >Nome do cliente</td>

            <td width="12%" ><div align="center">Quantidade pares</div></td>

            <td width="12%" ><div align="center">Data reclama&ccedil;&atilde;o </div></td>

          </tr>

<? 

	$Sql = "SELECT PESSOA, NOME , SUM(ITEM_QTDE) QTDE, MIN(LANCA_DATAABERTURA) AS DATA ".

			" FROM RAR_LANCAMENTO, PESSOA, RAR_ITEM ".

			" WHERE LANCA_NUMRAR IN(" .$IDS. ") AND LANCA_NUMRAR = ITEM_NUMRAR ".

			" AND PESSOA IN (" .$_GET['PESSSOAN']. ") AND LANCA_PESSOA = PESSOA ".

			" GROUP BY PESSOA, NOME ".

			" ORDER BY 4, 3 DESC";



	$Stmt = mysql_query($Sql);



	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

          <tr bordercolor="#00CCFF" class="listagem_naoavaliado">

            <td>&nbsp;<input type="checkbox" name="ID2" value="<?=$Rs["PESSOA"]?>" onClick="selectChields(this.value,this.checked);isCheckedAll();"></td>

            <td><?=$Rs["PESSOA"]?>

              <div align="center"></div>

              <div align="center"></div>

              <div align="center"></div></td>

            <td><?=$Rs["NOME"]?></td>

            <td align="right"><?=$Rs["QTDE"]?></td>

            <td align="right"><div align="center">

              <?=substr($Rs["DATA"],8,2) . "/" .substr($Rs["DATA"],5,2) . "/" . substr($Rs["DATA"],0,4)?>

            </div></td>

          </tr>

          <? } ?>

        </table></td>

      </tr>

	  

      <tr>

        <td>

		<div id="idButtons" style="display:" align="center">

		<table width="100%"  border="0">

          <tr>

            <td><a href="javascript:gerarPreNota();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/gerar_autorizacao2.jpg',1)"><img src="imagens/gerar_autorizacao.jpg" alt="Gerar autoriza&ccedil;&atilde;o de coleta" name="Image34" width="125" height="24" border="0"></a></td>

          </tr>

        </table>

		</div>         

		</td>

      </tr>

	  

    </table>

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function selectChields(CODIGO,checked) {

	elementForm = document.form.ID;

	if (elementForm) {

		if (elementForm.length == undefined) {

			if (elementForm.value.substring(1,6) == CODIGO)

				elementForm.checked = checked;

		}else{

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].value.substring(1,6) == CODIGO)

					elementForm[x].checked = checked;

			}

		}

	}

}



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

	//alert(document.getElementById("idButtons").style.display);

	Values = chk_checkedAllValues(document.form.ID,true,",",true);

	if (Values == "") {

		alert("Nenhuma reclamção assinalada para a geração do número de coleta !");

		return;

	}

	document.getElementById("mensagem").style.visibility = 'visible';

	document.getElementById("idButtons").style.display = "none";

	document.location.href = "pesq_autorizacao_confirmaok.php?Categoria=<?=$_GET['Categoria']?>&Ids=" + Values;

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

function isCheckedAllID2(CODIGO) {

	var temp = isCheckedAll2(CODIGO);

	if (document.form.ID2.length == undefined) {

		document.form.ID2.checked = temp;

	}else{

		for(x = 0; x < document.form.ID2.length; x++) {

			if (document.form.ID2[x].value == CODIGO)

				document.form.ID2[x].checked = temp;

		}

	}

}



function isCheckedAll2(CODIGO) {

	elementForm = document.form.ID;

	if (elementForm) {

		if (elementForm.length == undefined) {

			return elementForm.checked;

		}else{

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].value.substring(1,6) == CODIGO)

					if (!elementForm[x].checked)

						return false;

			}

		}

	}

	return true;

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

					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? escape(elementForm[x].value) : elementForm[x].value);

			}

			return Values;

		}

	}

	return "";

}

//-->

</script>