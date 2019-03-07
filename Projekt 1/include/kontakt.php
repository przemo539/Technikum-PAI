<center><h3>Kontakt</h3>
	<h6>Można wysłać tylko 1 wiadomość na godzine !!</h6>
	<form method="POST" action="#" onsubmit="return sprawdz()">
		<table>
			<tr>
				<td>Imię/Login:</td>
				<td><input type="text" name="imie" id="imie" <?php if($zalogowany == 1) echo 'disabled value="'.$_COOKIE['login'].'"' ?>/></td>
			</tr>
			<tr>
				<td>Temat:</td>
				<td><input type="text" name="temat" id="temat" /></td>
			</tr>			
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" id="email" /></td>
			</tr>
			<tr>
				<td>Powtórz Email:</td>
				<td><input type="email" name="email2" id="email2" /></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="tresc" id="tresc" rows="20" cols="50"></textarea>
				</td>
			</tr>
			<tr>
				<td><input type="reset" value="Resetuj " /></td>
				<td><input type="submit" name="submit" value="Wyślij" /></td>
			</tr>
		</table>
	</form>
</center>
<script type="text/javascript">
	function sprawdz(){
		var imie = document.getElementById("imie").value;
		var temat = document.getElementById("temat").value;
		var email = document.getElementById("email").value;
		var email2 = document.getElementById("email2").value;
		var tresc = document.getElementById("tresc").value;

		if(imie == ""){
			alert("Pole Imie nie może być puste!");
			return false;
		}
		if(temat == ""){
			alert("Pole Temat nie może być puste!");
			return false;
		}
		if(email == ""){
			alert("Pole Email nie może być puste!");
			return false;
		}
		if(email2 == ""){
			alert("Pole Powtórz Email nie może być puste!");
			return false;
		}
		if(email != email2){
			alert("Emaile się nie zgadzają !!");
			return false;
		}
		if(tresc == ""){
			alert("Pole Treść nie może być puste!");
			return false;
		}
		
		return true;
	}
</script>
<?php 
if(isset($_POST['submit'])){
	if($_COOKIE['kontakt'] != 1){
		$imie = addslashes($_POST['imie']);
		$temat = addslashes($_POST['temat']);
		$email = addslashes($_POST['email']);
		$tresc = addslashes($_POST['tresc']);
		if(!file_exists("notification/liczba_zgloszen.txt")){
			touch("notification/liczba_zgloszen.txt");
			$file = fopen("notification/liczba_zgloszen.txt","w");
			fwrite($file,0);
			fclose($file);
		}
		$liczba_zgloszen = (int)file_get_contents("notification/liczba_zgloszen.txt");
		touch("notification/$liczba_zgloszen.txt");
		
		$file = fopen("notification/$liczba_zgloszen.txt","w");
		fwrite($file, $imie.'||'.$temat.'||'.$email.'||'.$tresc);
		fclose($file);
			
		$file = fopen("notification/liczba_zgloszen.txt","w");
		$test = fwrite($file, ($liczba_zgloszen+1) );
		fclose($file);
		
		if($test){
			echo '<script type="text/javascript">alert("Wiadomość została dostarczona do administratora, dziękujemy za kontakt")</script>';
			setcookie("kontakt", 1, time()+3600);
		}else{
			echo '<script type="text/javascript">alert("Niestety coś poszło nie tak spróbuj ponownie za chwile")</script>';
		}
	}else{
		echo '<script type="text/javascript">alert("Następną wiadomość do administracji możesz wysłać po 1 h")</script>';
	}
}
?>