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

<form name="form" method="post" action="#">



<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="5%"><img name="wfa_arezzo_r7_c1" src="imagens/img/wfa_arezzo_r7_c1.jpg" width="35" height="38" border="0" alt=""></td>

    <td width="94%" background="imagens/fundo_tabela_topo.jpg"><span class="titulo style3">:: Consulta NF emitida :: </span></td>

    <td width="1%"><img name="wfa_arezzo_r7_c11" src="imagens/img/wfa_arezzo_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

    <td rowspan="2" background="imagens/img/wfa_arezzo_r8_c1.jpg">&nbsp;</td>

    <td height="0"></td>

    <td rowspan="2" background="imagens/img/wfa_arezzo_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td><table width="100%"  border="0" align="center" class="tabela">

        <tr>

          <td width="12%" class="style2"><strong>Cliente</strong></td>

          <td width="88%"><input name="textfield3" type="text" class="campo_amarelo" value="<?=$_GET['ClienteNome']?>" size="50" maxlength="50" readonly></td>

        </tr>

        <tr>

          <td class="style2"><strong >Refer&ecirc;ncia</strong></td>

          <td><input name="textfield22" type="text" class="campo_amarelo" value="<?=$_GET['Referencia']?>" size="19" maxlength="19" readonly></td>

        </tr>

        <tr class="listagem_azul" >

          <td colspan="2"><div align="center"><strong>Assinale a NF desejada </strong></div></td>

        </tr>

    </table>

      <table width="100%"  border="0" align="center">

        <tr class="topo_listagem" >

          <td width="4%" ><div align="center"></div></td>

          <td width="17%" height="25" >N&ordm; NF/S&eacute;rie</td>

          <td width="19%" ><div align="center">Data da NF </div></td>

		  <td width="60%" >Emitente</td>

        </tr>

<? 

	if ($_GET['Pessoa'] != "" && strlen($_GET['Pessoa']) > 5){

		$Pessoa = substr($_GET['Pessoa'],0,strlen($_GET['Pessoa'])-1);

	}else{

		$Pessoa = $_GET['Pessoa'];

	}

	

	$Sql =  "select distinct P.NOME, nofi.PESSOA_EMITENTE, nofi.NUM_NF, nofi.SERIE_NF".

            "     ,DATE_FORMAT(nofi.dt_emis_nf,'%d/%m/%Y') As DT_EMIS_NF ". 

			"     ,datediff(CURRENT_DATE(),nofi.dt_emis_nf) DIAS ".

			"	  ,itnf.CD_ITEM_MATERIAL ". 

			"     ,itnf.CD_COLECAO ". 

			"     ,itnf.VL_UNITARIO_ITEM ". 

			"     ,itnf.VL_ROYL_CLIN_NORMAL".

			"     ,sum(itnf.TL_ITEM) as TL_ITEM ". 

			" from item_nota_fiscal     itnf ". 

			"     ,nota_fiscal          nofi, PESSOA P ". 

			"where nofi.pessoa_emitente = itnf.pessoa_emitente ". 

			"  and nofi.serie_nf        = itnf.serie_nf ". 

			"  and P.PESSOA             = itnf.pessoa_emitente ". 

			"  and nofi.num_nf          = itnf.num_nf ";

			if (strlen($Pessoa) > 5){

			//"  and nofi.pessoa_destinatario = '" .$_GET['Pessoa']. "' ". 

				$Sql = $Sql."  and nofi.pessoa_destinatario in (" .$Pessoa. ") ";

			}else{

				$Sql = $Sql."  and nofi.pessoa_destinatario = " .$Pessoa;

			}

				

			$Sql = $Sql."  and itnf.cd_item_material = '" . $_GET['Referencia']. "' ".

			" group by P.NOME, ".

			           " nofi.PESSOA_EMITENTE,".

					   " nofi.NUM_NF,".

					   " nofi.SERIE_NF,".

					   " DT_EMIS_NF, ". 

			           " itnf.CD_ITEM_MATERIAL, ". 

			           " itnf.CD_COLECAO, ". 

			           " itnf.VL_UNITARIO_ITEM, ".

					   " itnf.VL_ROYL_CLIN_NORMAL".

			" order by nofi.dt_emis_nf";

	//die($Sql);					 

	$Stmt = mysql_query($Sql);

	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

        <tr bordercolor="#00CCFF" class="listagem" onMouseOver="javascript:this.bgColor='#E1E9F7'" onMouseOut="javascript:this.bgColor='white'">

          <td >

            <div align="center">

              <input name="codNF" type="radio" class="style1" value="<?=$Rs["NUM_NF"]?>|<?=$Rs["CD_COLECAO"]?>|<?=$Rs["DT_EMIS_NF"]?>|<?=str_replace(",",".",$Rs["VL_UNITARIO_ITEM"])?>|<?=$Rs["PESSOA_EMITENTE"]?>|<?=$Rs["TL_ITEM"]?>|<?=$Rs["SERIE_NF"]?>|<?=$Rs["DIAS"]?>|<?=str_replace(",",".",$Rs["VL_ROYL_CLIN_NORMAL"])?>">

          </div></td>

          <td><?=$Rs["NUM_NF"]."/".$Rs["SERIE_NF"]?></td>

          <td><div align="center"><?=$Rs["DT_EMIS_NF"]?></div></td>

		  <td><?=$Rs["PESSOA_EMITENTE"]?> - <?=$Rs["NOME"]?></td>

        </tr>

	<? } ?>

        <tr bordercolor="#00CCFF" class="listagem">

          <td colspan="4" ><div align="center">

              <input name="Button" type="button" class="campo_texto" value="Confirmar sele&ccedil;&atilde;o" onClick="confirmSelection();">

              <input name="Submit2" type="button" class="campo_texto" value="Cancelar" onClick="javascript:window.close();">

          </div></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td><img name="wfa_arezzo_r9_c1" src="imagens/img/wfa_arezzo_r9_c1.jpg" width="35" height="25" border="0" alt=""></td>

    <td background="imagens/img/wfa_arezzo_r9_c2.jpg"><div align="center">

    </div></td>

    <td><img name="wfa_arezzo_r9_c11" src="imagens/img/wfa_arezzo_r9_c11.jpg" width="33" height="25" border="0" alt=""></td>

  </tr>

