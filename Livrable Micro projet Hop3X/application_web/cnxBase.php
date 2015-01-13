<?php
/*
$serveur = "127.0.0.1";
$nom_base = "gestionrdv";
$login = "root";
$motdepasse = "";
if (mysql_connect ($serveur,$login,$motdepasse)) {
mysql_select_db("gestionrdv");
  //echo 'connexion r�ussie';
}
else {
  echo 'connexion impossible...'.mysql_error();
}
 */
 
 $mysqli = new mysqli("127.0.0.1", "root", "", "projet_talend");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
 

 function getEtuName($mysqli, $id )
 {
  $res=$mysqli->query("select nom_etu from tp1 where id_etu=$id") ;
	$row=$res->fetch_array(MYSQLI_ASSOC);
	return $row['nom_etu'];
									
 }

 ?>