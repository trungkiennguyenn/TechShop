<?php
session_start();
session_unset();
session_destroy();

// Als dit bestand in 'pages/' zit, ga terug naar root index.php
header('Location: ../index.php');
exit;
?>