<h2>Test</h2>
<?php
if(is_null($_GET['jezyk']))
{
	?>

Witamy na stronie testu sprawdzającego.<br>
Zostanie wylosowane 10 słówek.<br>
W tym teście wybierasz język przewodni, wpisujesz słówko w tłumaczeniu dla reszty języków.<br>

<form method="POST" onsubmit="return sprawdz()">
	Wybieram: <select name="jezyk" id="jezyk">
		<option value="POLSKI">POLSKI</option>
		<option value="ANGIELSKI">ANGIELSKI</option>
		<option value="NIEMIECKI">NIEMIECKI</option>
	</select>&nbsp;
	<input type="submit" value="Zatwierdz" />
</form>	
<script type="text/javascript">
	function sprawdz(){
		location.href = "<?php echo "$_SESSION[adres]$_GET[module]/$_GET[action]/jezyk/";?>"+$('#jezyk').val();
		return false;
	}
</script>
<?php 
}else{
		if($_GET['step']> 1 and !is_null($_POST['id_slowek']) or $_GET['step']<= 1 and is_null($_POST['id_slowek'])){
			if(is_numeric($_GET['step']) and $_GET['step'] > 1){
				$step = $_GET['step'];
				$wylosowane = explode(",",$_POST['id_slowek']);
			}else{
				$step = 1;
				$liczba_slowek = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM slowka WHERE sprawdzone='1'"));
				$ile_wylosowac = 10; //ile pytań wylosować?
				$ile_juz_wylosowano=0; //zmienna pomocnicza
				 
				for ($i=1; $i<=$ile_wylosowac; $i++)
				{
				  do
				   {
					  $liczba=rand(0,($liczba_slowek[0]-1)); //losowanie w PHP
					  $losowanie_ok=true;
				 
					  for ($j=1; $j<=$ile_juz_wylosowano; $j++)
					  {
						 //czy liczba nie została już wcześniej wylosowana?
						 if ($liczba==$wylosowane[$j]) $losowanie_ok=false;
					  }
				 
					  if ($losowanie_ok==true)
					  {
						 //mamy unikatową liczbę, zapiszmy ją do tablicy
						 $wylosowane[$ile_juz_wylosowano]=$liczba;
						 $ile_juz_wylosowano++;
					  }
				   } while($losowanie_ok!=true);
				}			
			}
				$id_slowek = implode(",",$wylosowane);
				
				if($_GET['jezyk'] == 'POLSKI'){
					$wybrany_jezyk=0;
					$jezyk1='ANGIELSKI';
					$jezyk2='NIEMIECKI';
				}elseif($_GET['jezyk'] == 'ANGIELSKI'){
					$wybrany_jezyk=1;
					$jezyk1='POLSKI';
					$jezyk2='NIEMIECKI';
				}elseif($_GET['jezyk'] == 'NIEMIECKI'){
					$wybrany_jezyk=2;
					$jezyk1='POLSKI';
					$jezyk2='ANGIELSKI';
				}
				if($step != 11){
					$slowko = mysql_fetch_row(mysql_query("SELECT POLSKI, ANGIELSKI, NIEMIECKI FROM slowka WHERE id='".$wylosowane[($step-1)]."'"));
					
					echo '<h3>Słówko '.$step.'/10</h3><b>Przetłumacz słówko <i>'.$slowko[$wybrany_jezyk].'</i></b>
					<form method="POST" action= "'."$_SESSION[adres]$_GET[module]/$_GET[action]/jezyk/$_GET[jezyk]/step/".($step+1).'">
						'.$jezyk1.' - <input type="text" name="jezyk1" /><br>
						'.$jezyk2.' - <input type="text" name="jezyk2" /><br>
						<input type="hidden" name="id_slowek" value="'.$id_slowek.'" />';
						for($i = 1; $i<($step-1); $i++){
							echo '<input type="hidden" name="odpowiedz_'.$i.'" value="'.$_POST['odpowiedz_'.$i].'" />';
						}
						if($step > 0)echo "<input type=\"hidden\" name=\"odpowiedz_".($step-1)."\" value=\"$_POST[jezyk1]|$_POST[jezyk2]\" />";
						
						echo '<input type="submit" value="Nastepny krok" />
					</form>';
				}else{
					echo 'Test został zakończony';
					$punktow = 0;
					$sprawdz_wynik = '<br>';
					for($i = 0; $i<10; $i++){
						if($i != 9)	$odpowiedz = explode('|', $_POST['odpowiedz_'.($i+1)]); else $odpowiedz = Array($_POST['jezyk1'],$_POST['jezyk2']);
						$slowko = mysql_fetch_array(mysql_query("SELECT POLSKI, ANGIELSKI, NIEMIECKI FROM slowka WHERE id='".$wylosowane[$i]."'"));
						$sprawdz_wynik .= "Pytanie nr. ".($i+1)." <br>Przetłumacz słówko <b> $slowko[$wybrany_jezyk] </b> z jezyka $_GET[jezyk]EGO na $jezyk1 oraz $jezyk2<br>";
						if($wybrany_jezyk == 0){
							if(SPRAWDZ($slowko['ANGIELSKI'],$odpowiedz[0])){ //$slowko['ANGIELSKI']
								$punktow++;
								$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz[0], proprawna to $slowko[ANGIELSKI]</div>";
								$odpowiedz1 = '1';
							}else{
								$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz[0], proprawna to $slowko[ANGIELSKI]</div>";
								$odpowiedz1 = '0';
							}
							if(SPRAWDZ($slowko['NIEMIECKI'],$odpowiedz[1])){//$slowko['NIEMIECKI']
								$punktow++;
								$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz[1], proprawna to $slowko[NIEMIECKI]</div>";
								$odpowiedz2 = '1';
							}else{
								$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz[1], proprawna to $slowko[NIEMIECKI]</div>";
								$odpowiedz2 = '0';
							}
							
						}elseif($wybrany_jezyk == 1){
							if(SPRAWDZ($slowko['POLSKI'],$odpowiedz[0])){//$slowko['POLSKI']
								$punktow++;
								$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz[0], proprawna to $slowko[POLSKI]</div>";
								$odpowiedz1= '1';
							}else{
								$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz[0], proprawna to $slowko[POLSKI]</div>";
								$odpowiedz1 = '0';
							}
							if(SPRAWDZ($slowko['NIEMIECKI'],$odpowiedz[1])){//$slowko['NIEMIECKI']
								$punktow++;
								$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz[1], proprawna to $slowko[NIEMIECKI]</div>";
								$odpowiedz2 = '1';
							}else{
								$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz[1], proprawna to $slowko[NIEMIECKI]</div>";
								$odpowiedz2 = '0';
							}
						}elseif($wybrany_jezyk == 2){
							if(SPRAWDZ($slowko['POLSKI'],$odpowiedz[0])){//$slowko['POLSKI']
								$punktow++;
								$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz[0], proprawna to $slowko[POLSKI]</div>";
								$odpowiedz1 = '1';
							}else{
								$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz[0], proprawna to $slowko[POLSKI]</div>";
								$odpowiedz1 = '0';
							}
							if(SPRAWDZ($slowko['ANGIELSKI'],$odpowiedz[1])){//$slowko['ANGIELSKI']
								$punktow++;
								$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz[1], proprawna to $slowko[ANGIELSKI]</div>";
								$odpowiedz2 = '1';
							}else{
								$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz[1], proprawna to $slowko[ANGIELSKI]</div>";
								$odpowiedz2 = '0';
							}
							
						}
						$odpowiedzi[$i] = "$odpowiedz1|$odpowiedz2";
						$sprawdz_wynik .= "<hr>";
					}
					mysql_query("INSERT INTO  test_slowka (ID_USER, ID_SLOWKA1, ID_SLOWKA2, ID_SLOWKA3, ID_SLOWKA4, ID_SLOWKA5, ID_SLOWKA6, ID_SLOWKA7, ID_SLOWKA8, ID_SLOWKA9, ID_SLOWKA10) VALUES ($_SESSION[ID_USER], $wylosowane[0], $wylosowane[1], $wylosowane[2], $wylosowane[3], $wylosowane[4], $wylosowane[5], $wylosowane[6], $wylosowane[7], $wylosowane[8], $wylosowane[9])");
					$id_test =  mysql_insert_id();
					mysql_query("INSERT INTO  test_odpowiedz (ID_TESTU, CZAS, WYBRANY_JEZYK, ODPOWIEDZ1, ODPOWIEDZ2, ODPOWIEDZ3, ODPOWIEDZ4, ODPOWIEDZ5, ODPOWIEDZ6, ODPOWIEDZ7, ODPOWIEDZ8, ODPOWIEDZ9, ODPOWIEDZ10, WYNIK) VALUES ($id_test, now(), $wybrany_jezyk, '".mysql_real_escape_string($_POST['odpowiedz_1'])."', '".mysql_real_escape_string($_POST['odpowiedz_2'])."', '".mysql_real_escape_string($_POST['odpowiedz_3'])."', '".mysql_real_escape_string($_POST['odpowiedz_4'])."', '".mysql_real_escape_string($_POST['odpowiedz_5'])."', '".mysql_real_escape_string($_POST['odpowiedz_6'])."', '".mysql_real_escape_string($_POST['odpowiedz_7'])."', '".mysql_real_escape_string($_POST['odpowiedz_8'])."', '".mysql_real_escape_string($_POST['odpowiedz_9'])."', '".mysql_real_escape_string("$_POST[jezyk1]|$_POST[jezyk2]")."', $punktow )");
					mysql_query("INSERT INTO  test_wynik (ID_TESTU, ODPOWIEDZ1, ODPOWIEDZ2, ODPOWIEDZ3, ODPOWIEDZ4, ODPOWIEDZ5, ODPOWIEDZ6, ODPOWIEDZ7, ODPOWIEDZ8, ODPOWIEDZ9, ODPOWIEDZ10) VALUES ('$id_test', '$odpowiedzi[0]', '$odpowiedzi[1]', '$odpowiedzi[2]', '$odpowiedzi[3]', '$odpowiedzi[4]', '$odpowiedzi[5]', '$odpowiedzi[6]', '$odpowiedzi[7]', '$odpowiedzi[8]', '$odpowiedzi[9]')"); 
				
					echo"<br> <b>Uzyskano $punktow/20 jest to ".round($punktow/20*100)." %</b>  <a href=\"#\" onclick=\"$('#sprawdz_wynik').show(); return false;\">Sprawdz odpowiedzi </a>";
					echo"<div id=\"sprawdz_wynik\" style=\"display: none;\">$sprawdz_wynik</div>";
				}
		}else{
			echo ERROR("Wystąpił błąd. Spróbuj ponownie za jakiś czas");
			echo 'Wystąpił błąd. Spróbuj ponownie za jakiś czas';
		}
}
?> 	 	 	 	 	 	 	 	 	