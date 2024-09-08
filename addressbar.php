<?php
    require_once('functions.php');
?>

<div id="addressBar-container">
    <input id = "addressBar-input" type="text" value = <?= getCurrentPath() ?> />
    <div class="circleBtn" id="addressBar-up">
        <span class="material-symbols-outlined">
            stat_1
        </span>
    </div>
    <div class="circleBtn" id="addressBar-newFolderBtn">
        <span class="material-symbols-outlined">
            create_new_folder
        </span>        
    </div>
    <div class="circleBtn" id="addressBar-searchBtn">
        <span class="material-symbols-outlined">
            search
        </span>
    </div>    
</div>

