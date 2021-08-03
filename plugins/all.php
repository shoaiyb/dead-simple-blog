<?php

$plugins = glob(__DIR__ . '*');
foreach ($plugins as $plugin) {
    include_once $plugin;
}

?>
