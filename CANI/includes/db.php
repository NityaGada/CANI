<?php
$server = 'localhost:3308';
$username = 'root';
$password = '';
$database = 'cani';
// Create connection
$conn =  new mysqli($server,$username,$password,$database);

if ($conn->connect_error) {
    die('Connection error: ' .$conn-connect_error());
}