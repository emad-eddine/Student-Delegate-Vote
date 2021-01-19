<?php 

    include "configs/access.php";
    include "templates/header.php"; 
    require "configs/db.php";
    require "configs/candidatGetter.php";
?>
<?php
    
    $sectionOneWinner ="";
    $sectionTwoWinner ="";

    // get the winner for s1
   
            $sqlGetWinner = "SELECT candidat_id, COUNT(*) as c FROM vote  where 
            candidat_section='S1' GROUP BY candidat_id ORDER BY c DESC LIMIT 1";

             $sqlGetWinnerResult = mysqli_query($conn,$sqlGetWinner);
             $winnerIdSection1 = mysqli_fetch_all($sqlGetWinnerResult);
             mysqli_free_result($sqlGetWinnerResult);

             if(!empty($winnerIdSection1))
             {
                $sectionOneWinner = $winnerIdSection1[0][0];
             }
             else
             {
                $sectionOneWinner ="";
             }
            
            
    // get the winner for s2

             $sqlGetWinner = "SELECT candidat_id, COUNT(*) as c FROM vote  where 
            candidat_section='S2' GROUP BY candidat_id ORDER BY c DESC LIMIT 1";

             $sqlGetWinnerResult = mysqli_query($conn,$sqlGetWinner);
             $winnerIdSection2 = mysqli_fetch_all($sqlGetWinnerResult,MYSQLI_ASSOC);
             mysqli_free_result($sqlGetWinnerResult);

             if(!empty($winnerIdSection2))
             {
                $sectionTwoWinner = $winnerIdSection2[0]["candidat_id"];
             }
             else
             {
                $sectionOneWinner ="";
             }


         // names

        $firstNameSection1="";
        $lastNameSection1="";
        $firstNameSection2="";
        $lastNameSection2="";


    
     // get winner first name and last name for sectionone

             if($sectionOneWinner!= "")
             {
                $sqlGetWinnerFirstLastNameS1 = "select student.first_name,student.last_name from 
                                         student inner join candidat
                                         on candidat.student_id = student.student_id 
                                         where candidat.candidat_id=$sectionOneWinner";

                $sqlGetWinnerFirstLastNameS1Result = mysqli_query($conn,$sqlGetWinnerFirstLastNameS1);
                $sectionOneWinnerName  = mysqli_fetch_all($sqlGetWinnerFirstLastNameS1Result,MYSQLI_ASSOC);
                mysqli_free_result($sqlGetWinnerFirstLastNameS1Result);
                $firstNameSection1 = $sectionOneWinnerName[0]["first_name"];
                $lastNameSection1 = $sectionOneWinnerName[0]["last_name"];
             }
             else
             {
                $firstNameSection1 ="";
                $lastNameSection1 = "";
             }

             

    //  get winner first name and last name for sectionTWo


            if($sectionTwoWinner!= "")
             {
                $sqlGetWinnerFirstLastNameS2 = "select student.first_name,student.last_name from 
                                                student inner join candidat
                                                on candidat.student_id = student.student_id 
                                                where candidat.candidat_id=$sectionTwoWinner";

                $sqlGetWinnerFirstLastNameResultS2 = mysqli_query($conn,$sqlGetWinnerFirstLastNameS2);
                $sectionTwoWinnerName = mysqli_fetch_all($sqlGetWinnerFirstLastNameResultS2,MYSQLI_ASSOC);
                mysqli_free_result($sqlGetWinnerFirstLastNameResultS2);
                $firstNameSection2 = $sectionTwoWinnerName[0]["first_name"];
                $lastNameSection2 = $sectionTwoWinnerName[0]["last_name"];
             }
             else
             {
                $firstNameSection2 = "";
                $lastNameSection2 ="";
             }
    
?>

<body>
        <div class="vote-section1 result-container">
            <h1>Les resultat du section 1 </h1>
                <div class="candidat1-container">
                        <div>
                            <img src="images/student-icon.png" alt="student-icon" >
                            <p><?php 
                                    echo htmlspecialchars($firstNameSection1) ." " . 
                                    htmlspecialchars($lastNameSection1); 
                                  
                                ?>
                            </p>
                        </div>
                </div>
        </div>
        <div class="vote-section1 result-container">
            <h1>Les resultat du section 2 </h1>
                <div class="candidat1-container">
                        <div>
                            <img src="images/student-icon.png" alt="student-icon" >
                            <p><?php 
                                    echo htmlspecialchars($firstNameSection2) ." " . 
                                    htmlspecialchars($lastNameSection2); 
                                  
                                ?>
                            </p>
                        </div>
                </div>
        </div>
        <br>
        <br>
        <br>
</body>
<?php   
    include_once "templates/footer.php";