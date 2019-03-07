<h2>Ustawienia</h2>
<?php 
$dane = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id='".$_SESSION['ID_USER']."'"));

if(isset($_POST['submit_ustawienia'])){
	if(!empty($_POST['haslo']) and !empty($_POST['email']) ){
		$haslo = md5($_POST['haslo']);
		$email = addslashes($_POST['email']);
		$test = mysql_query("UPDATE user SET password='".$haslo."', email='".$email."' WHERE id='".$_SESSION['ID_USER']."'");
		if($test)
			echo DONE('Dane zmienione poprawnie, odświerz strone');
		else
			echo ERROR('Nie oczekiwany bład');
	}
}
?>
<form method="POST" onsubmit="return sprawdz();">
	Email: <input type="email" name="email" value="<?php echo $dane['email'];?>" /><br>
	Hasło: <input type="password" name="haslo" /><br>
	<input type="reset" value="Wyczyść" />&nbsp;<input type="submit" name="submit_ustawienia" value="Wyślij" />
</form>
