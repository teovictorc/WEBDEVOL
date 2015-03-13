<? include("inc/headerI.inc.php"); 

verifyAcess("CADPDV_PERGUNTA","S");?>

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

<body onLoad="MM_preloadImages('imagens/excluir2.jpg','imagens/incluir2.jpg')">

<form name="form" method="post" action="#">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Cadastro de Perguntas ::</span></td>

       <td width="25%"><div align="right"><a href="cad_equipe.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"><span class="titulo"><a href="javascript: abrir_help('#pesqdefeito');">Help</a></span> </a>&nbsp;<a href="cad_equipe.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"></a>&nbsp;</div></td>

       <td width="26%"><div align="right"><a href="cad_pergunta.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"><img src="imagens/incluir.jpg" alt="Incluir novo registro" name="Image35" width="68" height="20" border="0"></a><a href="javascript:deleteById('del_pergunta.php',document.form.IDS);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/excluir2.jpg',1)"><img src="imagens/excluir.jpg" alt="Excluir registros assinalados" name="Image34" width="68" height="20" border="0"></a></div></td>

     </tr>

   </table>

</td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" align="center">

      <tr class="topo_listagem" >

        <td width="3%" height="25" ><div align="center">X</div></td>

        <td width="37%" >PERGUNTA</td>

        <td width="55%" >LEGENDA</td>

        <td width="5%" ><div align="center">ATIVO</div></td>

      </tr>

<? 

	$Sql = " SELECT * FROM RAR_PDV_PERGUNTA ";

	$Sql.= " ORDER BY PERGU_PERGUNTA";

	$Stmt = mysql_query($Sql);

	while($Rs = mysql_fetch_assoc($Stmt)) { 

	

		

		if ($Rs["PERGU_ATIVO"] == "N"){

			$Ativo = "Não";

		}else{

			$Ativo = "Sim";

		}

		

		

	?>

      <tr bordercolor="#00CCFF" class="listagem" onmouseover="javascript:this.bgColor='#E1E9F7'" onmouseout="javascript:this.bgColor='white'">

        <td >        

          <div align="center">

            <input type="checkbox" name="IDS" value="<?=$Rs["PERGU_IDO"]?>">

          </div></td>

        <td><a href="cad_pergunta.php?Id=<?=$Rs["PERGU_IDO"]?>"><?=$Rs["PERGU_PERGUNTA"]?></a></td>

        <td><a href="cad_pergunta.php?Id=<?=$Rs["PERGU_IDO"]?>"><?=$Rs["PERGU_LEGENDA"]?></a></td>

        <td><div align="center"><a href="cad_pergunta.php?Id=<?=$Rs["PERGU_IDO"]?>"><?=$Ativo?></a></div></td>

      </tr>

 <? } ?>

    </table>

</form>

<? include("inc/headerF.inc.php"); ?>