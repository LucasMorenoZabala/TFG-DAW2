<?php
$controla = true;
include('config.php');
include('lib.php');

session_unset();

session_destroy();

header('Location: ../php/index.php');
