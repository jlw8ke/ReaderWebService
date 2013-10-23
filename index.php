<?php
require 'flight/Flight.php';
include_once'src/dblogin.php';


//Set up database connection
Flight::register('db', 'PDO', array('mysql:host='.$SERVER.';dbname='.$DB, $USER, $PASS), function($db) {
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

Flight::route('/', function(){    
    Flight::render('login.php');
});

//Web Service
Flight::route('/developers', function(){
    echo 'This is the base url for the Paper Stack web service';
});

Flight::route('/developers/users(/@id)',function($id) {
    $db = Flight::db();
    $query;
    if(!isset($id)) {
        $query = $db -> prepare("SELECT id, username, firstname, lastname, email FROM users",  array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));        
        $query->execute();
    } else {
        $query = $db -> prepare("SELECT id, username, firstname, lastname, email FROM users WHERE id = ?",  array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $query->execute(array($id));
    }
    $userList = $query->fetchAll(PDO::FETCH_ASSOC);
    $result = Flight::json($userList);
});

Flight::route('/developers/files(/@user_id(/@file_id))',function($user_id, $file_id) {
    $db = Flight::db();
    $query;
    if(!isset($user_id)) {
        $query = $db -> prepare("SELECT id, title, author, owner FROM files",  array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));        
        $query->execute();
    } else if(isset($user_id) && !isset($file_id)){
        $query = $db -> prepare("SELECT id, title, author, owner FROM files WHERE owner = ?",  array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $query->execute(array($user_id));
    } else {
        $query = $db -> prepare("SELECT id, title, author, owner FROM files WHERE owner = ? AND id = ?",  array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $query->execute(array($user_id, $file_id));
    }
    $fileList = $query->fetchAll(PDO::FETCH_ASSOC);
    $result = Flight::json($fileList);
});

Flight::set('flight.log_errors', true);
Flight::start();
?>
