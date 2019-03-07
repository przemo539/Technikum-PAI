<h2>Przeglądaj słówka</h2>

<?php 
$zapytanie2 = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM slowka WHERE SPRAWDZONE=1"));

if(!is_null($_GET['strona']) and $_GET['strona'] <= ceil($zapytanie2[0]/20)){
	$offset = ($_GET['strona']-1)*20;
}else{
	$offset = 0;
}
$zapytanie = mysql_query('SELECT POLSKI, ANGIELSKI, NIEMIECKI, ID FROM slowka WHERE SPRAWDZONE=1 LIMIT 20 OFFSET '.$offset);
echo '<table><tr><td style="width:150px"><b>POLSKI</b></td><td style="width:150px"><b>ANGIELSKI</b></td><td style="width:150px"><b>NIEMIECKI</b></td><td><b>DEFINICJA</b></td></tr>';
while($tresc = mysql_fetch_row($zapytanie)){
	echo '<tr>
			<td>'.$tresc[0].'</td>
			<td>'.$tresc[1].'</td>
			<td>'.$tresc[2].'</td>
			<td><a href="'.$_SESSION['adres'].$_GET['module'].'/'.$_GET['action'].'" onclick="wyswietl('.$tresc[3].'); return false">Definicja</a></td>
		</tr>';
}
echo '</table>';


echo PAGINACJA($zapytanie2[0], 20);
?>
