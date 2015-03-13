<?php
// Server in the this format: <computer>\<instance name> or 
// <server>,<port> when using a non default port number
$server = 'XXXDNN0786\DBANDADEVOLUCAO';

$link = mssql_connect($server, 'sa', 'andarella2005');

if(!$link)
{
    die('Something went wrong while connecting to MSSQL');
}
?> 


<?php
$myServer = "XXXDNN0786.locaweb.com.br";
$myUser = "sa";
$myPass = "andarella2005";
$myDB = "dbAndaDevolucao"; 

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer"); 

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB"); 

//declare the SQL statement that will query the database
$query = "select f.FORNECEDOR nome_fantasia, f.COD_FORNECEDOR codloja, f.cgc_cpf cnpj, cf.RAZAO_SOCIAL, cf.CGC_CPF, cf.ENDERECO, 
       cf.BAIRRO, cf.CIDADE, cf.EMAIL, cf.RG_IE, cf.UF
from fornecedores f, CADASTRO_CLI_FOR cf
where f.CLIFOR = cf.CLIFOR";


//execute the SQL query and return records
$result = mssql_query($query);

$numRows = mssql_num_rows($result); 
echo "<h1>" . $numRows . " Row" . ($numRows == 1 ? "" : "s") . " Returned </h1>"; 

//display the results 
while($row = mssql_fetch_array($result))
{
  echo "<li>" . $row["id"] . $row["name"] . $row["year"] . "</li>";
}
//close the connection
mssql_close($dbhandle);
?> 