<? include("inc/headerI.inc.php");

   include_once("inc/conn_externa.inc.php");

?>

<tr>

    <td height="100%" valign="top" class="tab_conteudo"><table width="748" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Gerenciador</h4></td>

      </tr>

      <tr>

        <td height="220" valign="top">
        <?php
            $sql = "SELECT COUNT(L.LANCA_NUMRAR) as avaliacoes_pendentes
            FROM pessoa P,
                 rar_lancamento L,
                 pessoa F,
                 rar_avaliacao A,
                 rar_usuarioxcliente UC,
                 rar_item I,
                 item_material IM
            WHERE L.LANCA_FABRI_IDO = F.PESSOA
              AND L.lanca_pessoa = P.PESSOA
              AND L.LANCA_NUMRAR = I.ITEM_NUMRAR
              AND (A.avali_numrar = L.lanca_numrar
                   OR A.avali_numrar IS NULL)
              AND LANCA_STATUS = '1'
              AND UC.USUCLI_PESSOA = L.LANCA_PESSOA
              AND I.item_REFERENCIA = IM.cd_item_material
              AND UC.USUCLI_USUAR_IDO = '{$_SESSION['sId']}'
              AND LANCA_NUMRAR NOT LIKE 'M%'";
              $Stmt = mysql_query($sql);
              while ($row = mysql_fetch_array($Stmt)){
                $TotalReclamacao = (int)$row["avaliacoes_pendentes"];
              }
          ?>
            <p><strong>Bem vindo a nossa Ferramenta de Gerenciamento</strong></p>
            <?php if(!empty($TotalReclamacao) || $TotalReclamacao > 0){ ?><h6 class="bg-danger" style="padding:15px 10px">Voc&ecirc; tem <a href="pesq_avaliacao_pendente.php"><?=$TotalReclamacao?> avalia&ccedil;&otilde;es</a> pendentes!</h6><?php } ?>
          Aqui voc&ecirc; gerencia o site da <strong><?=$NomeSistema?></strong>. <br>

        </td>

      </tr>

    </table>

    </td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$NomeDesenvolvedor?> <br>

    <?=$FoneDesenvolvedor?>  -   <?=$CelDesenvolvedor?>  - <?=$EmailDesenvolvedor?></td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>

</body>

</html>