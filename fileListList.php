<?php
    require_once('functions.php');
    $fileNameList = getFolderContentArranged(getCurrentPath());
    $iconsPath = "./assets/images/";
?>
<table id="filesListList-container">
    <tr>
        <th></th>
        <th>Name</th>
        <th>Size</th>
        <th>Type</th>
        <th>Date </th>
    </tr>

    <?php
        $currentFile = getCurrentPath().DIRECTORY_SEPARATOR.$item;
        foreach ($fileNameList as $item)
        {
            if (is_file($currentFile))
            {
                $type = 'file';
            }
            else if (is_dir($currentFile))
            {
                $type = 'directory';
            }
            $extension = pathinfo($currentFile, PATHINFO_EXTENSION);
    ?>
    
    <tr>
        <td class="filesListList-itemIconContainer">
            <img class="filesListList-itemIcon" src = '<?= $iconsPath.$type.".png" ?>'/>
        </td>
        <td class="filesListList-itemTag">
            <?= $item; ?>
        </td>
        <td>
            <?= $type === 'file' ? filesize($currentFile) : '';?>
        </td>
        <td>
            <?= empty($extension) ? "" : strtoupper($extension)." File"; ?>
        </td>
        <td>
            <?= file_exists($currentFile) ? date("F d Y H:i:s",filemtime($currentFile)) : '11'; ?>
        </td>
    </tr>
    <?php
        }
    ?>
</table>

