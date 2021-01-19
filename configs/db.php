<?php

    

    $conn = mysqli_connect("localhost","root","","infol2");

    // check connection
    if(!$conn)
    {
        echo "connection error " . mysqli_connect_error();
    }
