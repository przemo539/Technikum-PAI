<?php 
session_start();
ob_start();
include_once('config/configuration.php');
DEKODUJ_URL(1);
if(!empty($_SESSION["sessionID"]) and !empty($_SESSION["ID_USER"])){
	$zalogowany = 1;
}
if(!empty($_SESSION["ID_USER"]) and !empty($_SESSION["sessionID"]) and $_SESSION["time"] < time() ){
	$zapytanie = mysql_fetch_row(mysql_query("SELECT id FROM sesja WHERE ID_USER='".$_SESSION["ID_USER"]."' and sessionID='".$_SESSION["sessionID"]."' "));
	if(!$zapytanie[0]>0){
		$_SESSION["ID_USER"] = 0;
		$_SESSION["sessionID"] = 0; 
		$_SESSION["time"] = 0;
	}else{
		$zalogowany = 1;
		$_SESSION["time"] = time()+10;
	}
}
?>

<!DOCTYPE >
	<html>
		<head>
			<link rel="stylesheet" href="<?php echo $adres;?>style.css" />
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
			<script src="http://www.creobajt.pl/przyklady/ajax_jquery/js/jquery-1.11.1.min.js"></script>
			<title>Nauka słówek</title>
		</head>
		<body>

			<div id="kontener">
				<div id="baner"><div style="float:left"><?php include_once('include/logowanie.php');?></div>
					<div style="float:right;font-size:60pt;padding:0px 0px 10px 10px;">Projekt PAI
						<img src="http://www.gminazary.pl/system/obj/7262_ksiazka.gif" style="width:150px;height:150px;padding:10px 20px 20px 20px;" alt="baner"/>
					</div>
				</div>
				<div id="menu"><?php if($zalogowany ==1) include('include/menu_zalogowany.php'); else include('include/menu_niezalogowany.php');?></div>
				<div id="tresc"><?php include('include/tresc.php');?></div>
				<div id="stopka">Site designed by Przemo &copy; 2015</div>
				<div id="informacje"></div>
			</div>
			<script type="text/javascript" >
						 /*POBRANIE DANYCH Z BAZY*/
				function wyswietl(id) { /*Zdefiniowanie zdarzenia inicjującego 
				- kliknięcie przycisku pobierz*/
				 
					$.ajax({
						type:"GET", /*Informacja o tym, że dane będą pobierane*/
						url:"<?php echo $_SESSION['adres'];?>jquery/pobierz.php", /*Informacja, o tym jaki plik będzie przy tym wykorzystywany*/
						contentType:"application/json; charset=utf-8", /*Informacja o formacie transferu danych*/
						data: {id: id}, 
						dataType:'json', /*Informacja o formacie transferu danych*/
						 
							/*Działania wykonywane w przypadku sukcesu*/
							success: function(json) { /*Funkcja zawiera parametr*/
								 
								/*Pętla typu for...in języka Javascript na danych w formacie JSON*/
								for (var klucz in json)
									{
										var wiersz = json[klucz];  /*Kolejne przebiegi pętli wstawiają nowy klucz*/     

										  okno(wiersz[0], wiersz[1],  wiersz[2],  wiersz[3]);
									} 
								 
								 
								
							 
							},
							 
							 
							/*Działania wykonywane w przypadku błędu*/
							error: function(blad) {
								alert( "Wystąpił błąd");
								console.log(blad); /*Funkcja wyświetlająca informacje 
								o ewentualnym błędzie w konsoli przeglądarki*/
							}
						 
					});
				 
				}
				
				function okno(polski, angielski, niemiecki, opis, id=null){
					if(id!= null){
						opis=opis+$('#'+id).html();
					}
					$('<div id="alert" onclick="$(\'#informacje\').hide();">'+
											'<div id="POKAZ_TLO">'+		
												'<div id="POKAZ"> '+
													'<div id="POKAZ_NAGLOWEK">'+polski+' / '+angielski+' / '+niemiecki+'</div>'+
													'<div id="POKAZ_TEXT">'+
														opis +
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>').appendTo('#informacje');
										$('#informacje').show();
				}</script>
	</body>
	</html>

<?php 
ob_end_flush();
?>