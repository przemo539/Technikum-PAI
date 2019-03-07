<h2>Menu zalogowany</h2><br>
<?php 
$module = 'menu';
echo ' 
<a href="'.$_SESSION['adres'].'index.php">Home</a><br>
<a href="'.GENERUJ_LINK($module, 'ogladaj').'">Przejrzyj słówka</a><br>
<a href="'.GENERUJ_LINK($module, 'test').'">Test</a><br>
<a href="'.GENERUJ_LINK($module, 'wyniki').'">Obejrzyj wyniki</a><br>
<a href="'.GENERUJ_LINK($module, 'ustawienia').'">Ustawiania</a><br>
<a href="'.GENERUJ_LINK($module, 'wyloguj').'">Wyloguj</a><br>';
$admin = mysql_fetch_row(mysql_query("SELECT id from user where admin=1 and ID='".$_SESSION['ID_USER']."'"));
if($admin[0]>0)
echo '<br><a href="'.GENERUJ_LINK($module, 'administrator').'">Administrator</a>';
?>
