<?php

$active_plugins = [
    'seo',
    'analytics'
];

foreach ($active_plugins as $plugin) {

    include "plugins/$plugin.php";

}

?>