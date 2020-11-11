<?php
//  Start a session
session_start();

//  Collects all the global functions
require_once("elements/elements.php");
require_once("elements/DBconfig.php");

//  Set homepage to 'home'.php in page/
$page = 'home';
if (isset($_GET["page"]) && !empty($_GET['page'])) {
    $page = $_GET["page"];
}

//Include of the page's
include_once('elements/header.php');
include_once(sprintf('%s/%s.php', 'page', $page));
include_once('elements/footer.php');