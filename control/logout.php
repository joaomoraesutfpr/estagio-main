<?php
session_start();
session_destroy();
header('location: /estagio-main/index.php');
?>