<?php

// IMPORTATION DU FICHIER autoload.php
require_once 'autoload.php';

// INSTANCIATION DU CONTROLLER
$controller = new controller\Controller;
$controller->handleRequest();