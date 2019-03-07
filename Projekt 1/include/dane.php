<?php 
	$dzial = $_GET['dzial'];

	if(!is_numeric($dzial) and $dzial!=null)
		echo '<div style="text-align: center;"><h2>Błąd 404</h2>UPSSS....<br> Coś poszło nie tak ....<br> Podana podstrona nie zostala znaleziona<br><img src="http://www.randstad.pl/img/404.png" alt="Błąd 404" /></div>';
	else{
			switch($dzial){
				CASE 1:
						include_once('funkcja_kwadratowa.php');
						break;
				CASE 2:
						include_once('wielomiany.php');
						break;
				CASE 3:
						include_once('trygonometria.php');
						break;
				CASE 4:
						include_once('test.php');
						break;
				CASE 5:
						include_once('kontakt.php');
						break;
				Default:
						include_once('home.php');
			}
	}
	
	$menu = $_GET['menu'];

	if(!is_numeric($menu) and $menu!=null and $zalogowany == 1)
		echo '<div style="text-align: center;"><h2>Błąd 404</h2>UPSSS....<br> Coś poszło nie tak ....<br> Podana podstrona nie zostala znaleziona<br><img src="http://www.randstad.pl/img/404.png" alt="Błąd 404" /></div>';
	elseif($zalogowany == 1){
			switch($menu){
				CASE 1:
						echo '<center><h3>Dodaj Zadanie</h3>';
						if(isset($_POST['wyslij_zadanie'])){
							$dzial = $_POST['dzial'];
							if(file_exists("zadania/$dzial/liczba.txt")){
								echo "zadania/$dzial/liczba.txt";
							}else{
								echo"a";
							}
							
						}
						echo '<form method="POST" action="#">
									Wybierz dział: <select name="dzial">
										<option value="0" >Funkcja kwadratowa</option>
										<option value="1" >Wielomiany</option>
										<option value="2" >Trygonometria</option>
									</select><br>
									Podaj odpowiedz: <input type="text" name="odpowiedz" /><br>
									Podaj Treść:<br><textarea name="tresc_zadania" cols="50" rows="10"></textarea><br>
									<input type="reset" value="Resetuj" /><input type="submit" name="wyslij_zadanie" value="Wyślij" />
								</form>
							</center>
						';
						break;
				CASE 2:
						echo '<center><h3>Czat</h3></center><div class="wysrodkuj">';
						if(isset($_POST['wyslij_czat'])){
							$file = fopen("chat/chat.txt","a");
							fwrite($file, $_COOKIE['login'].'|'.$_POST['tresc'].'|'.date("d.m.Y").'|');
							fclose($file);
						}
						$dane=file_get_contents("chat/chat.txt");
						$dane = explode("|", $dane);
						if(count($dane) == 1) echo "Brak wpisów";
						else{
							echo '<table>';
							for($i = 0; $i < (count($dane)-1);$i+=3){
								echo '<tr><td>'.$dane[$i].' napisał: </td><td style="width:500px;"><b>'.$dane[$i+1].'</b></td><td>'.$dane[$i+2].'</td></tr>';
							}
							
							echo '</table>';
						}
						echo '<form method="POST" action="#">
									<textarea name="tresc" rows="5" cols="70"></textarea><br>
									<input type="reset"  value="Resetuj" />
									<input type="submit" name="wyslij_czat" value="Napisz" />
									</form></div>';
						break;
				CASE 3:
						echo '<center><h3>Ustawienia</h3></center>';
						$baza = file_get_contents("user/dane.txt");
						$identyfikator;
						$baza = explode("||", $baza);
						for($i=0;$i < (count($baza)-1);$i++){
							$dane[$i] = explode("|", $baza[$i]);
							if($dane[$i][0] == $_COOKIE['login']){
								$identyfikator = $i;
								;
							}								
						}
						echo '<table>
									<tr>
										<td>Login:</td>
										<td><b>'.$dane[$identyfikator][0].'</b></td>
									</tr>
									<tr>
										<td>Hasło:</td>
										<td><b>*******</b></td>
									</tr>
									<tr>
										<td>Email:</td>
										<td><b>'.$dane[$identyfikator][2].'</b></td>
									</tr>
									<tr>
										<td>Administrator:</td>
										<td><b>'.(($dane[$identyfikator][3] == 1)?'tak':'nie').'</b></td>
									</tr>
									</table>';
						break;
				CASE 4:
						echo '<center><h3>Wyloguj się</h3></center>';
						setcookie("login", "", time() - 3600);
						setcookie("admin", "", time() - 3600);
						echo "<div style=\"text-align:center;\">Zostałeś poprawnie wylogowany. Odśwież strone :) </div>";
						break;
				Default:
						include_once('home.php');
			}
	}
	
	if($_GET['rejestruj']=='tak' and $zalogowany != 1){
		 
		if(isset($_POST['zarejestruj'])){
			$login = addslashes($_POST['login']);
			$haslo = md5(addslashes($_POST['haslo'])."2015");
			$email = addslashes($_POST['email']);
			echo '1';
			$test =("INSERT INTO user (login, password, email) VALUES ($login, $haslo, $email)");
			if(mysql_query($test)) echo '<script type="text/javascript">alert("Zostałeś poprawnie zarejestrowany")</script>';
			else '<script type="text/javascript">alert("Nie udało się zarejestrować")</script>';
			echo mysql_error();
		}
		
		echo '<center><h3>Rejestruj</h3>
		<form method="POST" action="#" onsubmit="return sprawdz()">
			<table>
				<tr>
					<td>Login:</td>
					<td><input type="text" name="login" id="login"/></td>
				</tr>
				<tr>
					<td>Hasło:</td>
					<td><input type="password" name="haslo" id="haslo" /></td>
				</tr>				
				<tr>
					<td>Powtórz Hasło:</td>
					<td><input type="password" name="haslo2" id="haslo2" /></td>
				</tr>				
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email" id="email" /></td>
				</tr>				
				<tr>
					<td>Powtórz email:</td>
					<td><input type="email" name="email2" id="email2" /></td>
				</tr>
				<tr>
					<td><input type="reset" value="resetuj" /></td>
					<td><input type="submit" name="zarejestruj" value="rejestruj" /></td>
				</tr>
			</table>
		</form>
		</center>';
		echo '<script type="text/javascript">
					function sprawdz(){
						var login = document.getElementById("login").value;
						var haslo = document.getElementById("haslo").value;
						var haslo2 = document.getElementById("haslo2").value;
						var email = document.getElementById("email").value;
						var email2 = document.getElementById("email2").value;

						if(login == ""){
							alert("Pole Login nie może być puste!");
							return false;
						}						
						if(login.lenght >= 4){
							alert("Login musi mieć minimum 4 znaki");
							return false;
						}
						if(haslo == ""){
							alert("Pole Hasło nie może być puste!");
							return false;
						}						
						if(haslo.lenght > 4){
							alert("Hasło musi mieć minimum 4 znaki");
							return false;
						}						
						if(haslo2 == ""){
							alert("Pole Powtórz Hasło nie może być puste!");
							return false;
						}
						if(email == ""){
							alert("Pole Email nie może być puste!");
							return false;
						}
						if(email.lenght > 4){
							alert("Email musi mieć minimum 4 znaki");
							return false;
						}
						if(haslo != haslo2){
							alert("Hasła się nie zgadzają !!");
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
				</script>';
	}
?>