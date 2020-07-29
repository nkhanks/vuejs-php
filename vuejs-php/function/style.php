<?php

header("Content-type: text/css", true);
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
require_once "scss/scss.php";
require './vueComponent.php';

use ScssPhp\ScssPhp\Compiler;

$scss = new Compiler();

$scssIn = file_get_contents("../assets/scss/main.scss");

$cssOut = $scss->compile($scssIn);

echo $cssOut;




$vue = new vueComponent();

$css = $vue->convertCSS("../vue/App.vue");
        
echo $scss->compile($css); 
