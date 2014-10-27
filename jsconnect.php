<?php
require_once dirname(__FILE__).'/functions.jsconnect.php';
session_start();

// 1. Get your client ID and secret here. These must match those in your jsConnect settings.
$clientID = "jsconnect-test";
$secret = "99bottlesofbeer";

// 2. Grab the current user from your session management system or database here.
$signedIn = isset($_SESSION["testUser"]); // this is just a placeholder

// 3. Fill in the user information in a way that Vanilla can understand.
$user = array();

if ($signedIn) {
   $user = $_SESSION["testUser"];
}

// 4. Generate the jsConnect string.

// This should be true unless you are testing. 
// You can also use a hash name like md5, sha1 etc which must be the name as the connection settings in Vanilla.
$secure = "sha256";
WriteJsConnect($user, $_GET, $clientID, $secret, $secure);
