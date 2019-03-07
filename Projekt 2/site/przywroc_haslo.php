<h2>Przywróć Hasło</h2>

<?php 
	if(isset($_POST['submit_resset'])){
		$email = addslashes($_POST['email']);
		$klucz = md5($_POST['klucz']);
		$haslo = md5($_POST['haslo']);
		if(!is_null($email)){
			$test = mysql_query("UPDATE user SET password='$haslo' WHERE email='$email' and klucz='$klucz'");
			if($test)
				echo DONE('Hasło zostało zmienione poprawnie');
			else
				echo ERROR('Błąd, spróbuj ponownie za chwile');
		}
	}
?>
<form method="POST" >
	Klucz:<input type="password" name="klucz" /><br>
	Email:<input type="email" name="email" /><br>
	Nowe hasło:<input type="password" name="haslo" /><br>
	<input type="submit" name="submit_resset" value="Zmien Haslo" />
</form>