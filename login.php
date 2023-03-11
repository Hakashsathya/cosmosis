<?php
    //----------FOR MYSQLI----------//
    $con = new mysqli("sql111.epizy.com","epiz_33770171","U9wwmhXHbU","epiz_33770171_cosmosis");
    if($con -> connect_error) {
        die('connection failure:'.mysqli_connect_error());
    }

    //--------PREPARED STATEMENTS-----//
    $login_stmt = $con -> prepare("SELECT * FROM `logindata` WHERE Email_id = ? AND User_password = ?");
    $login_stmt -> bind_param('ss',$email,$password);

    //-------LOGIN AUTHONTICATION---------//
    if(isset($_POST['userEmail']) && isset($_POST['userPassword'])){
        $email = mysqli_real_escape_string($con,$_POST['userEmail']);
        $password = mysqli_real_escape_string($con,$_POST['userPassword']);
        $login_stmt -> execute();
        $check_db = $login_stmt -> get_result();
        $login_check = mysqli_num_rows($check_db);
        if($login_check == 1){
            echo 'success';
        }
        else {
            echo 'failed';
        }
        unset($_POST['userEmail']);
        unset($_POST['userPassword']);
    }

?>