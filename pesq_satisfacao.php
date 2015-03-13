<? include("inc/headerI.inc.php"); 

verifyAcess("CONS_PESQUISA","S");

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

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Pesquisa de satisfa&ccedil;&atilde;o - Sistema WFA Web</h4></td>

      </tr>

    </table>

	

    <table width="100%"  border="0" class="">

      <tr>

        <td width="100%"> <div align="center">

          <table width="100%"  border="0" align="center">

            <tr class="" >

              <td width="112%" ><table width="100%"  border="0" cellpadding="0" cellspacing="0">

                <tr class="">

                  <td height="20" colspan="2" class="tab_usuarios" style="padding-bottom:10px;padding-top:10px;"><div align="center" class="">Legenda<br>

                    1 - totalmente satisfeito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5 - totalmente insatisfeito </div></td>

                  </tr>

                <tr class="tab_usuarios_info">

                  <td class=""><strong>Pergunta 1                   </strong></td>

                  <td class=""> Como considera a nova vers&atilde;o do sistema, aonde muitos dados s&atilde;o trazidos de forma autom&aacute;tica ? </td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td class=""><strong>Pergunta 2 </strong></td>

                  <td class=""> A integra&ccedil;&atilde;o online com a transportadora, aonde a mesma j&aacute; recebe de forma autom&aacute;tica todas as notas fiscais que est&atilde;o dispon&iacute;veis para coleta </td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td class=""><strong>Pergunta 3 </strong></td>

                  <td class=""> A facilidade na emiss&atilde;o da nota fiscal de devolu&ccedil;&atilde;o, aonde agora basta apenas copiar os dados que s&atilde;o enviados na pr&eacute;-nota </td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td class=""><strong>Pergunta 4 </strong></td>

                  <td class=""><p>A interface web da nova vers&atilde;o ficou mais amig&aacute;vel e pr&aacute;tica ? </p></td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td class=""><strong>Pergunta 5 </strong></td>

                  <td class=""> Quanto ao relat&oacute;rio de gerenciamento de etapas, aonde o mesmo demonstra de forma clara e cronol&oacute;gica em qual etapa est&aacute; a reclama&ccedil;&atilde;o. </td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td width="12%"><strong>Pergunta 6 </strong></td>

                  <td class="">Dura&ccedil;&atilde;o do treinamento</td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td><strong>Pergunta 7 </strong></td>

                  <td class=""><p>Dom&iacute;nio do assunto pelo instrutor</p></td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td><strong>Pergunta 8 </strong></td>

                  <td class=""><p>Conhecimento adquirido</p></td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td><strong>Pergunta 9 </strong></td>

                  <td class=""><p>Facilidade no relacionamento do instrutor</p></td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td><strong>Pergunta 10 </strong></td>

                  <td class=""><p>Atingimento das expectativas</p></td>

                </tr>

                <tr class="tab_usuarios_info">

                  <td><strong>Pergunta 11 </strong></td>

                  <td class=""> Resolu&ccedil;&atilde;o de d&uacute;vidas pelo instrutor </td>

                </tr>

              </table></td>

              </tr>

<? 

	$Sql = "SELECT * from pesquisa_satisfacao where pesq_aprovado = 'S' ";

	$_pagi_sql = $Sql;

	

	include_once("inc/paginator.inc.php");

	

	//$Stmt = mysql_query($Sql);

	?>

	</table>

          <table width="100%"  border="0" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios">

              <td width="8%"><div align="center">Loja</div></td>

              <td width="20%"><div align="center">Nome</div></td>

              <td width="20%"><div align="center">Respons&aacute;vel</div></td>

              <td width="3%"><div align="center">1</div></td>

              <td width="3%"><div align="center">2</div></td>

              <td width="3%"><div align="center">3</div></td>

              <td width="3%"><div align="center">4</div></td>

              <td width="3%"><div align="center">5</div></td>

              <td width="3%"><div align="center">6</div></td>

              <td width="3%"><div align="center">7</div></td>

              <td width="3%"><div align="center">8</div></td>

              <td width="3%"><div align="center">9</div></td>

              <td width="3%"><div align="center">10</div></td>

              <td width="3%"><div align="center">11</div></td>

              <td width="19%"><div align="center">Coment&aacute;rio</div></td>

            </tr>

	<?

	while($Rs = mysql_fetch_assoc($_pagi_result)) { 

            ?>

            <tr valign="top" class="tab_usuarios_info">

              <td align="center"><?=$Rs["PESQ_PESSOA"]?></td>

              <td><?=substr($Rs["PESQ_NOME"],0,20)?></td>

              <td><?=$Rs["PESQ_RESPONSAVEL"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA1"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA2"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA3"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA4"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA5"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA6"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA7"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA8"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA9"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA10"]?></td>

              <td align="center"><?=$Rs["PESQ_PERGUNTA11"]?></td>

              <td align="left"><?=$Rs["PESQ_COMENTARIO"]?></td>

            </tr>

			<? } ?>

          </table>

		</td>

        </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

    </table>

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