<h2>ADMIN</h2>
<?php 
$admin = mysql_fetch_row(mysql_query("SELECT ID from user where admin=1 and ID='".$_SESSION['ID_USER']."'"));
if($admin[0]>0){
echo'<a href="'.GENERUJ_LINK('menu', 'administrator', Array('zarzadzaj', 'user')).'">Użytkownicy</a><br>';
echo'<a href="'.GENERUJ_LINK('menu', 'administrator', Array('zarzadzaj', 'slowka')).'">Slowka</a><br>';
echo'<a href="'.GENERUJ_LINK('menu', 'administrator', Array('importuj', 'slowka')).'">Importuj Slowka</a><br>';

}
if($_GET['zarzadzaj'] == 'user'){
	
	if($_GET['modyfikuj'] > 0){
			if(isset($_POST['submit'])){
				$edytuj = '';
				if(!empty($_POST['haslo'])){
					$edytuj .= ", password='".md5($_POST['haslo'])."'";					
				}
				if(!empty($_POST['admin'])){
					$edytuj .= ", admin='".addslashes($_POST['admin'])."'";
				}
				if(!empty($_POST['klucz'])){
					$edytuj .= ", klucz='".md5($_POST['klucz'])."'";
				}
				$test = mysql_query("UPDATE user SET  email='".addslashes($_POST['email'])."' $edytuj WHERE ID='".addslashes($_GET['modyfikuj'])."'");
				if($test) echo DONE("Zaktualizowano poprawnie");
				else echo ERROR("Błąd nieznany");
			}
			$dane = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE ID='".addslashes($_GET['modyfikuj'])."'"));
		echo '<br><br><form method="POST"> Edytujesz uzytkownika o nicku: <b>'.$dane['login'].'</b><br>
			email: <input type="email" name="email" value="'.$dane['email'].'"/><br>
			haslo: <input type="password" name="haslo"  /><br>
			admin: <select name="admin"><option value="0" '.(($dane['admin'] == 0)?'selected="selected"':'').'>Nie</option><option value="1" '.(($dane['admin'] == 1)?'selected="selected"':'').'>Tak</option></select><br>
			klucz <input type="password" name="klucz" /><br>
			<input type="submit" name="submit" value="wyslij" />
			</form>';
	}elseif($_GET['usun'] > 0){
		$test = mysql_query("DELETE FROM user WHERE ID='".$_GET['usun']."'");
		if($test) echo DONE('Usunieto uzytkownika o ID '.$_GET['usun']); 
		else echo ERROR('Sprobuj pozniej');
	}else{
		$liczba_uzytkownikow = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM user"));
		if(!is_null($_GET['strona']) and $_GET['strona'] <= ceil($zapytanie2[0]/10)){
			$offset = ($_GET['strona']-1)*10;
		}else{
			$offset = 0;
		}
		$zapytanie = mysql_query('SELECT * FROM user LIMIT 10 OFFSET '.$offset);
		echo'<table>
				<tr>
					<td style="width:100px;font-weight:bold;">lp.</td>
					<td style="width:100px;font-weight:bold;">login</td>
					<td style="width:100px;font-weight:bold;">email</td>
					<td style="width:100px;font-weight:bold;">admin</td>
					<td style="width:100px;font-weight:bold;">akcja</td>
				</tr>';
			$i=1;
		while($user = mysql_fetch_array($zapytanie)){
			echo '<tr>
				<td>'.$i.'</td>
				<td>'.$user['login'].'</td>
				<td>'.$user['email'].'</td>
				<td>'.(($user['admin'] == 1)?'tak':'nie').'</td>
				<td><a href="'.GENERUJ_LINK('menu', 'administrator', Array('zarzadzaj', 'user', 'usun', $user['ID'])).'">Usun</a> \ <a href="'.GENERUJ_LINK('menu', 'administrator', Array('zarzadzaj', 'user', 'modyfikuj', $user['ID'])).'">Zmien</a></td>
			</tr>';
			$i++;
		}
	echo '</table>';
	echo PAGINACJA($liczba_uzytkownikow[0], 10, Array('zarzadzaj', 'user'));
	}
}
if($_GET['zarzadzaj'] == 'slowka'){
	if($_GET['modyfikuj'] > 0){
		if(isset($_POST['submit'])){
			$test = mysql_query("UPDATE slowka SET POLSKI='".addslashes($_POST['POLSKI'])."', ANGIELSKI='".addslashes($_POST['ANGIELSKI'])."', NIEMIECKI='".addslashes($_POST['NIEMIECKI'])."', OPIS='".addslashes($_POST['OPIS'])."', SPRAWDZONE='".addslashes($_POST['SPRAWDZONE'])."'  WHERE ID='".addslashes($_GET['modyfikuj'])."'");
			if($test) echo DONE('Zmieniono poprawnie');
			else echo ERROR('Błąd');
		}
		$dane = mysql_fetch_array(mysql_query("SELECT * FROM slowka WHERE ID='".addslashes($_GET['modyfikuj'])."'"));
			echo '<form method="POST">
					POLSKI: <input type="text" name="POLSKI" value="'.$dane['POLSKI'].'"/><br>
					ANGIELSKI: <input type="text" name="ANGIELSKI" value="'.$dane['ANGIELSKI'].'"/><br>
					NIEMIECKI: <input type="text" name="NIEMIECKI" value="'.$dane['NIEMIECKI'].'"/><br>
					OPIS<br> <textarea name="OPIS" cols="40" rows="20">'.$dane['OPIS'].'</textarea> <br>
					SPRAWDZONE <select name="SPRAWDZONE"><option value="0" '.(($dane['SPRAWDZONE'] == 0)?'selected="selected"':'').'>NIE</option><option value="1" '.(($dane['SPRAWDZONE'] == 1)?'selected="selected"':'').'>TAK</option></select><br>
					<input type="submit" name="submit" value="Zmien" />
				</form>'; 	 	 	 	
	}elseif($_GET['usun'] > 0){
		$test = mysql_query("DELETE FROM slowka WHERE ID='".$_GET['usun']."'");
		if($test) echo DONE('Usunieto slowkow o ID '.$_GET['usun']); 
		else echo ERROR('Sprobuj pozniej');
	}else{
		$zapytanie2 = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM slowka"));
		if(!is_null($_GET['strona']) and $_GET['strona'] <= ceil($zapytanie2[0]/10)){
			$offset = ($_GET['strona']-1)*10;
		}else{
			$offset = 0;
		}
		$zapytanie = mysql_query('SELECT * FROM slowka LIMIT 10 OFFSET '.$offset);
		echo '<table><tr><td style="width:100px"><b>POLSKI</b></td><td style="width:100px"><b>ANGIELSKI</b></td><td style="width:100px"><b>NIEMIECKI</b></td><td style="width:100px"><b>DEFINICJA</b></td><td style="width:100px"><b>Sprawdzone?</b></td><td style="width:100px"><b>Akcja</b></td></tr>';
		while($tresc = mysql_fetch_array($zapytanie)){
			echo '<tr>
					<td style="width:100px">'.$tresc['POLSKI'].'</td>
					<td style="width:100px">'.$tresc['ANGIELSKI'].'</td>
					<td style="width:100px">'.$tresc['NIEMIECKI'].'</td>
					<td style="width:100px"><div id="'.$tresc['ID'].'" style="display:none;">'.$tresc['OPIS'].'</div><a href="#" onclick="okno(\'\', \'DEFINICJA\', \'\', \'\', '.$tresc['ID'].'); return false;">Pokaz</a></td>
					<td style="width:100px">'.(($tresc['SPRAWDZONE'] == 1)?'tak':'nie').'</td>
					<td style="width:100px"><a href="'.GENERUJ_LINK('menu', 'administrator', Array('zarzadzaj', 'slowka', 'usun', $tresc['ID'])).'">Usun</a>&nbsp; &nbsp;&nbsp;<a href="'.GENERUJ_LINK('menu', 'administrator',  Array('zarzadzaj', 'slowka', 'modyfikuj', $tresc['ID'])).'">Zmien</a></td>
				</tr>';
		}
		echo '</table>';
		echo PAGINACJA($zapytanie2[0], 10,  Array('zarzadzaj', 'slowka'));
	}
}
if($_GET['importuj'] == 'slowka'){
	echo "Importujemy dane, które sa w postaci POLSKI;ANGIELSKI;NIEMIECK;OPIS <br><br>";
	if($_GET['upload'] == 'tak'){
		$uploaddir = 'upload/'; // katalog gdzie ma zostać zapisany plik
		if(move_uploaded_file($_FILES['plik']['tmp_name'], "$uploaddir"."plik.txt")){
			echo DONE("Plik zosał załadowany.");
		}
		else{
			echo ERROR("Plik nie został załadowany.");
		}
	}
	if($_GET['zaladuj'] == 'serwer'){
		$plik = fopen('upload/plik.txt', "r");
		 $dane =  stream_get_contents($plik);
		 $dane = explode(';',$dane);
		 
		 for($i=0;$i<count($dane);$i+=4){
			$test =  mysql_query("INSERT INTO slowka (POLSKI, ANGIELSKI, NIEMIECKi, OPIS) VALUES ('".$dane[$i]."', '".$dane[$i+1]."', '".$dane[$i+2]."', '".$dane[$i+3]."')");
		 }
		// echo mysql_error();
		fclose($plik);
		 if($test){
			unlink('upload/plik.txt');
			echo DONE('DANE ZOSTAŁY DODANE');
		 }else
			 echo ERROR("Błąd");
	}
	if($_GET['usun'] == 'plik'){
		unlink('upload/plik.txt');
	}
	if(file_exists('upload/plik.txt')){
		echo '<a href="'.GENERUJ_LINK('menu', 'administrator', Array('importuj', 'slowka', 'zaladuj','serwer')).'" > Wrzuc dane do bazy</a><br>';
		echo '<a href="'.GENERUJ_LINK('menu', 'administrator', Array('importuj', 'slowka', 'usun','plik')).'" > usun plik</a>';
		
	}else{
	echo '<FORM ENCTYPE="multipart/form-data" ACTION="'.GENERUJ_LINK('menu', 'administrator', Array('importuj', 'slowka', 'upload','tak')).'" METHOD  = "POST">
			<INPUT TYPE="file"  NAME="plik"   SIZE="30"   VALUE=""> <INPUT TYPE="submit" NAME="wyslij" VALUE="Wyślij plik"></table>';
	}
}
?>