<?php

//echo $_POST['author_name'];

session_start();

//check if author name is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) )
{

#database connection file
include "../db_connection.php";


//check if the book id set
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
            #Get book from database
            $sql2 = "SELECT * from books where id=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$id]);
            $the_book = $stmt2->fetch();


            if($stmt2->rowCount()>0)
            {
            #DELETE the book from database
            $sql = "DELETE from books where id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$id]);
            //If there is no error while deleting the data

            if($res)
            {
                #delete the current book_cover and the file 
                $cover = $the_book['cover'];
                $file  = $the_book['file'];
                $c_b_c = "../uploads/cover/$cover";
                $c_f = "../uploads/files/$cover";
                
                unlink($c_b_c);
                unlink($c_f);

                #success message
                $sm="Successfully removed!";
				header("Location: ../admin.php?success=$sm");
                exit;   
            }
            else
            {
                if(empty($name))
                {
                    #error message
                    $em="Unknow error occurred!";
                    header("Location: ../edit-author.php?error=$em");
                    exit;
                }

            }
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

