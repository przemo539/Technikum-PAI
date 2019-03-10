<html>
		<head>
			<title>Zadanie1</title>
			
			<meta http-equiv="Content-Type" content="text/html;  charset=UTF-8">
			<style type="text/css">
				body{
					text-align: center;
				}
			</style>
		</head>
		<body>
			<ol>
			<?php 
				$plik = file_get_contents('lista.txt');
				$dane = explode(' ',$plik);
				$j=1;
					for($i=0;$i<count($dane);$i++){
						if($j == 1)	echo "<li>";
						echo $dane[$i]." ";
						
						if($j == 3) echo "</li>";
						$j++;
						if($j == 4) $j = 1;
						
					}
				?>
				</ol>
		</body>
	</html>