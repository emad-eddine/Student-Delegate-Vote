
<?php

    

    // create connection with mysql
    $conn = mysqli_connect("localhost","root","","infol2");

    // check connection
    if(!$conn)
    {
        echo "connection error " . mysqli_connect_error();
    }

    // form validation

    $error = array("card"=>"");
    $studentCardNumber="";

    



    if(isset($_GET["result"]))
    {

        if(empty($_GET["studentCardNumber"]))
        {
            $error["card"]="EMPTY FIELD";
            echo("<script>alert('CHAMP VIDE!!')</script>");
            echo("<script>window.location = '../index.php';</script>");
        }
        else
        {
             $studentCardNumber = $_GET["studentCardNumber"];
             if(!preg_match("/^[0-9]{0,15}$/",$studentCardNumber))
             {
                $error["card"]="INVALID INPUT";
                echo("<script>alert('NON VALIDE!!')</script>");
                echo("<script>window.location = '../index.php';</script>");
             }
        }

        //check if erro is not empty
        if(!array_filter($error))  
        {
            $studentCard = $_GET["studentCardNumber"];
            $sqlQueryToGetStudent = "select student_id from student where student_card=$studentCard";

            //echo $studentCard;
            $queryResult = mysqli_query($conn,$sqlQueryToGetStudent);
             $result = mysqli_fetch_all($queryResult,MYSQLI_ASSOC);

             mysqli_free_result($queryResult);

            if(empty($result))
            {
                  echo("<script>alert('vous etes pas inscrit sur la plateforme!')</script>");
                  echo("<script>window.location = '../index.php';</script>");
            }
            else
            {
                   header("Location: ../result.php");
            }
        }

    } 






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link rel="icon" type="images/jpg" href="images/usto-logo.jpg"/>
    <link rel="stylesheet" href="styles/style.css" >
    <link rel="stylesheet" href="fonts/fonts.css" >
    
</head>
<header>
    <nav>
         <img src="images/usto-logo.jpg" alt="usto-logo" id="usto-logo">
         <ul class="nav-bar">
            <li id="home-page">
                <a href="index.php">Accueil</a>
            </li>
            <li>
                <a href="https://www.univ-usto.dz/" target="_blank">Contact</a>
            </li>
            <li id="show-result-input">
                <form class="home-result-form" action="templates/header.php" methode="GET">
                    <span id="home-input-msg"></span>
                    <input type="text" name="studentCardNumber" placeholder="numero de carte" id="result-check"
                    maxlength = "10" value="<?php echo htmlspecialchars($studentCardNumber)?>"
                    >
                    <button type="submit" name="result" class="home-result-btn btn" >Results</button>
                </form>
            </li>
        </ul>  
    </nav>
</header>

