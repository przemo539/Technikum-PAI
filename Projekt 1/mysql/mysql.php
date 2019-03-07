<?php

if (!$link = mysql_connect('localhost', 'root', '')) {
    echo 'Nie można nawiązać połączenia z bazą danych';
    exit;
}

if (!mysql_select_db('pai', $link)) {
    echo 'Nie można wybrać bazy danych';
    exit;
}
?>