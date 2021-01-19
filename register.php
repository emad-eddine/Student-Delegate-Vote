<?php 
    
    include "templates/header.php"; 
    require "configs/db.php";
?>

<?php
    session_start();
    $studentCardNumber = $studentFirstName = $studentLastName ="";
    $studentId="";

    $errors = array("card"=>"","firstName"=>"","lastName"=>"");

    if(isset($_POST["submit"]))
    {

    // check user inputs if are !empty and valid

    // student card number
    if(empty($_POST["studentCardNumber"]))
    {
        $errors["card"] = "X";
    }
    else{
        $studentCardNumber = $_POST["studentCardNumber"];
        if(!preg_match("/^[0-9]{0,15}$/",$studentCardNumber))
        {
            $errors["card"] = "X";
        }
    }

    // first name

    if(empty($_POST["studentFirstName"]))
    {
        $errors["firstName"] = "X";
    }
    else{
        $studentFirstName = $_POST["studentFirstName"];
        if(!preg_match("/^[a-zA-Z\s]+$/",$studentFirstName))
        {
            $errors["firstName"] = "X";         
        }
    }

    //last name

    if(empty($_POST["studentLastName"]))
    {
        $errors["lastName"] = "X";
    }
    else{
        $studentLastName = $_POST["studentLastName"];
        if(!preg_match("/^[a-zA-Z\s]+$/",$studentLastName))
        {
            $errors["lastName"] = "X";
        }
    }

    // insert student data to db

    if(!array_filter($errors))
    {
        // get if user want to become candidat
        $checked = isset($_POST["candidat"]);

        // store data to db

        $studentSection = mysqli_real_escape_string($conn,$_POST["Section-name"]);
        $studentCard = mysqli_real_escape_string($conn,$_POST["studentCardNumber"]);
        $firstName = mysqli_real_escape_string($conn,$_POST["studentFirstName"]);
        $lastName = mysqli_real_escape_string($conn,$_POST["studentLastName"]);

        // check if user exist in db

        $sqlCheck = "select * from student where first_name='$firstName' AND last_name='$lastName'
                    AND student_card=$studentCard";

        $sqlCheckResult = mysqli_query($conn,$sqlCheck);
        $checkResults = mysqli_fetch_all($sqlCheckResult,MYSQLI_ASSOC);
        mysqli_free_result($sqlCheckResult);

        if(empty($checkResults))
        {
            $sqlInsert = "INSERT into student(student_section,student_card,first_name,last_name) VALUES
                    ('$studentSection' ,$studentCard,'$firstName' ,'$lastName')";

            if(mysqli_query($conn,$sqlInsert))   
            {
                if($checked)
                {
                    // check if candidat <5

                    $sqlGetCandidatCount = "select count(candidat.candidat_id) as candidat_count from candidat 
                                            join student on candidat.student_id = student.student_id 
                                            and student.student_section='$studentSection'";

                    $sqlGetCandidatCountResult = mysqli_query($conn,$sqlGetCandidatCount);
                    $candidatCountResult = mysqli_fetch_all($sqlGetCandidatCountResult,MYSQLI_ASSOC);
                    mysqli_free_result($sqlGetCandidatCountResult);
                    $count=$candidatCountResult[0]["candidat_count"];
                  
                    if($count<5)
                    {
                        $sqlGetStudentId = "SELECT student_id from student 
                                             where first_name='$firstName'AND last_name ='$lastName'
                                            AND student_card=$studentCard";

                        $resultId = mysqli_query($conn,$sqlGetStudentId);

                        $resultIdArray = mysqli_fetch_all($resultId,MYSQLI_ASSOC);

                         mysqli_free_result($resultId);

                        $studentId = $resultIdArray[0]["student_id"];
   
                        $_SESSION["id"]=$studentId;

                        $sqlInsertToCandidat = "INSERT into candidat (student_id)VALUES($studentId)";
                        if(mysqli_query($conn,$sqlInsertToCandidat))
                        {
                            if($_POST["Section-name"] == "S1")
                            {
                                header("Location: section1.php");
                            }
                            else 
                            {
                               header("Location: section2.php");
                            }

                        }
                    }
                    else
                    {   $currentSectionNumber = substr($studentSection, -1);
                        echo("<script>alert('vous pouvez pas devient un candidat le nomber >5!')</script>");
                        echo("<script>window.location = 'section$currentSectionNumber.php';</script>"); 
                    }   
                }
                else
                {
                    if($_POST["Section-name"] == "S1")
                        {
                            header("Location: section1.php");
                        }
                        else 
                        {
                            header("Location: section2.php");
                        }
               }
            }    
        } 
        else
        {
            $sqlGetStudentId = "SELECT student_id from student 
                                where first_name='$firstName'AND last_name ='$lastName'
                                AND student_card=$studentCard";

                        $resultId = mysqli_query($conn,$sqlGetStudentId);

                        $resultIdArray = mysqli_fetch_all($resultId,MYSQLI_ASSOC);

                         mysqli_free_result($resultId);

                        $studentId = $resultIdArray[0]["student_id"];
                        
            // check if student has voted
            $sqlStudentVoteCheck = "SELECT student_id from vote
                                     where student_id=$studentId";

            $sqlStudentVoteCheckResult = mysqli_query($conn,$sqlStudentVoteCheck);
            $StudentVoteCheckResult = mysqli_fetch_all($sqlStudentVoteCheckResult,MYSQLI_ASSOC);
            mysqli_free_result($sqlStudentVoteCheckResult);

            if(empty($StudentVoteCheckResult))
            {
                $_SESSION["id"]=$studentId;
                if($_POST["Section-name"] == "S1")
                {
                    header("Location: section1.php");
                }
                else 
                {
                    header("Location: section2.php");
                }
            }
            else
            {
                header("Location: result.php");
            }


            
        }      
    }
    
}

?>

<body>
    <div class="add-form-container">
        <form action="register.php" method="POST" class="add-form">  
                    <label>Choisir votre section :</label>
                    <select name="Section-name" class="section-container">
                        <option value="S1">Section 01</option>
                        <option value="S2">Section 02</option>
                    </select>   
            <div class="student-form" >
                    <input type="text" name="studentCardNumber" placeholder="votre numero du carte etudiant"
                    maxlength = "10" id="studentCardNumber" value="<?php echo htmlspecialchars($studentCardNumber)?>"
                    >   
                    <span  style="color:rgb(237, 105, 101);"><?php echo $errors["card"] ?></span>
                    <input type="text" name="studentFirstName" placeholder="votre nom"
                    maxlength = "30" id="studentFirstName" value="<?php echo htmlspecialchars($studentFirstName)?>"
                    >   
                    <span  style="color:rgb(237, 105, 101);"><?php echo $errors["firstName"] ?></span>
                    <input type="text" name="studentLastName" placeholder="votre prenom"
                    maxlength = "30" id="studentLastName" value="<?php echo htmlspecialchars($studentLastName)?>"
                    >           
                    <span style="color:rgb(237, 105, 101);"><?php echo $errors["lastName"] ?></span>
                    <div class="candidat-form">            
                    <label>Voulez-vous devien un candidat </label>
                    <span>
                        <input type="checkbox" name="candidat" id="checkBox" >
                    </span>
                </div>
                <button class="btn register-btn" type="submit" name="submit">Enregister</button>
            </div>
        </form>
    </div>

    <script src="scripts/add.js" type="text/javascript"></script>
</body>

<?php 
    include "templates/footer.php"; 
?>