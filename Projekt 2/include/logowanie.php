<?php 
if($zalogowany != 1){
	if(isset($_POST['submit_logowanie'])){
		$login = addslashes($_POST['login']);
		$haslo = md5(addslashes($_POST['haslo']));
		$zapytanie = mysql_fetch_row(mysql_query("SELECT id FROM user WHERE login='$login' and password='$haslo'"));
		if($zapytanie[0] > 0){
			$sessionID = session_id();
			$time = time();
			$zapytanie2 = "DELETE  FROM sesja WHERE ID_USER='$zapytanie[0]'";
			mysql_query($zapytanie2);
			$zapytanie3 = 'INSERT INTO sesja (ID_USER, sessionID, time) VALUES ("'.$zapytanie[0].'", "'.$sessionID.'", "'.$time.'")';
			if(mysql_query($zapytanie3)){
				$_SESSION["ID_USER"] = $zapytanie[0];
				$_SESSION["sessionID"] = $sessionID;
				$_SESSION["time"] = $time+50;
                Header("Refresh: 5 ".$_SESSION['adres']."index.php");
				echo DONE("Zalogowano poprawnie. Zostaniesz przeniesiony na strone glowna za <b><div id=\"odliczanie\">5</div></b>");
				echo '<script type="text/javascript">
						function odliczaj(sek){
							document.getElementById(\'odliczanie\').innerHTML=sek+\' s\';
							if(sek>0)setTimeout(function(){odliczaj(--sek)},1e3);
						}
						odliczaj(5);
				</script>';
			}else echo ERROR('Cos poszlo nie tak spróbuj ponownie za chwile');
		}else{
			echo ERROR("Podano nie poprawne dane ");
		}
	}
?>
	<div id="logowanie">
	<form method="POST" >
	&nbsp;&nbsp;<b>Login:</b> &nbsp;<input type="text" name="login" id="Pole_login"/><br />
	&nbsp;&nbsp;<b>Haslo:</b> &nbsp;<input type="password" name="haslo" id="Pole_haslo"/><br />
	&nbsp;&nbsp;<input type="reset" value="Reset" /> <input type="submit" name="submit_logowanie" value="Zaloguj" />
	</form>
		<div id="panel">
			<a href="<?php echo GENERUJ_LINK('menu', 'rejestruj')?>">Rejestruj</a>&nbsp;&nbsp;<a href="<?php echo GENERUJ_LINK('menu', 'przywroc_haslo')?>">Przywróc haslo</a>
		</div>
	</div>
<?php 
}
?>