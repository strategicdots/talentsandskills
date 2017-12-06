<?php include_once("includes/initialize.php");

/* $userValidator = new UserValidator();

echo $userValidator->selector() . "<br>";
echo bin2hex($userValidator->validator()); */

$token = random_bytes(32);
$queryToken = bin2hex($token);
$hashedqueryToken = hash('sha512', hex2bin($queryToken));
$dbtoken = hash('sha512', $token);
$selector = bin2hex(random_bytes(8));

/* if(hash_equals($dbtoken, $hashedqueryToken)) {
      echo "1";
} else {
      echo "2";
} */

echo $queryToken . "<br>"; echo $dbtoken . "<br>"; echo date("Y-m-d H:i:s", (time() + 60*60)) . "<br>"; echo $selector; exit;