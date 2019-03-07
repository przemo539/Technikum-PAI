<h2>Obejrzyj Wyniki</h2>
<?php 
	$licz = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM test_slowka WHERE ID_USER = $_SESSION[ID_USER]"));
	/*echo '<table>
		<tr>
			<td>ID_SLOWKA1</td> 	
			<td>ID_SLOWKA2</td>
			<td>ID_SLOWKA3</td>
			<td>ID_SLOWKA4</td>
			<td>ID_SLOWKA5</td>
			<td>ID_SLOWKA6</td>
			<td>ID_SLOWKA7</td>
			<td>ID_SLOWKA8</td>
			<td>ID_SLOWKA9</td>
			<td>ID_SLOWKA10</td>
			<td>Data</td>
			<td>Wynik</td>
		</tr>';*/
	echo '<table>
			<tr>
				<td style="width:150px"><b>Data</b></td> 	
				<td style="width:150px"><b>Wynik pkt</b></td>
				<td style="width:150px"><b>Wynik %</b></td>
				<td style="width:150px"><b>Szczegóły</b></td>
			</tr>';
	$wynik = mysql_query("SELECT * FROM test_slowka WHERE ID_USER = $_SESSION[ID_USER]");

	while($wyniki = mysql_fetch_array($wynik)){
		$odpowiedz = mysql_fetch_array(mysql_query("SELECT * FROM test_odpowiedz WHERE ID_TESTU = $wyniki[ID]"));
		$odpowiedz_oznacznona = mysql_fetch_array(mysql_query("SELECT ODPOWIEDZ1, ODPOWIEDZ2, ODPOWIEDZ3, ODPOWIEDZ4, ODPOWIEDZ5, ODPOWIEDZ6, ODPOWIEDZ7, ODPOWIEDZ8, ODPOWIEDZ9, ODPOWIEDZ10 FROM test_wynik WHERE ID_TESTU = $wyniki[ID]"));
		$wybrany_jezyk = $odpowiedz['WYBRANY_JEZYK'];
		
		if($wybrany_jezyk == 0){
			$jezyk1='POLSKI';
			$jezyk2='ANGIELSKI';
			$jezyk3='NIEMIECKI';
		}elseif($wybrany_jezyk == 1){
			$jezyk1='ANGIELSKI';
			$jezyk2='POLSKI';
			$jezyk3='NIEMIECKI';
		}elseif($wybrany_jezyk == 2){
			$jezyk1='NIEMIECKI';
			$jezyk2='POLSKI';
			$jezyk3='ANGIELSKI';
		}
		
		$sprawdz_wynik = '<br>';
		
		for($i=1; $i<=10; $i++){
			$odpowiedz_dzielona = explode('|', $odpowiedz['ODPOWIEDZ'.$i]);
			$sprawdzam =  explode('|', $odpowiedz_oznacznona['ODPOWIEDZ'.$i]);
			
			$slowko = mysql_fetch_array(mysql_query("SELECT POLSKI, ANGIELSKI, NIEMIECKI FROM slowka WHERE id='".$wyniki['ID_SLOWKA'.$i]."'"));											
			
			$sprawdz_wynik .= "Pytanie nr. <b>$i</b> <br>Przetłumacz słówko <b> $slowko[$wybrany_jezyk] </b> z jezyka ".$jezyk1."EGO na $jezyk2 oraz $jezyk3<br>";
			
			if($sprawdzam[0]){
					$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz_dzielona[0] to poprawna odpowiedz</div>";
				
			}else{
					$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz_dzielona[0], poprawna to $slowko[$jezyk2]</div>";
				
			}
			
			if($sprawdzam[1]){
					$sprawdz_wynik .= "<div class=\"POPRAWNIE\">Wpisano $odpowiedz_dzielona[1] to poprawna odpowiedz</div>";
				
			}else{
					$sprawdz_wynik .= "<div class=\"ZLE\">Wpisano $odpowiedz_dzielona[1], poprawna to $slowko[$jezyk3]</div>";
				
			}
		
			$sprawdz_wynik .= "<hr>";										
		}
		
		echo "<tr>
				<td>$odpowiedz[CZAS]</td> 	
				<td>$odpowiedz[WYNIK]</td>
				<td>".round($odpowiedz['WYNIK']/20*100)." %</td>
				<td><a href=\"#\" onclick=\"$('#szczegoly_$wyniki[ID]').show(); return false;\">Szczegóły</a>
					<div id=\"szczegoly_$wyniki[ID]\" onclick=\"$('#szczegoly_$wyniki[ID]').hide();\" style=\"display:none;\">
						<div id=\"POKAZ_TLO\">
							<div id=\"POKAZ2\">
								<div id=\"POKAZ_TEXT\">$sprawdz_wynik</div>
							</div>
						</div>
					</div>
				</td>
			</tr>";
	}
	echo'</table>';	
	echo PAGINACJA($licz[0], 20);
?>