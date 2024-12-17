<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $favoritepet = htmlspecialchars($_POST["favoritePet"]);

    echo  $name;
    echo  "<br>";

    echo  $lastname;
    echo  "<br>";

    echo  $favoritepet;

if(empty($name) && empty($lastname) && empty($favoritepet)){
exit();
header(header: "Location: ../mainScreen/index.php"); // redirect the main page
}
}