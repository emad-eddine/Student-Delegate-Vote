<?php
        

        // for section 1 get candidat

        $sqlGetSection1 = "select student.first_name,student.last_name from student 
        inner join candidat on student.student_id = candidat.student_id 
        where student.student_section = 'S1'";

        $resultS1 = mysqli_query($conn,$sqlGetSection1);

        $rowsS1 = mysqli_fetch_all($resultS1,MYSQLI_ASSOC);

        mysqli_free_result($resultS1);


        // for section2 get candidat

        $sqlGetSection2 = "select student.first_name,student.last_name from student 
        inner join candidat on student.student_id = candidat.student_id 
        where student.student_section = 'S2'";
        $resultS2 = mysqli_query($conn,$sqlGetSection2);

        $rowsS2 = mysqli_fetch_all($resultS2,MYSQLI_ASSOC);

        mysqli_free_result($resultS2);


         // get number of vote for each candidat 

        $sqlGetCandidatResult= "SELECT candidat_id ,count(number_vote) AS votes from vote 
                                group by candidat_id";

        $candidatResultRows = mysqli_query($conn,$sqlGetCandidatResult);

        $candidatResults = mysqli_fetch_all($candidatResultRows,MYSQLI_ASSOC);

        mysqli_free_result($candidatResultRows);


        // for result page
        
        