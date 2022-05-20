<?php

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

$path2config = "/opt/FDMR-Monitor/fdmr-mon.cfg";

if (file_exists($path2config)) {
  $config = parse_ini_file($path2config, true);
} else {
  $config = null;
}

if ($config){
  // Define TGCOUNT_INC
  if (array_key_exists("TGCOUNT_INC", $config["GLOBAL"])) {
    $tgc = $config["GLOBAL"]["TGCOUNT_INC"];
    if ($tgc == "1") {
      $tgc = true;
    } else {
      $tgc = false;
    }
    define("TGCOUNT_INC", $tgc);
  } else {
    define("TGCOUNT_INC", true);
  }

  // Define REPORT_NAME
  if (array_key_exists("REPORT_NAME", $config["GLOBAL"])) {
    define("REPORT_NAME", $config["GLOBAL"]["REPORT_NAME"]);
  } else {
    define("REPORT_NAME", "Dashboard of local DMR Network");
  }

  // Define HEIGHT_ACTIVITY
  if (array_key_exists("HEIGHT_ACTIVITY", $config["GLOBAL"])) {
    $height = $config["GLOBAL"]["HEIGHT_ACTIVITY"];
    if (!strstr($height, "px")) {
      $height = $config["GLOBAL"]["HEIGHT_ACTIVITY"]."px";
    }
    define("HEIGHT_ACTIVITY", $height);
  } else {
    define("HEIGHT_ACTIVITY", "45px");
  }

  // Define THEME_COLOR
  if (array_key_exists("THEME_COLOR", $config["GLOBAL"])) {
    $theme = strtolower($config["GLOBAL"]["THEME_COLOR"]);
    $tc = null;
    if ($theme == "green") {
      $tc = "background-color:#4a8f3c;color:white;";
    } elseif ($theme == "blue1") {
      $tc = "background-color:#2A659A;color:white;";
    } elseif ($theme == "blue2") {
      $tc = "background-color:#43A6DF;color:white;";
    } elseif ($theme == "bluegradient1") {
      $tc = "background-image: linear-gradient(to bottom, #337ab7 0%, #265a88 100%);color:white;";
    } elseif ($theme == "bluegradient2") {
      $tc = "background-image: linear-gradient(to bottom, #3333cc 0%, #265a88 100%);color:white;";
    } elseif ($theme == "redgradient") {
      $tc = "background-image:linear-gradient(0deg, rgba(251,0,0,1) 0%, rgba(255,131,131,1) 50%, rgba(255,255,255,1) 100%);color:black;";
    } elseif ($theme == "greygradient") {
      $tc = "background-image: linear-gradient(to bottom, #3b3b3b 10%, #808080 100%);color:white;";
    } elseif ($theme == "greengradient") {
      $tc = "background-image:linear-gradient(to bottom right,#d0e98d, #4e6b00);color:black;";
    }
    if ($tc) {
      define("THEME_COLOR", $tc);
    } else {
      // Define THEME_COLOR fallback value
      define("THEME_COLOR","background-image: linear-gradient(to bottom, #337ab7 0%, #265a88 100%);color:white;");
    }
  } else {
    define("THEME_COLOR","background-image: linear-gradient(to bottom, #337ab7 0%, #265a88 100%);color:white;");
  }

  // Self Service config
  if (array_key_exists("REPORT_NAME", $config["SELF SERVICE"])) {
    define("PRIVATE_NETWORK", $config["SELF SERVICE"]["PRIVATE_NETWORK"]);
    define("DB_SERVER", $config["SELF SERVICE"]["DB_SERVER"]);
    define("DB_USERNAME", $config["SELF SERVICE"]["DB_USERNAME"]);
    define("DB_PASSWORD", $config["SELF SERVICE"]["DB_PASSWORD"]);
    define("DB_NAME", $config["SELF SERVICE"]["DB_NAME"]);
  } 
}