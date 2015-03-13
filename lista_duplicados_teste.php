<?    include("inc/headerI.inc.php");

      require_once("inc/conn_externa.inc.php");



   $con_Dupli = mysql_query ("SELECT usu.USUAR_NOME CONSULTOR,

       reg.pdvrg_data DATA,

       TIME(reg.pdvrg_hora_inicio) HI,

       TIME(reg.pdvrg_hora_fim) HF

  FROM rar_pdv_registro reg,

       rar_usuario usu,

       pessoa p

 WHERE exists (select *

                 from rar_pdv_registro rpr

                where rpr.pdvrg_pessoa = reg.pdvrg_pessoa

                  and rpr.pdvrg_data = reg.pdvrg_data

                  and TIME(rpr.pdvrg_hora_inicio) <= TIME(reg.pdvrg_hora_inicio)

                  and TIME(rpr.pdvrg_hora_fim) >= TIME(reg.pdvrg_hora_inicio)

                  and rpr.pdvrg_ido != reg.pdvrg_ido)

                  and usu.USUAR_IDO = reg.PDVRG_USUAR_IDO 

                  and p.pessoa = reg.PDVRG_PESSOA

ORDER BY USUAR_NOME, pdvrg_data"); 

   $row_con_Dupli = mysql_fetch_assoc($con_Dupli);

   $totalRows_con_Dupli = mysql_num_rows($con_Dupli);



?>

<link href="wfa.css" rel="stylesheet" type="text/css">

<center>

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Consulta de atividades Duplicadas ::</span></td>

	   <td width="51%"><div align="right"><span class="titulo"></span></div></td>

     </tr>

  </table>

  

  </td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

   

  <table width="100%"  border="0" align="center" class="tabela">

    <tr bgcolor="#FF9900"> 

      <td align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Consultor</font></strong></td>

      <td align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>Data</strong></font></td>

      <td align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Hora 

        Inicial</font></strong></td>

      <td align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Hora 

        Final</font></strong></td>

    </tr>

    <?php

	     $contador = 0;

         do {

	      if ($contador == 0) 

			{ $cor = "#FFFFFF"; }

	      else

		   { $cor = "#F4F4F4"; }

    ?>

    <tr class="listagem_naoavaliado"> 

      <td bgcolor="<? echo $cor  ?>" align="center"><?php echo $row_con_Dupli['CONSULTOR']; ?></td>

      <td bgcolor="<? echo $cor  ?>" align="center"><?php echo $row_con_Dupli['DATA']; ?></td>

      <td bgcolor="<? echo $cor  ?>" align="center"><?php echo $row_con_Dupli['HI']; ?></td>

      <td bgcolor="<? echo $cor  ?>" align="center"><?php echo $row_con_Dupli['HF']; ?></td>

    </tr>

    <?php

               if ($contador == 0)  {

			      $contador = 1;

			   }

			   else

			   {

			      $contador = 0;

			   }

               } while ($row_con_Dupli = mysql_fetch_assoc($con_Dupli));

							

    ?>

	</table>

	</center>

	<? include("inc/headerF.inc.php"); ?>