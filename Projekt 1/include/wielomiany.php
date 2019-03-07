<?php 
		$rozdzial = $_GET['rozdzial'];

	if(!is_numeric($rozdzial) and $rozdzial!=null)
		echo '<div style="text-align: center;"><h2>Błąd 404</h2>UPSSS....<br> Coś poszło nie tak ....<br> Podana podstrona nie zostala znaleziona<br><img src="http://www.randstad.pl/img/404.png" alt="Błąd 404" /></div>';
	else{
			switch($rozdzial){
				CASE 1:
						$plik = file_get_contents("definition/wielomiany.txt");
						break;
				CASE 2:
						$plik = file_get_contents("definition/wielomiany_uprzadkowane.txt");
						break;
				CASE 3:
						$plik = file_get_contents("definition/wielomiany_zerowe.txt");
						break;
				CASE 4:
						$plik = file_get_contents("definition/wielomiany_sposoby.txt");
						break;				
				CASE 5:
						$plik = file_get_contents("definition/wielomiany_zadania.txt");
						break;
				Default:
						echo "<div class=\"odstep wysrodkuj \"><h2>
								<a href=\"index.php?dzial=2&rozdzial=1\">Definicja</a><br>
								<a href=\"index.php?dzial=2&rozdzial=2\">Uporządkowane</a><br>
								<a href=\"index.php?dzial=2&rozdzial=3\">Zerowy</a><br>
								<a href=\"index.php?dzial=2&rozdzial=4\">Sposób rozwiązywania</a><br>
								<a href=\"index.php?dzial=2&rozdzial=5\">Zadania</a></h2></div>";
			}
			$plik = nl2br($plik);
			echo $plik;
	}
?>
