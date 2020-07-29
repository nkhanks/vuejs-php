<?php
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
header("Content-type: text/javascript", true);
require './vueComponent.php';

$vue = new vueComponent();

echo $vue->convertJS("../vue/App.vue");

