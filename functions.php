<?php

function getFolderContentArranged($dir)     //Foders then files
{
    $dirList = array_diff(scandir($dir),array('.','..'));
    $dirName = basename($dir);
    $filesArr = [];
    $foldersArr = [];
    foreach ($dirList as $item)
    {
        $currentFile = $dir.DIRECTORY_SEPARATOR.$item;
        if (is_file($currentFile))
        {
            $type = 'file';
            $filesArr[] = $item;
        }
        else if (is_dir($currentFile))
        {
            $type = 'directory';
            $foldersArr[] = $item;
        }
   }
   $itemsArr = [];
   foreach($foldersArr as $item)
   {
       $itemsArr[] = $item;
   }
   foreach($filesArr as $item)
   {
       $itemsArr[] = $item;
   }

   return $itemsArr;
}


function getCurrentPath()
{
    return $_COOKIE['currentPath'];
}


function setCurrentPath($path)
{
    if ($path === "__initialization__")
    {
        if (isset($_COOKIE['currentPath']))
        {
            return setcookie('currentPath',getCurrentPath(),time() + 24*3600);
        }
        else
        {
            return setcookie('currentPath',__DIR__,time() + 24*3600);
        }
    }
    else
    {
        return setcookie('currentPath',$path,time() + 24*3600);        
    }
}


