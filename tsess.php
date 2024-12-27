<?php
session_start();
$_SESSION['id'] = '123';
echo session_save_path();
if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}
?>
