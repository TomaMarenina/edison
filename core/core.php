<?php
header('Content-type: text/html; charset=utf-8');
session_start();
include 'class_user.php';
include 'class_psychic.php';

$User = User::getInstance();

$psychics1 = new Psychic(1);
$psychics2 = new Psychic(2);
$psychics3 = new Psychic(3);

include 'ajax.php';