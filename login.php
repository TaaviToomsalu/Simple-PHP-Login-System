<?php

/*
 * LOGIN.PHP
 * Log in members
*/

//start session / load configs
session_start();
include('includes/config.php');
include('includes/db.php');

//form defaults 
$error['alert'] = '';
$error['user'] = '';
$error['pass'] = '';
$input['user'] = '';
$input['pass'] = '';

if (isset($_POST['submit']))
{
    //process form
    if ($_POST['username'] == '' || $_POST['password'] == '')
    {
        //both fields need to be filled in
        if ($_POST['username'] == '') { $error['user'] = 'required!'; }
        if ($_POST['password'] == '') { $error['pass'] = 'required!'; }
        $error['alert'] = 'Please fill in required fields!';

        //get data from form
        $input['user'] = htmlentities($_POST['username'], ENT_QUOTES);
        $input['pass'] = htmlentities($_POST['password'], ENT_QUOTES);

        //show form
        include('views/v_login.php');  
    }
    else
    {
        // get and clean data from form
        $input['user'] = htmlentities($_POST['username'], ENT_QUOTES);
        $input['pass'] = htmlentities($_POST['password'], ENT_QUOTES);

        //create query
        if ($stmt = $mysqli->prepare("SELECT * FROM members WHERE username=? AND password=?"))
        {
            $stmt->bind_param("ss", $input['user'], md5($input['pass'] . $config['salt']));
            $stmt->execute();
            $stmt->store_result();


            if ($stmt->num_rows() > 0)
            {
                //set session variable
                $_SESSION['username'] = $input['user'];
                $_SESSION['last_active'] = time();

                header("Location: members.php");
            }
            else
            {
                // username/passqord incorrect
                $error['alert'] = "Username or password incorrect!";
                include('views/v_login.php');  

            }
        }
        else
        {
            echo "ERROR: Could not prepare SQL statement.";
        }
    }
}
else
{
    if (isset($_GET['unauthorized']))
    {
        $error['alert'] = 'Please login to view that page!';
    }
    if (isset($_GET['timeout']))
    {
        $error['alert'] = 'Your session has expired. Please log in again.';
    }

    include('views/v_login.php');  
}

// close db connection
$mysqli->close();

?>