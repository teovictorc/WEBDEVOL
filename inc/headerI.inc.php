<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html>

<head>
<?php include("conn.inc.php");

function base_url(){
 return "http://" . $_SERVER['SERVER_NAME']."/WEBDEVOl/principal.php";
}

if($_SESSION['Menu'] == 2){

	$ImagemTopo = "wfa_arezzo_r4_c4_s.jpg";

}elseif($_SESSION['Menu'] == 3){

	$ImagemTopo = "wfa_arezzo_r4_c4_tm.jpg";

}elseif($_SESSION['Menu'] == 4){

	$ImagemTopo = "wfa_arezzo_r4_c4_r.jpg";

}elseif($_SESSION['Menu'] == 5){

	$ImagemTopo = "wfa_arezzo_r4_c4_iaf.jpg";

}elseif($_SESSION['Menu'] == 6){

	$ImagemTopo = "wfa_arezzo_r4_c4_pesq.jpg";

}else{

	$ImagemTopo = "wfa_arezzo_r4_c4_t.jpg";

}

$_GET["Categoria"] = "1,2,3,4,5,6,7,8,9,10,11";

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?=$NomeSistema?></title>

<link rel="stylesheet" href="css/bootstrap.css">
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script language="JavaScript" type="text/JavaScript">

<!--

function abrir_janela_popup(theURL,winName,features) { //v2.0

window.open(theURL,winName,features);

}



function abrir_help(theURL,winName,features) { //v2.0

	theURL = 'help/assistenteconteudo.htm'+theURL;

	window.open(theURL,'help','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=no');

	}



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

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



<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>



<link href="wfa.css" rel="stylesheet" type="text/css">

</head>

<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">

<script type="text/javascript" src="js/validacao.js"></script>

<script type="text/javascript" src="js/util.js"></script>

<script type="text/javascript" src="menu/milonic_src.js"></script>

<script	type="text/javascript">

if(ns4)_d.write("<scr"+"ipt type=text/javascript src=menu/mmenuns4.js><\/scr"+"ipt>");

  else _d.write("<scr"+"ipt type=text/javascript src=menu/mmenudom.js><\/scr"+"ipt>");



function deleteById(sPage,FormID) {

	var Ids = "";

	if(confirm("Confirma a exclusão do(s) registro(s)?")==true){

		if (FormID) {

			if(isArray(FormID)){

				if (FormID.length == undefined) {

					if (FormID.checked)

						Ids = "'" + escape(FormID.value) + "'";

				}else{

					for(x = 0; x < FormID.length; x++) {

						if (FormID[x].checked)

							Ids+= ((Ids.length == 0) ? "" : ",") + "'" + escape(FormID[x].value) + "'";

					}

				}

			}else if (FormID.length > 0){

				Ids = FormID;

			}

		}

		if (Ids == "")

			alert("Deve haver pelo menos um item selecionado !");

		else{

			document.location.href = sPage + ((sPage.indexOf("?") == -1) ? "?" : "&") + "IdDel=" + Ids;

		}

	}

}



function cancelOperation(pageDest) {

	if(confirm("Tem certeza que deseja cancelar a operação?"))

		document.location.href = pageDest;

}

</script>

<script type="text/javascript" src="menu/menu_data.php"></script>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="778" height="80" class="bg_topo">



    <table width="778" border="0" cellspacing="0" cellpadding="0" align="center">

      <tr>

        <td width="500"><a href="<?=base_url();?>"><h1><?=$NomeSistema?></h1></a></td>

        <td align="center"><h2>Ol&aacute;, <?=$_SESSION['sNome']?></h2>

          </br >

          <a href="login.php" class="email"><img src="img/bts/logof.jpg" alt="logoff" align="absmiddle" border="0"> logoff</a></td>

      </tr>

    </table>

    </td>

    <td class="bg_topo">&nbsp;</td>

  </tr>

  <tr>

    <td height="45" class="bg_cinza02">

<!--		<table width="697" height="28" border="0" cellspacing="0" cellpadding="0" id="tabmenu">

		  <tr>

			<td width="81" background="img/bgs/menu_80_on.jpg" align="center"><h3>Gerenciador</h3></td>

			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="cadastro.html" class="menu">Cadastros</a></td>

			<td width="55" background="img/bgs/menu_54.jpg" align="center"><a href="inclusao.html" class="menu">Cliente</a></td>

			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="#" class="menu">Retaguarda</a></td>

			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="#" class="menu">Parceiros</a></td>

			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="#" class="menu">Relat�rios</a></td>

			<td width="95" background="img/bgs/menu_94.jpg" align="center"><a href="#" class="menu">Configura��es</a></td>

			<td width="65" background="img/bgs/menu_64.jpg" align="center"><a href="#" class="menu">Utilit�rios</a></td>

			<td width="55" background="img/bgs/menu_54.jpg" align="center"><a href="#" class="menu">Ajuda</a></td>

			<td width="54" background="img/bgs/menu_54.jpg" align="center"><a href="#" class="menu">Alternar</a></td>

		  </tr>

		</table>

		</td>

-->    <td class="bg_cinza02">&nbsp;</td>

  </tr>