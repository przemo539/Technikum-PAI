<?php 
		$rozdzial = $_GET['rozdzial'];

	if(!is_numeric($rozdzial) and $rozdzial!=null)
		echo '<div style="text-align: center;"><h2>Błąd 404</h2>UPSSS....<br> Coś poszło nie tak ....<br> Podana podstrona nie zostala znaleziona<br><img src="http://www.randstad.pl/img/404.png" alt="Błąd 404" /></div>';
	else{
			switch($rozdzial){
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
				Default:
						echo "<div class=\"odstep wysrodkuj \"><h2>
								<a href=\"index.php?dzial=4&rozdzial=1\">Zamknięte</a><br>
								<a href=\"index.php?dzial=4&rozdzial=2\">Otwarte</a><br>
								<a href=\"index.php?dzial=4&rozdzial=3\">Losuj 1 zadanie</a><br>
								<a href=\"index.php?dzial=4&rozdzial=4\">Losuj 6 zadań</a></h2></div>";
			}
	}
?>
