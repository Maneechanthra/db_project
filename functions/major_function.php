<?php
    session_start();
    require('../config.php');
    print_r( $_POST );

    $selected_stady_plan = $_POST['stady_plan'];
    if( $selected_stady_plan == -1 ){
        $selected_stady_plan = $_POST['other_stady_plan'];
    }    

    // CHECK existing record
    $sql_query = " SELECT * FROM `education_student` WHERE `National_id` = '".$_SESSION['National_id']."'";
    $result = $mysqli->query($sql_query);
    $record_number = mysqli_num_rows( $result );
    // print( $record_number );

    if( $record_number == 1 ){
        $update_sql = " UPDATE `education_student` SET  `stady_plan` = '".$selected_stady_plan."',
                                         `edu_qualification` =  '".$_POST['edu_qualification']."',
                                         `School_name` =  '".$_POST['School_name']."',
                                         `gpax` =  '".$_POST['gpax']."'
                                         

                                        WHERE National_id = '".$_SESSION['National_id']."' ;";
        echo $update_sql;
        $mysqli->query($update_sql);
    }
    else{
        $insert_sql = " INSERT INTO `education_student` (`stady_plan`,`School_name`,`gpax`) VALUES ('".$_SESSION['School_name']."','".$_SESSION['gpax']."','".$selected_stady_plan."' ) ";
        
        $mysqli->query($insert_sql);
    }

  //  header("Location: ../views/major.php");

?>