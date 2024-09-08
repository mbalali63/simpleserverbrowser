<?php
    require_once('functions.php');
    $fileNameList = getFolderContentArranged(getCurrentPath());
    $iconsPath = "./assets/images/";
?>
<div id="filesListBlock-container">
    

    <?php
        $i = 0;
        foreach ($fileNameList as $item)
        {
            $i++;
            $currentFile = getCurrentPath().DIRECTORY_SEPARATOR.$item;
            if (is_file($currentFile))
            {
                $type = 'file';
            }
            else if (is_dir($currentFile))
            {
                $type = 'directory';
            }
            $className = $type === 'directory' ? "filesListBlock-item directory" : "filesListBlock-item file";
    ?>

            <div class='<?= $className ?>' id="<?= "id-".$i ?>" ondblclick="<?= ($type === 'directory') ? "folderOpen(event)" : "fileOpen(event)";?>">
                <div class="filesListBlock-itemIconContainer">
                    <img class="filesListBlock-itemIcon" src = '<?= $iconsPath.$type.".png" ?>'/>
                </div>
                <p class="filesListBlock-itemTag"><?= $item ?></p>
            </div>
    <?php
        }
    ?>


</div>