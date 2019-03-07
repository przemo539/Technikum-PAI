<?php 
ob_start();
include_once("mysql/mysql.php");
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Projekt PAI</title>
			<link rel="Stylesheet" type="text/css" href="style/style.css" />
			<link rel="Stylesheet" type="text/css" href="style/menu.css" />
		</head>
		<body>
			<?php 
				if($_COOKIE['login'] !=null) $zalogowany = 1;
			?>
			<div id="caly_blok">
				<div id="naglowek">nagłówek strony
					<ol id="menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="index.php?dzial=1">Funkcja Kwadratowa</a>
							<ul>
								<li><a href="index.php?dzial=1&rozdzial=1">Definicja</a></li>
								<li><a href="index.php?dzial=1&rozdzial=2">Interpretacja graficzna</a></li>
								<li><a href="index.php?dzial=1&rozdzial=3">Miejsca Zerowe</a></li>
								<li><a href="index.php?dzial=1&rozdzial=4">Monotoniczność funkcji</a></li>
								<li><a href="index.php?dzial=1&rozdzial=5">Zadania</a></li>
								<li><a href="index.php?dzial=1&rozdzial=6">Kalkulator</a></li>
							</ul>
						</li>
						<li><a href="index.php?dzial=2">Wielomiany</a>
							<ul>
								<li><a href="index.php?dzial=2&rozdzial=1">Definicja</a></li>
								<li><a href="index.php?dzial=2&rozdzial=2">Uporządkowane</a></li>
								<li><a href="index.php?dzial=2&rozdzial=3">Zerowy</a></li>
								<li><a href="index.php?dzial=2&rozdzial=4">Sposób rozwiązywania</a></li>
								<li><a href="index.php?dzial=2&rozdzial=5">Zadania</a></li>
							</ul>
						</li>
						<li><a href="index.php?dzial=3">Trygonometria</a>
							<ul>
								<li><a href="index.php?dzial=3&rozdzial=1">Definicja</a></li>
								<li><a href="index.php?dzial=3&rozdzial=2">Tożsamości</a></li>
								<li><a href="index.php?dzial=3&rozdzial=3">Zadania</a></li>
							</ul>
						</li>
						<li><a href="index.php?dzial=4">Test</a>
							<ul>
								<li><a href="index.php?dzial=4&rozdzial=1">Zamknięte</a></li>
								<li><a href="index.php?dzial=4&rozdzial=2">Otwarte</a></li>
								<li><a href="index.php?dzial=4&rozdzial=3">Losuj 1 zadanie</a></li>
								<li><a href="index.php?dzial=4&rozdzial=4">Losuj 6 zadań</a></li>
							</ul>
						</li>
						<li><a href="index.php?dzial=5">Kontakt</a></li>
					</ol>
				</div>
				<div id="lewy">
					<div class="odstep"><?php include_once('include/logowanie.php'); ?></div>
				</div>
				<div id="prawy">
					<div class="odstep"><?php include_once('include/dane.php');?></div>
				</div>
				<div id="stopka">stopka strony</div>
			</div>
		</body>
	</html>
	<?php 
	ob_end_flush();
	?>