<?php
    $host_name  = "db511971564.db.1and1.com";
    $database   = "db511971564";
    $user_name  = "dbo511971564";
    $password   = "<Geben Sie hier Ihr Passwort ein. >";


    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    
    if(mysqli_connect_errno())
    {
    echo '<p>Verbindung zum MySQL Server fehlgeschlagen: '.mysqli_connect_error().'</p>';
    }
    else
    {
    echo '<p>Verbindung zum MySQL Server erfolgreich aufgebaut.</p>';
    }
?>