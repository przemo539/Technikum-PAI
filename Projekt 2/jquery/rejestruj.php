<?php

header('Content-type: application/json');


require_once('../config/connect.php');
 $login = addslashes($_GET['login']);
 $email = addslashes($_GET['email']);

$zapytanie_login = "SELECT id FROM user WHERE login='$login'";
$zapytanie_email = "SELECT id FROM user WHERE email='$email'";

$login = mysql_fetch_row(mysql_query($zapytanie_login));
$email = mysql_fetch_row(mysql_query($zapytanie_email));

$powrot = Array($login, $email);
echo json_encode($powrot);
 
?>