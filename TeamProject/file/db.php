<?php


    function getDatabaseConnection() {
    	$dbHost = getenv('IP');
    	$dbPort = 3306;
    	$dbName = "teamProject";
    	$username = 'root';
    	$password = "";
    	
    	$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    	
    	return $dbConn;
    	
    }
    


?>