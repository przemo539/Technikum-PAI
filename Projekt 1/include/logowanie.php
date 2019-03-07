<?php 
if(isset($_POST['zaloguj'])){
	$login = addslashes($_POST['login_logow']);
	$haslo = md5(addslashes($_POST['haslo_logow'])."2015");
	
	$baza = file_get_contents("user/dane.txt");
	$baza = explode("||", $baza);
	for($i=0;$i < (count($baza)-1);$i++){
		$dane[$i] = explode("|", $baza[$i]);
		if($dane[$i][0] == $login and $dane[$i][1] == $haslo){
			$zalogowany = 1;
			$admin = $dane[$i][3];
			break;
		}
			
	}
	if($zalogowany != 1) echo '<script type="text/javascript">alert(Niestety nie udało się zalogować spróbuj ponownie)</script>';
	setcookie("login", $login, time()+43200); 
	setcookie("admin", $admin, time()+43200); 
}
if($zalogowany != 1){
	?>
<form method="POST" action="#">
	Login:<input type="text" name="login_logow" /><br>
	Hasło:<input type="password" name="haslo_logow" /><br>
	<input type="submit" name="zaloguj" value="Zaloguj" />
</form>
<a href="index.php?rejestruj=tak">Rejestruj</a>
<?php 
}else{
?>
<ul>
      <li><a href="index.php?menu=1">Dodaj Zadanie</a></li>
      <li><a href="index.php?menu=2">Czat</a></li>
      <li><a href="index.php?menu=3">Ustawienia</a></li>
      <li><a href="index.php?menu=4">Wyloguj się</a></li>
	  <?php 
	  if($_COOKIE['admin'] == 1){
			echo '<li>&nbsp;</li>
				<li><a href="#" onclick="document.getElementById(\'administracja\').style.display == \'block\'?document.getElementById(\'administracja\').style.display = \'none\':document.getElementById(\'administracja\').style.display = \'block\';">Administracja</a></li>';
		
			echo '<div id="administracja" style="display:none">
			<li><a href="admin.php?menu=1"> >> Dodane zgłoszenia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li><a href="admin.php?menu=2"> >> Zarządzaj użytkownikami</a></li>
			<li><a href="admin.php?menu=3"> >> Dodane Zadania&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			
			</div>';
	  }
	  ?>
    </ul>
<?php
}
?>