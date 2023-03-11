<?php
    //----------FOR MYSQLI----------//
    $con = new mysqli("sql111.epizy.com","epiz_33770171","U9wwmhXHbU","epiz_33770171_cosmosis");
    if($con -> connect_error) {
        die('connection failure:'.mysqli_connect_error());
    }
   
    //--------PREPARED STATEMENTS-----//
    $insert_stmt = $con -> prepare("INSERT INTO `logindata`(`Email_id`, `User_password`) VALUES (?,?)");
    $insert_stmt -> bind_param('ss',$email,$password);

    //--------FOR MYSQL DATABASE-----//
    if(isset($_POST['mysql_query'])){
        $email = mysqli_real_escape_string($con,$_POST['userEmail']);
        $password = mysqli_real_escape_string($con,$_POST['userPassword']);
        $insert_stmt -> execute();
        unset($_POST['mysql_query']);

        //--------FOR MONGODB DATABASE-----//
        require '../vendor/autoload.php';
        $client = new MongoDB\Client('mongodb+srv://hakashsathya01:cosmosisdatabase@cluster0.waibwbm.mongodb.net/?retryWrites=true&w=majority');
        $db = $client -> selectDatabase('cosmosis');
        $collection = $db -> selectCollection('user_details');
        
        $name = $_POST['userName'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $age = $_POST['userAge'];
        $contact = $_POST['contact'];
        $data = array(
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'dateOfBirth' => $dateOfBirth,
            'age' => $age,
            'contact' => $contact
        );
        $status = $collection -> insertOne($data);
        if($status){
            echo "success";
        }else {
            echo "failed";
        }
        unset($_POST['mysql_query']);
        
    }

?>