</table>

</form>

<script language="javascript" type="text/javascript">

<!--

function confirmSelection() {

	if (document.form.codNF) {

		yCod = -1;

		if (!document.form.codNF.length) {

			if (document.form.codNF.checked) {

				yCod = 899;

				dataValue = document.form.codNF.value.split("|");

			}

		}else{

			for(x = 0; x < document.form.codNF.length; x++) {

				if (document.form.codNF[x].checked) {

					yCod = x;

					break;		

				}

			}

			if (yCod != -1)

				dataValue = document.form.codNF[yCod].value.split("|")

		}



		if (yCod == -1) 

			alert("Assinale uma NF para seleção !");

		else{

			if (dataValue[7] > 3666 && "<?=$_GET['Pessoa']?>" !="18500") {

				alert("A NF selecionada foi comercializada a mais de 2 ano. Selecione outra NF !");

			}else

			{

				window.opener.document.form.ITEM_NF.value = dataValue[0];

				window.opener.document.form.ITEM_COLECAO.value = dataValue[1];

				window.opener.document.form.ITEM_DATA_EMISSAO.value = dataValue[2];

				window.opener.document.form.ITEM_VALOR_UNITARIO.value = "R$ " + window.opener.arredondaNumber(dataValue[3],",",2,true);

				window.opener.document.form.ITEM_VALOR_ROYALTIE.value = "R$ " + window.opener.arredondaNumber(dataValue[8],",",2,true);

				window.opener.document.form.ITEM_PESSOA_EMITENTE.value = dataValue[4];

				window.opener.document.form.TOTAL_ITENS.value = dataValue[5];

				window.opener.document.form.ITEM_SERIE.value = dataValue[6];

				window.opener.calcAll();

				window.opener.updateFabrica();

				window.close();

			}

		}

	}else

		alert("Nenhuma nota fiscal localizada para os critérios informados !");

}

//-->

</script>

</body>

</html>

