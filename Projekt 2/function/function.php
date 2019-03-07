<?php 
function ERROR($text){
	return '<div id="alert" onclick="$(\'#alert\').hide();">
				<div id="zaciemnienie_tla">				
					<div id="ERROR"> 
						<div id="ERROR_NAGLOWEK">Wystąpil błąd !!</div>
							<div id="ERROR_TEXT">
								'.$text.' 
						</div>
					</div>
				</div>
			</div>';
}

function DONE($text){
	return '<div id="alert" onclick="$(\'#alert\').hide();">
				<div id="zaciemnienie_tla">				
					<div id="DONE"> 
						<div id="DONE_NAGLOWEK">Udało się !!</div>
							<div id="DONE_TEXT">
								'.$text.' 
						</div>
					</div>
				</div>
			</div>';	
}

function SPRAWDZ($ciag1, $ciag2){
	$ciag1 = trim(strtolower($ciag1));
	$ciag2 = trim(strtolower($ciag2));
	if(strlen($ciag1) == strlen($ciag2)){
		if(!strcmp($ciag1, $ciag2))
			return true;
		else
			return false;
	}else{
		return false;
	}
}

function PAGINACJA($rekordow, $limit, $parametry = null){
	$stron = ceil($rekordow/$limit);
	if(is_null($_GET['strona'])){
		$aktualnie = 1;
	}else{
		$aktualnie = $_GET['strona'];
	}
	if(!is_null($parametry)){
		$parametry = implode("/",$parametry);
		$parametr = "$parametry/";
	}else{
		$parametr = '';
	}
	$sprawdzenie = 0;
	echo '<div id="paginacja">';
	for($i=1;$i<=$stron;$i++){

		if($i == $aktualnie) 
			echo "$i&nbsp;";
		elseif($i == 1 and $aktualnie!= 1)
			echo "<a href=\"$_SESSION[adres]$_GET[module]/$_GET[action]/".$parametr."strona/$i\">$i</a>&nbsp;";
		elseif($i == $stron)
			echo "<a href=\"$_SESSION[adres]$_GET[module]/$_GET[action]/".$parametr."strona/$i\">$i</a>&nbsp;";
		elseif($i-2 == $aktualnie){
			echo "<a href=\"$_SESSION[adres]$_GET[module]/$_GET[action]/".$parametr."strona/$i\">$i</a>&nbsp;";
			$sprawdzenie = 0;
		}elseif($i-1 == $aktualnie){
			echo "<a href=\"$_SESSION[adres]$_GET[module]/$_GET[action]/".$parametr."strona/$i\">$i</a>&nbsp;";
			$sprawdzenie = 0;
		}elseif($i+1 == $aktualnie){
			echo "<a href=\"$_SESSION[adres]$_GET[module]/$_GET[action]/".$parametr."strona/$i\">$i</a>&nbsp;";
			$sprawdzenie = 0;
		}elseif($i+2 == $aktualnie){
			echo "<a href=\"$_SESSION[adres]$_GET[module]/$_GET[action]/".$parametr."strona/$i\">$i</a>&nbsp;";
			$sprawdzenie = 0;
		}elseif(($i < $aktualnie+2 or $i > $aktualnie-2)and $sprawdzenie != 1){
			$sprawdzenie = 1;
			echo '...&nbsp;';
		}

	}
	echo '</div>';
}

function GENERUJ_LINK($module, $action, $parametry = null){
	
	if(!is_null($parametry)){
		$parametry = implode("/",$parametry);
	}
	
	 return $_SESSION['adres']."$module/$action/$parametry"; 
}

function DEKODUJ_URL($usun=null){
	$pathInfo = trim($_SERVER['REQUEST_URI'], '/'); //usuwamy znak / z końca
	
	if (empty($pathInfo)) { //pusta ścieżka
		return true;
	}    
	$arr = explode('/',$pathInfo); //rozbijamy naszą ścieżkę na podstawie /
	if(!is_null($usun)){
		$arr = array_slice ($arr, $usun);
	}	
	
	$count = count($arr);
	//pierwsze dwa elementy to moduł i akcja
	$_GET['module'] = $arr[0];
	$_GET['action'] = isset($arr[1]) ? $arr[1] : ''; //tu małe zabezpieczenie, gdyby ktoś zapomniał podać akcji
			
	//następne elementy to nazwy parametru i parametr i tak co dwa
	for ($i=2; $i < $count;$i+=2){
		$_n = $arr[$i]; //nazwa parametru
		$_v = isset($arr[$i+1]) ? $arr[$i+1] : ''; //wartość parametru
		$_GET[$_n] = $_v;
	}
	
	//print_r($_GET);
}
?>