<?php 
	//$_GET['module'];
	//$_GET['action'];
	$odliczaj =  '<script type="text/javascript">
						function odliczaj(sek){
							document.getElementById(\'odliczanie\').innerHTML=sek+\' s\';
							if(sek>0)setTimeout(function(){odliczaj(--sek)},1e3);
						}
						odliczaj(5);
				</script>';
				
	switch($_GET['action']){
		case 'ogladaj':
			include('site/przegladaj_slowka.php');
			break;		
		case 'test':
		if($zalogowany == 1){
				include('site/test.php');
			}else{
				echo ERROR('Operacja nie możliwa bez logowania <br> Przeniesienie na strone glowna za <b><div id="odliczanie">5</div></b>');
				echo $odliczaj;
				Header("Refresh: 5 ".$_SESSION['adres']."index.php");
			}
			break;		
		case 'wyniki':
		if($zalogowany == 1){
				include('site/wyniki.php');
			}else{
				echo ERROR('Operacja nie możliwa bez logowania <br> Przeniesienie na strone glowna za <b><div id="odliczanie">5</div></b>');
				echo $odliczaj;
				Header("Refresh: 5 ".$_SESSION['adres']."index.php");
			}
			break;		
		case 'wyloguj':
			if($zalogowany == 1){
				$_SESSION["ID_USER"] = 0;
				$_SESSION["sessionID"] = 0; 
				$_SESSION["time"] = 0;
				echo "<h2> Wyloguj</h2><br>Zostałeś poprawnie wylogowany. przekierowanie za 5s.";
				echo DONE('ZOSTAŁEŚ POPRAWNIE WYLOGOWANY :) <br> Przeniesienie na strone glowna za <b><div id="odliczanie">5</div></b>');
				echo $odliczaj;
				Header("Refresh: 5 ".$_SESSION['adres']."index.php");
			}else{
				echo ERROR('Nie możesz zostać wylogowany skoro nie jesteś zalogowany <br> Przeniesienie na strone glowna za <b><div id="odliczanie">5</div></b>');
				echo $odliczaj;
				Header("Refresh: 5 ".$_SESSION['adres']."index.php");
			}
			break;
		case 'rejestruj':
			if($zalogowany != 1){
				include('site/rejestruj.php');
			}else{
				ERROR('Jesteś już zarejestrowany');
			}
			break;
		case 'przywroc_haslo':
			if($zalogowany != 1){
				include('site/przywroc_haslo.php');
			}else
				ERROR('Zmień w ustawieniach!!');
			break;
		case 'administrator':
			if($zalogowany == 1){
				include('site/admin.php');
			}else
				ERROR('Zmień w ustawieniach!!');
			break;
			
		case 'ustawienia':
			if($zalogowany == 1){
				include('site/ustawienia.php');
			}
			break;
		default: 
			include('site/home.html');
	}
	
?>