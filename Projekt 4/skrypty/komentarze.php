<script type="text/javascript">
function czysc(){
	document.getElementById('text').innerHTML = '';
}
function wyswielt(text){
	alert(text);
}
</script>
<?php 
	echo "<br><br><br><h3>Komentarze:</h3>";
	if(!file_exists("komentarze.txt")){
		touch("komentarze.txt");
	}
	if(isset($_POST['submit'])){
		$nick = addslashes($_POST['nick']);
		$text = addslashes($_POST['text']);
		
		if(!is_null($nick) and !is_null($text)){
			$fp = fopen("komentarze.txt", "a");
			$dodano = fputs($fp,"$nick,$text,");
			fclose($fp);
		}
	}
	$komentarze = file_get_contents("komentarze.txt");
	$komentarze = explode(",", $komentarze);
	echo '<table>';
	$max_rekordow = count($komentarze)-1;
	$licznik = 0;
	for($i=0;$i < $max_rekordow;$i++){
		$licznik++;
		if($licznik == 3) {
			echo '</tr>';
			$licznik = 1;
		}
		if($licznik == 1){
			echo '<tr>';
			echo '<td><b>Autor:</b> '.$komentarze[$i].'  </td>';
		}else{
			echo '<td><b>Napisał:</b> '.$komentarze[$i].'</td>';
		}
		

	}
	echo '</table>';
	
	
?><br><br>
<form method="POST" action="#">
	<b>Nick:</b> <input type="text" name="nick" /><br>
	<textarea name="text" id="text" rows="10" cols="40" onfocus="javascript:czysc();">Tutaj wpisz komentarz</textarea><br>
	<input type="submit" name="submit" value="wyślij" />
</form>


