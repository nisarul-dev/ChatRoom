<?php
session_start();

$_SESSION['id'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;

header("Location: ../");