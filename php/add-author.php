<?php

//echo $_POST['author_name'];

session_start();

//check if author name is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) )
{

#database connection file
include "../db_connection.php";

//check if author name is summited 
    if(isset($_POST['author_name']))
    {
        //get data from POST request and store it in var
        $name = $_POST['author_name'];

        #simple form validation
        if(empty($name))
        {

            $em="The author name is required";
            header("Location: ../add-author.php?error=$em");
            exit;
        }
        else
        {
            $sql = "INSERT INTO authors (name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name]);
            //If there is no error while inserting the data

            if($res)
            {
                #success message
                $sm="Successfully created.";
                header("Location: ../add-author.php?success=$sm");
                exit;   
            }
            else
            {
                if(empty($name))
                {
                    #error message
                    $em="Unknow error occurred!";
                    header("Location: ../add-author.php?error=$em");
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

