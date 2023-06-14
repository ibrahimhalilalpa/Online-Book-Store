<?php

#get all languages function

function get_all_languages($con)
{
    $sql = "SELECT * FROM languages";
    $stmt = $con-> prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount()>0) {
        $languages = $stmt->fetchAll();
    }
    else
    {
        $languages=0;
    }
    return $languages;
}



function get_language($con,$id)
{
    $sql = "SELECT * FROM languages WHERE id=?";
    $stmt = $con-> prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount()>0) {
        $language = $stmt->fetch();
    }
    else
    {
        $language=0;
    }
    return $language;
}
