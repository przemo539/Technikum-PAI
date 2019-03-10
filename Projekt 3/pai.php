<!DOCTYPE >
<html>
	<head>
		<meta charset="UTF-8">
		<title>Wyznaczanie liczb pierwszych</title>
	</head>
	<body>
		<?php
		$od = $_POST['od'];
		$do = $_POST['do'];
		$wyznaczono = 0;
		if(is_numeric($od) and is_numeric($do)){
			$liczby[$do];
			for($i=0;$i<=$do;$i++)
				$liczby[$i] = 0;
			for($i=$od;$i<=$do;$i++)
				$liczby[$i] = 1;
			
			for($i=2;$i<=$do;$i++){
				for($j=2;$j<=$do;$j++){
					if($j%$i == 0 and $i != $j) $liczby[$j] = 0;
				}				
			}
			
			echo "liczbami pierwszymi w przedziale od <b>$od</b> do <b>$do</b> są:<br />";
			for($i=2;$i<=$do;$i++){
				echo ($liczby[$i] == 1)? $i." ":"";
				($liczby[$i] == 1)? $wyznaczono++." ":"";
			}
				
			echo "<br />Wyznaczono: ".$wyznaczono." liczb pierwszych";
			
		}elseif(!is_null($do) and !is_null($od)){
			echo "Wpisano złe wartości";
		}
		?>
		<form method="POST" action="#">
			od: <input type="text" name="od" /><br />
			do: <input type="text" name="do" /><br />
			<input type="submit" value="Sprawdz" />
		</form>
	</body>
</html>