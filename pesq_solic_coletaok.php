<script language="javascript" type="text/javascript">
var Url = location.href;
Url = Url.replace(/.*\?(.*?)/,"$1");
Variaveis = Url.split ("&");
for (i = 0; i < Variaveis.length; i++) {
tmp = Variaveis[i].split("=");
eval ('var '+tmp[0]+'="'+tmp[1]+'"');
}
</script>
<?
include("inc/conn.inc.php");
	verifyAcess("TRANS_SOLCOLETA","S");

	$Sql = "UPDATE rar_prenf SET PRENF_DATA_SOLIC_COLETA = now() WHERE PRENF_NUMPRENF IN (" .$_GET['Ids']. ")";
	$Stmt = mysql_query($Sql);

	if($_GET['Categoria']==1)
	{
		$de="mercadonacional@cb.transcon.com.br";
		//$de2="ariel@cb.transcon.com.br";
	}
	if($_GET['Categoria']==2)
	{
		//alterado em 24/03/2008
		//$de="ariel@cb.transcon.com.br";
		$de="mercadonacional@cb.transcon.com.br";
	}
	include "email_solic_coleta.php";
	include("inc/mail.inc.php");

	$transps = explode(",",$_GET['transp']);
	for($y = 0; $y < count($transps); $y++)
	{

		$IDS = explode(",",$_GET['Ids']);
		for($x = 0; $x < count($IDS); $x++)
		{
		 mysql_query("INSERT INTO rar_envio_transportadora (ENVIO_IDO,ENVIO_DATA,ENVIO_PRENF_NUMPRENF,ENVIO_TRANSP_IDO)
					  VALUES ('".newIDO()."',now(), '".$IDS[$x]."','".$transps[$y]."')");
		}
		$m= new Mail;
		$m->From($de);
		$m->To(strtolower($transps[$y]));
		$m->Subject("Coletas WEBDevol!");
		if($_GET['Categoria']==1){ 
			$nome="Mercado Nacional";
			//$celular="(51) 9127-9150";
			$celular="-";
			$msn="webdevol@andarella.com.br";
			//$fone="(51) 2101-0050 Ramal: 205";
			//$fax="(51) 2101-0050 Ramal: 249";
			$fone="(21) 2298-2093";
			$fax="(21) 2298-2093";
		}
		if($_GET['Categoria']==2){ 
			$nome="Mercado Nacional";
			$celular="-";
			//alterado em 24/03/2008
			//$msn="ariel@cb.transcon.com.br";
			$msn="webdevol@andarella.com.br";
			$fone="(21) 2298-2093";
			$fax="(21) 2298-2093";
		}
		$html.="
	
	
				Atenciosamente!
				".$nome."
				Andarella
				Fone: ".$fone."
				Fax: ".$fax."
				Celular: ".$celular."
				
				E-mail/MSN ".$msn;
		$m->Body($html);
		$m->Send();
	}
	$html.=
	$m= new Mail;
	$m->From($de);
	$m->To($de);
	$m->Subject("Coletas WEBDevol!");
	$m->Body($html);
	$m->Send();

	if($de2<>"")
	{
		$html.=
		$m= new Mail;
		$m->From($de);
		$m->To($de2);
		$m->Subject("Coletas WEBDevol!");
		$m->Body($html);
		$m->Send();
	}

  echo '<script language="javascript" type="text/javascript">
		    alert("Solicitação Realizada com Sucesso !");
            window.history.go(-1);
        </script>';
?>