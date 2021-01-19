<?php 
    
    //stop direct access
    if(!isset($_SERVER['HTTP_REFERER'])){
    header('location: index.php');
    exit;
    }

    session_start();
    include "templates/header.php"; 
    require "configs/db.php";
    require "configs/candidatGetter.php";   
      
?>

<?php



    // counter for radio buttons

    $counter = 0;

    if(isset($_POST["vote-submit"]))
    {
        // check if no radio is selected
        
        if($_POST["candidatSection1"]=="")
        {
            echo "<script>";
            echo "alert('vous devez voté un candidat ')";
            echo "</script>";
            echo "<script>";
            echo " window.location.replace('section1.php');";
            echo "</script>";
        }
        else
        {
           $index = $_POST["candidatSection1"];
           $candidatFirstName = $rowsS1[$index]["first_name"];
           $candidatLastName = $rowsS1[$index]["last_name"];

           // get student id 

            $sqlGetChosenCandidatIdFromStudent = "SELECT student_id from student 

             where first_name='$candidatFirstName'AND last_name ='$candidatLastName'";

            $resultCandiatIdFromStudent = mysqli_query($conn,$sqlGetChosenCandidatIdFromStudent);

            $resultIdFromStudent = mysqli_fetch_all($resultCandiatIdFromStudent,MYSQLI_ASSOC);

            $candidatIdFromStudent = $resultIdFromStudent[0]["student_id"];

            // get candidat 

            $sqlGetCandidatIdFromCandidat = "select candidat.candidat_id from candidat 
                    inner join student on candidat.student_id = $candidatIdFromStudent ";


                    $resultCandidatIdFromCandidat = mysqli_query($conn,$sqlGetCandidatIdFromCandidat);
    
                    $resultIdFromCandidat = mysqli_fetch_all($resultCandidatIdFromCandidat,MYSQLI_ASSOC);

                    $candidatIdFromCandidat = $resultIdFromCandidat[0]["candidat_id"];
            

                   $studentIdElecter = $_SESSION["id"];
            

            $sqlInsertIntoVote =  "INSERT into vote(candidat_id,candidat_section,student_id,number_vote) VALUES
            ($candidatIdFromCandidat,'S1',$studentIdElecter,1)";

            if(mysqli_query($conn,$sqlInsertIntoVote))   
            {   
               header("Location: result.php");
            }
            
        }
    }
   

?>

<body>
        <div class="vote-section1">
            <h1>Les candidats du section 1</h1>
            <form action="section1.php" method="POST" class="vote-form-section1">
                <div class="candidat1-container">      
                    <?php foreach($rowsS1 as $rowS1) 
                    {     
                    ?>
                        <div>
                            <img src="images/student-icon.png" alt="student-icon" >
                            <p><?php 
                                    echo htmlspecialchars($rowS1["first_name"]) ." " . 
                                    htmlspecialchars($rowS1["last_name"]); 
                                ?>
                            </p>
                            <input type="radio" value="<?php echo $counter; ?>" name="candidatSection1" >
                        </div>
                    <?php
                        $counter +=1; 
                    } 
                    ?>
                    
                </div>
                <button class="btn vote-btn " type="submit" name="vote-submit" >VOTE</button>
            </form>
        </div>
        <br>
        <br>
        <br>
</body>

<?php 
    include "templates/footer.php"; 
?>