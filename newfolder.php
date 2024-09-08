<?php
    require_once("functions.php");

    if (isset($_GET['foldername']))
    {
        if (!file_exists(stripslashes(getCurrentPath())))
        {            
            $result = mkdir(getCurrentPath(). DIRECTORY_SEPARATOR . $_GET['foldername']);
            echo json_encode(["success"=>true,"data"=>$result]);
        }
        else
        {
            $result = "can't find the current path:". getCurrentPath();
            echo json_encode(["success"=>false,"data"=>$result]);
        }

    }

