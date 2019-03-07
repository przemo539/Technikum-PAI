<?php 
$polaczenie = @mysql_connect('localhost','root','') or die('Błąd połaczenia z serwerem');
mysql_select_db('PAI2',$polaczenie) or die('Błąd wybrania bazy');
?>