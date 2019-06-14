<?php
    require __DIR__ .'/../models/connection.php';
    require __DIR__ .'/../models/user.php';
    

    //var_dump($_POST);
    if(isset($_POST['login_user'])){
        $loginUser = login_process($db);
    
        if(is_bool($loginUser) == true){
            var_dump("Sorry couldn't find user");
            die();
        }else{
            $_SESSION['user'] = $loginUser;
            //header('Location: /views/dashboard.php');
            /**
             * 
             * WHERE SHOULD I TAKE MY USER AFTER THEY LOGGED IN???
             */
        }
    }


    function login_process($db){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login_query = 
        "
            SELECT
                id, first_name, last_name, username, email
            FROM users 
            WHERE users.username = '$username' AND users.password = '$password' 
        ";
                
        try {
            $login_stmt = $db->prepare($login_query);
            $login_stmt->execute();
        }
        catch(PDOException $ex)
        {
            die("FAILED TO RUN query: ". $ex->getMessage());
        }
        
        return $login_stmt->fetch();
    }






    /*class Users extends User {
        protected function loginProcess($post){
            $datas = $this->getUser($post);
            foreach($datas as $user){
                var_dump($user);
            }
        }
    }

    $user = new Users;
    
    $loggedUser = $user->loginProcess($_POST);

    var_dump($loggedUser);
    die();
    //$conn = connection_query();
    //var_dump($connection);
    //die();

    //var_dump($_POST);
    //die();
    /*if(isset($_POST['login_user'])){
        login($connection);
        //echo "User is attempting to login";
        //die();
    }

    function login($connection){
        //var_dump($_POST);
        //die();
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login_query = "SELECT * FROM users"; 
        
        //($login_query);
        //die();

        //$values = array($_POST['username'], $_POST['password']);
        
        try{
            //$stmt = $connection->prepare($login_query);
            //$stmt->execute();
            $result = $connection->fetch_all($login_query);
            
        } catch(PDOException $ex){
            die("FAILED TO RUN query: ". $ex->getMessage());
        }

        //$user = $stmt->fetch();
       
        var_dump($user);
        die();

        if(empty($login_user)){
            echo "COULDNT FIND USER";
            die();
        }else{
            var_dump($login_user);
        }


    }*/

    //var_dump()
