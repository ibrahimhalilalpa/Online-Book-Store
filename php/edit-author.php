<?php

//echo $_POST['author_name'];

session_start();

//check if author name is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    #database connection file
    include "../db_connection.php";


    //check if author name is summited 
    if (
        isset($_POST['author_name']) &&
        isset($_POST['author_id'])
    ) {
        //get data from POST request and store them in var
        $name = $_POST['author_name'];
        $id = $_POST['author_id'];


        #simple form validation
        if (empty($name)) {

            $em = "The author name is required";
            header("Location: ../edit-author.php?error=$em&id=$id");
            exit;
        } else {
            #update the database
            $sql = "UPDATE authors SET name =? where id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name, $id]);
            //If there is no error while inserting the data

            if ($res) {
                #success message
                $sm = "Successfully updated!";
                header("Location: ../edit-author.php?success=$sm&id=$id");
                exit;
            } else {
                if (empty($name)) {
                    #error message
                    $em = "Unknow error occurred!";
                    header("Location: ../edit-author.php?error=$em&id=$id");
                    exit;
                }
            }
        }


    } else {
        header("Location: ../admin.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}