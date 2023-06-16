<?php

//echo $_POST['language_name'];

session_start();

//check if language name is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) )
{

#database connection file
include "../db_connection.php";

//check if language name is summited 
    if(isset($_POST['language_name']))
    {
        //get data from POST request and store it in var
        $name = $_POST['language_name'];

        #simple form validation
        if(empty($name))
        {

            $em="The language name is required";
            header("Location: ../add-language.php?error=$em");
            exit;
        }
        else
        {
            $sql = "INSERT INTO languages (name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name]);
            //If there is no error while inserting the data

            if($res)
            {
                #success message
                $sm="Successfully created.";
                header("Location: ../add-language.php?success=$sm");
                exit;   
            }
            else
            {
                if(empty($name))
                {
                    #error message
                    $em="Unknow error occurred!";
                    header("Location: ../add-language.php?error=$em");
                    exit;
                }
            }
        }


    }
    else
    {
        header("Location: ../admin.php");
        exit; 
    }
}
else
{
    header("Location: ../login.php");
    exit;   
}

