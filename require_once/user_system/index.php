<?php 


require_once 'database.php';
require_once 'Profile.php';
require_once 'User.php';

$profile = new Profile();
echo $profile->showProfile();