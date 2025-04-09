<?php
// on demarre une session
session_start();

// on désatribue la variable $_SESSION
unset($_SESSION);

// on detruit la session
session_destroy();

include_once '../View/view_deconnexion.php' ?>