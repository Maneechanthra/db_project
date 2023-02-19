<?php
    session_start();
    require('../config.php');
    print_r( $_POST );

    $selected_religion = $_POST['Religion'];
    if( $selected_religion == -1 ){
        $selected_religion = $_POST['other_religion'];
    }    
    $selected_ethnicity = $_POST['Ethnicity'];
    if( $selected_ethnicity == -1 ){
        $selected_ethnicity = $_POST['other_ethnicity'];
    }    

    $selected_nationality = $_POST['Nationality'];
    if( $selected_nationality == -1 ){
        $selected_nationality = $_POST['other_nationality'];
    }    

    // CHECK existing record
    $sql_query = " SELECT * FROM `applications` WHERE `National_id` = '".$_SESSION['National_id']."' AND `Tcas_round` = ".$_SESSION['Tcas_round']." ;  ";
    $result = $mysqli->query($sql_query);
    $record_number = mysqli_num_rows( $result );
    // print( $record_number );

    if( $record_number == 1 ){
        $update_sql = " UPDATE `applications` SET  `Religion` = '".$selected_religion."', 
                                        `Ethnicity` = '".$selected_ethnicity."', 
                                        `Nationality` = '".$selected_nationality."', 
                                        `Birth_date` =  '".$_POST['Birth_date']."',
                                        `Firstname_en` = '".$_POST['Firstname_en']."',
                                        `Province` = '".$_POST['Ref_prov_id']."',
                                        `District` = '".$_POST['Ref_dist_id']."',
                                        `Sub_district` = '".$_POST['Ref_subdist_id']."'
                                        WHERE National_id = '".$_SESSION['National_id']."' ;";
        echo $update_sql;
        $mysqli->query($update_sql);
    }
    else{
        $insert_sql = " INSERT INTO `applications` (`National_id`, `Tcas_round`, `Firstname_en`, `Birth_date`, `Religion`,`Province`,`District`,`Sub_district`) VALUES ('".$_SESSION['Ref_subdist_id']."''".$_SESSION['Ref_dist_id']."'.'".$_SESSION['Ref_prov_id']."',,'".$_SESSION['National_id']."', ".$_SESSION['Tcas_round'].", '".$_POST['Firstname_en']."', '".$_POST['birth_date']."','".$selected_religion."','".$selected_ethnicity."'  ) ";
        
        $mysqli->query($insert_sql);
    }

    header("Location: ../views/major.php");

?>