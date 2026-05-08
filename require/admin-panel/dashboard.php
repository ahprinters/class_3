<?php 

require 'auth.php';
require 'config.php';
require 'admin-functions.php';

echo "<h1>" . $site_name . "</h1>";
echo showAdminWelcomeMessage('admin');