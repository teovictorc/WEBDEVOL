<? include("inc/headerI.inc.php"); 

verifyAcess("CONS_PESQUISA_INST","S");

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

		case "C":

				return "Conserto";  //somente está trocado para exibicao das imagens
		
		default:

				return "";

	}

}

?>

<link href="wfa.css" rel="stylesheet" type="text/css">



<form name="form" method="get" action="pesq_avaliacoes_reliazadas.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td><div align="center"><span class="titulo">:: Pesquisa de satisfa&ccedil;&atilde;o - Sistema WFA Web::</span>&nbsp;</div></td>

     </tr>

   </table>

</td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td width="100%"> <div align="center">

          <table width="100%"  border="0" align="center">

            <tr class="" >

              <td width="112%" ><div align="center" class="listagem_autorgerada">Listagem dos clientes que j&aacute; preencheram a pesquisa de satisfa&ccedil;&atilde;o </div></td>

            </tr>

<? 

	$Sql = "SELECT PESQ_PESSOA, PESQ_NOME, PESQ_RESPONSAVEL, date_format(PESQ_DATA,'%d/%m/%Y') PESQ_DATA from pesquisa_satisfacao order by pesq_data";

	$Stmt = mysql_query($Sql);

	?>

	</table>

          <table width="100%"  border="0">

            <tr class="topo_listagem">

              <td width="10%"><div align="center">Loja</div></td>

              <td width="40%"><div align="left">Nome</div></td>

              <td width="32%"><div align="left">Respons&aacute;vel</div></td>

              <td width="18%"><div align="center">Data preenchimento </div></td>

            </tr>

	<?

	while($Rs = mysql_fetch_assoc($Stmt)) { 

            ?>

            <tr class="imp_normal_total">

              <td align="center"><?=$Rs["PESQ_PESSOA"]?></td>

              <td><?=substr($Rs["PESQ_NOME"],0,20)?></td>

              <td><?=$Rs["PESQ_RESPONSAVEL"]?></td>

              <td><?=$Rs["PESQ_DATA"]?>

                <div align="center"></div></td>

            </tr>

			<? } ?>

          </table>

          <div align="left">            <br>

          </div>

        </div></td>

        </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

    </table>

</form>

<? include("inc/headerF.inc.php"); ?>

