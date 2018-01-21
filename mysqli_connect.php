<?php
$login = 'zadkap';
$pswd = 'marLfent6';

DEFINE ('DB_USER', $login);
DEFINE ('DB_PASSWORD', $pswd);
DEFINE ('DB_HOST', 'mudfoot.doc.stu.mmu.ac.uk'); DEFINE ('DB_NAME', $login);
$conn = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
?>
