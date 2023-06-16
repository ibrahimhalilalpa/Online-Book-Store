<?php

//echo $_POST['language_name'];

session_start();

//check if language name is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) )
{

#database connection file
include "../db_connection.php";


//check if the language id set
    if(isset($_GET['id']))
    {
        //get data from GET request and store it in var
        $id =$_GET['id'];



        #simple form validation
        if(empty($id))
        {

            $em="Error occurred!";
			header("Location: ../admin.php?error=$em");
            exit;
        }
        else
        {

            #DELETE the language from database
            $sql = "DELETE from languages where id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$id]);
            //If there is no error while deleting the data

            if($res)
            {
                #success message
                $sm="Successfully removed!";
				header("Location: ../admin.php?success=$sm");
                exit;   

        }
            else
            {
                $em="Error occurred!";
                header("Location: ../admin.php?error=$em");
                exit;
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

