<?php
require_once 'config/config.php';
require_once 'helpers/url_helper.php';
spl_autoload_register(function($files) {
    require_once 'libs/' . $files . '.php';
});
?>