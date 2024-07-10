<?php
defined('CONTROL') or die('Acesso negado!');

// efeturas loggout
session_destroy();

// votar para a página incial
header('location: index.php?rota=login');
?>