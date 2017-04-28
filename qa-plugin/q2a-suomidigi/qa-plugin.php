<?php
/*
  Plugin Name: Suomidigi
  Plugin URI:
  Plugin Description: 
  Plugin Version: 1.0
  Plugin Date: 2016-01-01
  Plugin Author: Suomidigi
  Plugin Author URI: www.suomidigi.fi
  Plugin License: GPLv2
  Plugin Minimum Question2Answer Version: 1.5
  Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
  header('Location: ../../');
  exit;
}

qa_register_plugin_overrides('suomidigi-avatar-override.php');
qa_register_plugin_overrides('suomidigi-url-override.php');