<?php
//  Start a session
session_start();

//  Collects all the global functions
require_once("elements/elements.php");
require_once("elements/DBconfig.php");

//  Set homepage to 'home'.php
$page = 'home';

if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

include(sprintf('%s/%s.php', 'page', $page));
// include(sprintf('%1$s/%2$s.php', 'content', $content)); dit kan ook, het is maar net wat je wil
// je kunt in de header nu switchen van content door bijv. localhost/index.php?pagw=andereContent in te vulen