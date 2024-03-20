<?php
function chargerClasses($classe)
{
  if (file_exists(__DIR__ . "/classes/" . $classe . ".php")) {
    require __DIR__ . "/classes/" . $classe . ".php";
  } elseif (file_exists(__DIR__ . "/repositories/" . $classe . ".php")) {
    require __DIR__ . "/repositories/" . $classe . ".php";
  }
}

// La demande justement :
spl_autoload_register('chargerClasses');

// On démarre la session :
session_start();