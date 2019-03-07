<h2>Menu niezalogowany</h2><br>
<?php 
$module = 'menu';
echo' <a href="'.$_SESSION['adres'].'index.php">Home</a><br>';
echo' <a href="'.GENERUJ_LINK($module, 'ogladaj').'">Przejrzyj słówka</a><br>';

?>