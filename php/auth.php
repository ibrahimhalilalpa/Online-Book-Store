<?php
session_start();
if (isset($_POST['email']) && 
    isset($_POST['password']))
    {
        #validation helper function
        include "func-validation.php";
        //get data from POST request and store them in var //POST isteğinden veri alın ve bunları var içinde saklayın
        #database connection file
        include "../db_connection.php";


    $email = $_POST['email'];
    $password = $_POST['password'];

    #simple form validation //basit form doğrulama
    $text = "Email";
    $location = "../login.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
    $location = "../login.php";
    $ms = "error";
    is_empty($password, $text, $location, $ms, "");


        #search for the email
        $sql = "SELECT * from admin WHERE email=?"; 
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);

        #if the email exist
    if($stmt->rowCount()===1)
        {
            //echo "YEAH!";
            $user = $stmt->fetch();

            $user_id=$user['id'];
            $user_email=$user['email'];
            $user_password=$user['password'];

            if($email===$user_email)
            {
                if (password_verify($password,$user_password)) {
                    //echo "Okay!";
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    header("Location: ../admin.php");

                }
                else
                {
                    #error message
                    $em = "Incorrect user name or password";
                    header("Location: ../login.php?error=$em");
                }

            }
            else
            {
                #error message
                $em = "Incorrect user name or password";
                header("Location: ../login.php?error=$em");

            }
        }
        else
        {
            //echo "NOPE";
            #error message
            $em = "Incorrect user name or password";
            header("Location: ../login.php?error=$em");

        }
    }

    else
    {
        #Redirect to "../login.php"
        header("Location: ../login.php");
    }
?>