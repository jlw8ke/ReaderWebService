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
    Flight::render('developer.php');
    
});

Flight::route('POST /login', function() {
    $db = Flight::db();
    $username = $_POST['username'];
    $password= $_POST['password'];
    $query = $db -> prepare("SELECT username, firstname, lastname, email FROM users WHERE username = ? and password = ?", 
        array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $query->execute(array($username, $password));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)) {
        echo '0';
    } else {
        echo Flight::json($result);
    }
});

Flight::route('POST /register', function() {
    $db = Flight::db();
    $username = $_POST['username'];
    $password= $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $params = array($username, $password, $firstname, $lastname, $email);
    $user_params = array($username, $firstname, $lastname, $email);
    $query = $db -> prepare("INSERT INTO users (username, password, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)",
        array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $result = $query->execute($params);
    if($result) {
        $query = $db -> prepare("SELECT username, firstname, lastname, email FROM users WHERE username = ?", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));        
        $query->execute(array($username));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        echo Flight::json($result);
    } else {
        echo '0';
    }    
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
