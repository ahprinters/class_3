<?php 


require_once 'database.php';
require_once 'User.php';

class Profile {
    public function showProfile() {
        $user = new User();
        return "Profile Name: " . $user->getUserName();
    }
}