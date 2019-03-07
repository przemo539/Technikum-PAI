<?php 
		$rozdzial = $_GET['rozdzial'];

	if(!is_numeric($rozdzial) and $rozdzial!=null)
		echo '<div style="text-align: center;"><h2>Błąd 404</h2>UPSSS....<br> Coś poszło nie tak ....<br> Podana podstrona nie zostala znaleziona<br><img src="http://www.randstad.pl/img/404.png" alt="Błąd 404" /></div>';
	else{
			switch($rozdzial){
				CASE 1:
						$plik = file_get_contents("definition/trygonometria.txt");
						break;
				CASE 2:
						$plik = file_get_contents("definition/trygonometria_tozsamosci.txt");
						break;
				CASE 3:
						$plik = file_get_contents("definition/trygonometria_zadania.txt");
						break;
				Default:
						echo "<div class=\"odstep wysrodkuj \"><h2>
								<a href=\"index.php?dzial=3&rozdzial=1\">Definicja</a><br>
								<a href=\"index.php?dzial=3&rozdzial=2\">Tożsamości</a><br>
								<a href=\"index.php?dzial=3&rozdzial=3\">Zadania</a></h2></div>";
			}
			$plik = nl2br($plik);
			echo $plik;
	}
?>