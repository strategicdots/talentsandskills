<?php include_once("includes/initialize.php");

/* $userValidator = new UserValidator();

echo $userValidator->selector() . "<br>";
echo bin2hex($userValidator->validator()); */

$token = random_bytes(32);
$queryToken = bin2hex($token);
$hashedqueryToken = hash('sha512', hex2bin($queryToken));
$dbtoken = hash('sha512', $token);
$selector = bin2hex(random_bytes(8));

parse_str($_SERVER['QUERY_STRING'], $queryString);
$queryString['foo'] = "bar";

// echo http_build_query($queryString);

//echo "<pre>"; print_r($queryString);

// echo "<pre>"; print_r($_SERVER['QUERY_STRING']);