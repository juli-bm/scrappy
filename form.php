<?php

$nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "Bonjour " . htmlspecialchars($nom) . "!<br>";
    echo "Ton email : " . htmlspecialchars($email) . "<br>";
?>