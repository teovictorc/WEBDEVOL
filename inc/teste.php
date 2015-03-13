<?
	include("conn_externa.inc.php");
	mysql_query("BEGIN",$Conn);
	mysql_query("INSERT INTO dsadsf VALUES ('AAAA','BBBB')",$Conn);
	//mysql_query("ROLLBACK",$Conn);

	echo "Acab33333";
?>