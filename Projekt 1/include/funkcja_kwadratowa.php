<?php 
		$rozdzial = $_GET['rozdzial'];

	if(!is_numeric($rozdzial) and $rozdzial!=null)
		echo '<div style="text-align: center;"><h2>Błąd 404</h2>UPSSS....<br> Coś poszło nie tak ....<br> Podana podstrona nie zostala znaleziona<br><img src="http://www.randstad.pl/img/404.png" alt="Błąd 404" /></div>';
	else{
			switch($rozdzial){
				CASE 1:
						$plik = file_get_contents("definition/funkcja_kwadratowa.txt");
						break;
				CASE 2:
						$plik = file_get_contents("definition/funkcja_kwadratowa_graficzna.txt");
						break;
				CASE 3:
						$plik = file_get_contents("definition/funkcja_kwadratowa_miejsce_zerowe.txt");
						break;
				CASE 4:
						$plik = file_get_contents("definition/funkcja_kwadratowa_monotonicznosc.txt");
						break;				
				CASE 5:
						$plik = file_get_contents("definition/funkcja_kwadratowa_zadania.txt");
						break;
				CASE 6:
						echo "<div class=\"wysrodkuj\"><form method=\"POST\" action=\"#\" onsubmit=\"return oblicz()\">
									Podaj a: <input type=\"text\" name=\"a\" id=\"a\"/><br>
									Podaj b: <input type=\"text\" name=\"b\" id=\"b\"/><br>
									Podaj c: <input type=\"text\" name=\"c\" id=\"c\"/><br>
									<input type=\"submit\" value=\"Oblicz\"/>
								</form></div><div id=\"odpowiedz\"></div>";
						break;
				Default:
						echo "<div class=\"odstep wysrodkuj \"><h2><a href=\"index.php?dzial=1&rozdzial=1\">Definicja</a><br>
								<a href=\"index.php?dzial=1&rozdzial=2\">Interpretacja graficzna</a><br>
								<a href=\"index.php?dzial=1&rozdzial=3\">Miejsca Zerowe</a><br>
								<a href=\"index.php?dzial=1&rozdzial=4\">Monotoniczność funkcji</a><br>
								<a href=\"index.php?dzial=1&rozdzial=5\">Zadania</a><br>
								<a href=\"index.php?dzial=1&rozdzial=6\">Kalkulator</a></h2></div>";
			}
			echo '<script type="text/javascript">
				function oblicz(){
					var a = parseInt(document.getElementById("a").value);
					var b = parseInt(document.getElementById("b").value);
					var c = parseInt(document.getElementById("c").value);
					var delta = (b*b)-4*a*c;
					var pierw_delta = Math.sqrt(delta);
					if(delta<0){
						document.getElementById("odpowiedz").innerHTML = "Funkcja kwadratowa o współczynnikach a = "+a+" b = "+b+" c = "+c+" nie ma rozwiązań,<br> bo &#8710;=" + b +"<sup>2</sup>-4*"+a+"*"+c+"  = "+delta;
					}
					if(delta == 0){
						document.getElementById("odpowiedz").innerHTML = "Funkcja kwadratowa ma 1 rozwiązanie<br> &#8710;=" + b +"<sup>2</sup>-4*"+a+"*"+c+"  = "+delta+"<br> x<sub>0</sub> = "+((-b)/2*a)
					}
					if(delta>0){
						document.getElementById("odpowiedz").innerHTML = "Funkcja kwadratowa ma 2 rozwiązania <br> &#8710;=" + b +"<sup>2</sup>-4*"+a+"*"+c+"  = " + delta + " <br>x<sub>1</sub> = "+ (((-b)-pierw_delta)/2*a)+"<br> x<sub>2</sub> = "+(((-b)+pierw_delta)/2*a) ;
					}
					return false;
				}
			</script>';
			$plik = nl2br($plik);
			echo $plik;
	}
?>