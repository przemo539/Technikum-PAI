<!DOCTYPE >
	<html>
		<head>
			<title>Stronka</title>
			 <link rel="stylesheet" type="text/css" href="style/style.css"/>
			<script type="text/javascript" src="skrypty/aktualizacja.js"></script>
			<meta http-equiv="Content-Type" content="text/html;  charset=UTF-8">
		</head>
		<body>
			<div id="kontener">
				<div id="naglowek"><h2>&nbsp;Site designed by Przemo &copy; 2015</h2></div>
				<div id="prawe_menu">
						<a href="zadanie1.php"> ZADANIE 1</a><br>
						<a href="zadanie2.php"> ZADANIE 2</a>
				</div>
				<div id="newsy"><?php include("skrypty/newsy.php") ?></div>
				<div id="stopka">&nbsp;<script type="text/javascript">czas()</script></div>
			</div>
		</body>
	</html>