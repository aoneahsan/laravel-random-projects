
<?php
session_start();
?>

<!-- Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved. -->
<!-- For licensing, see LICENSE.md -->

<?php

// Don't remove the following two rows
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$root = "http://$_SERVER[HTTP_HOST]";

// checking lang value
if(isset($_COOKIE['sy_lang'])) {
    $load_lang_code = $_COOKIE['sy_lang'];
} else {
    $load_lang_code = "en";
}

// including lang files
switch ($load_lang_code) {
    case "en":
        require(__DIR__ . '/lang/en.php');
        break;
    case "pt-BR":
        require(__DIR__ . '/lang/pt-BR.php');
        break;
    case "de-DE":
        require(__DIR__ . '/lang/de-DE.php');
        break;
    case "pl":
        require(__DIR__ . '/lang/pl.php');
        break;
    case "tr":
        require(__DIR__ . '/lang/tr.php');
        break;
}

// Including the plugin config file, don't delete the following row!
require(__DIR__ . '/pluginconfig.php');
// Including the functions file, don't delete the following row!
require(__DIR__ . '/function.php');
// Including the check_permission file, don't delete the following row!
require(__DIR__ . '/check_permission.php');

$_SESSION["username"] = "disabled_pw";

?>

<!DOCTYPE html>
<html lang="en"
      ondragover="toggleDropzone('show')"
      ondragleave="toggleDropzone('hide')">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php echo $imagebrowser1; ?> :: Fujana Solutions</title>
    <meta name="author" content="Moritz Maleck">
    <link rel="icon" href="img/cd-ico-browser.ico">
    
    <link rel="stylesheet" href="styles.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="dist/jquery.lazyload.min.js"></script>
    <script src="dist/js.cookie-2.0.3.min.js"></script>
    
    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    
    <script src="function.js"></script>
    
</head>
<body ontouchstart="">
    
<div id="header">
    <a class="" href="https://imagebrowser.maleck.org/" target="_blank"><img src="img/cd-icon-image.png" class="headerIconLogo"></a>
    <img onclick="Cookies.remove('qEditMode');window.close();" src="img/cd-icon-close-grey.png" class="headerIconRight iconHover">
    <img onclick="reloadImages();" src="img/cd-icon-refresh.png" class="headerIconRight iconHover">
    <img onclick="uploadImg();" src="img/cd-icon-upload-grey.png" class="headerIconCenter iconHover">
    <?php if($show_settings): ?>
    <img onclick="pluginSettings();" src="img/cd-icon-settings.png" class="headerIconRight iconHover">
    <?php endif; ?>
</div>
    
<div id="editbar">
    <div id="editbarView" onclick="#" class="editbarDiv"><img src="img/cd-icon-images.png" class="editbarIcon editbarIconLeft"><p class="editbarText"><?php echo $buttons1; ?></p></div>
    <a href="#" id="editbarDownload" download><div class="editbarDiv"><img src="img/cd-icon-download.png" class="editbarIcon editbarIconLeft"><p class="editbarText"><?php echo $buttons2; ?></p></div></a>
    <div id="editbarUse" onclick="#" class="editbarDiv"><img src="img/cd-icon-use.png" class="editbarIcon editbarIconLeft"><p class="editbarText"><?php echo $buttons3; ?></p></div>
    <div id="editbarDelete" onclick="#" class="editbarDiv"><img src="img/cd-icon-qtrash.png" class="editbarIcon editbarIconLeft"><p class="editbarText"><?php echo $buttons4; ?></p></div>
    <img onclick="hideEditBar();" src="img/cd-icon-close-black.png" class="editbarIcon editbarIconRight">
</div>
    
<div id="updates" class="popout"></div>
    
<div id="dropzone" class="dropzone" 
     ondragenter="return false;"
     ondragover="return false;"
     ondrop="drop(event)">
    <p>
        <img src="img/cd-icon-upload-big.png"><br>
        <?php echo $imagebrowser4; ?>
    </p>
</div>

<p class="folderInfo"><?php echo $imagebrowser2; ?> <span id="finalcount"></span> <?php echo $imagebrowser3; ?> - <span id="finalsize"></span>
    <?php if($file_style == "block") { ?>
        <img title="List" src="img/cd-icon-list.png" class="headerIcon floatRight" onclick="window.location.href = 'pluginconfig.php?file_style=list';">
    <?php } elseif($file_style == "list") { ?>
        <img title="Block" src="img/cd-icon-block.png" class="headerIcon floatRight" onclick="window.location.href = 'pluginconfig.php?file_style=block';">
        <img title="Quick Edit" id="qEditBtnOpen" src="img/cd-icon-qedit.png" class="headerIcon floatRight" onclick="toogleQEditMode();">
        <img title="Quick Edit" id="qEditBtnDone" src="img/cd-icon-done.png" class="headerIcon floatRight" onclick="toogleQEditMode();">
    <?php } ?>
</p>

<div id="files">
    <?php
    loadImages();
    ?>
</div>

    
<?php if($file_style == "block") { ?>
    <div class="fileDiv" onclick="window.location.href = 'https://imagebrowser.maleck.org/';">
        <div class="imgDiv">Image Uploader for CKEditor</div>
        <p class="fileDescription">&copy; 2015-2019 by Moritz Maleck</p>
        <p class="fileTime">imagebrowser.maleck.org</p>
        <p class="fileTime">---</p>
    </div>
<?php } elseif($file_style == "list") { ?>
    <div class="fullWidthFileDiv" onclick="window.location.href = 'https://imagebrowser.maleck.org/';">
        <div class="fullWidthimgDiv"><img class="fullWidthfileImg lazy" data-original="img/cd-icon-credits.png"></div>
        <p class="fullWidthfileDescription">Image Uploader for CKEditor</p>
        <p class="fullWidthfileTime fullWidthfileMime">---</p>
        <p class="fullWidthfileTime">---</p>
        <p class="fullWidthfileTime fullWidth30percent">imagebrowser.maleck.org</p>
    </div>
<?php } ?>

<div id="imageFullSreen" class="lightbox popout">
    <div class="buttonBar">
        <button id="imageFullSreenClose" class="headerBtn" onclick="$('#imageFullSreen').hide(); $('#background').slideUp(250, 'swing');"><img src="img/cd-icon-close.png" class="headerIcon"></button>
        <a href="#" id="imgActionDownload" download><button class="headerBtn"><img src="img/cd-icon-download.png" class="headerIcon"></button></a>
        <button class="headerBtn greenBtn" id="imgActionUse" onclick="#" class="imgActionP"><img src="img/cd-icon-use.png" class="headerIcon"> <?php echo $buttons3; ?></button>
    </div><br><br>
    <img id="imageFSimg" src="#" style="#"><br>
</div>
    
<div id="uploadImgDiv" class="lightbox popout">
    <div class="buttonBar">
        <button class="headerBtn" onclick="$('#uploadImgDiv').hide(); $('#background2').slideUp(250, 'swing');"><img src="img/cd-icon-close.png" class="headerIcon"></button>
        <button class="headerBtn greenBtn" name="submit" onclick="$('#uploadImgForm').submit();"><img src="img/cd-icon-upload.png" class="headerIcon"> <?php echo $buttons7; ?></button>
    </div><br><br><br>
    <form action="imgupload.php" method="post" enctype="multipart/form-data" id="uploadImgForm" onsubmit="return checkUpload();">
        <p class="uploadP"><img src="img/cd-icon-select.png" class="headerIcon"> <?php echo $uploadpanel1; ?></p>
        <input type="file" name="upload" id="upload">
        <br><h3 class="settingsh3" style="font-size:12px;font-weight:lighter;"><?php echo $uploadpanel2; ?><br><span style="font-weight:bolder;">"<?php echo $useruploadfolder; ?>"</span> (<?php echo $uploadpanel3; ?>)</h3>
        <br>
    </form>
</div>

<?php if($show_settings) { ?>
    <div id="settingsDiv" class="lightbox popout">
        <div class="buttonBar">
            <button class="headerBtn" onclick="$('#settingsDiv').hide(); $('#background3').slideUp(250, 'swing');"><img src="img/cd-icon-close.png" class="headerIcon"></button>
        </div><br><br><br>

        <h3 class="settingsh3"><?php echo $panelsettings1; ?></h3>
        <!--choose existing folder text-->
        <p class="settingsh3 saveUploadPathP"><?php echo $panelsettings2; ?></p>
        <!--editable upload path-->
        <p class="uploadP editable" id="uploadpathEditable"><?php echo $useruploadfolder; ?></p>
        <!--path history-->
        <p class="settingsh3 saveUploadPathP"><?php echo $panelsettings3; ?></p>
        <?php
        pathHistory();
        ?>
        <!--cancel btn-->
        <button class="headerBtn greyBtn saveUploadPathA" id="pathCancel"><?php echo $buttons5; ?></button>
        <!--save btn-->
        <button class="headerBtn saveUploadPathA" onclick="updateImagePath();"><?php echo $buttons6; ?></button><br class="saveUploadPathA">

        <br><h3 class="settingsh3"><?php echo $panelsettings4; ?></h3>
        <!--Hide/show news section-->
        <?php if($news_sction == "yes"){ ?>
            <p class="uploadP" onclick="disableNews()"><img src="http://www.maleck.org/imageuploader/img/hide.png" class="headerIcon"> <?php echo $panelsettings21; ?></p>
        <?php } elseif($news_sction == "no") { ?>
            <p class="uploadP" onclick="enableNews()"><img src="http://www.maleck.org/imageuploader/img/show.png" class="headerIcon"> <?php echo $panelsettings22; ?></p>
        <?php } ?>
        <!--Hide/show file extension-->
        <?php if($file_extens == "yes"){ ?>
            <p class="uploadP" onclick="extensionSettings('no');"><img src="img/cd-icon-hideext.png" class="headerIcon"> <?php echo $panelsettings5; ?></p>
        <?php } elseif($file_extens == "no") { ?>
            <p class="uploadP" onclick="extensionSettings('yes');"><img src="img/cd-icon-showext.png" class="headerIcon"> <?php echo $panelsettings6; ?></p>
        <?php } ?>
        <!--change language-->
        <p class="uploadP" onclick="openLangPanel();"><img src="img/cd-icon-translate.png" class="headerIcon"> <?php echo $panelsettings20; ?></p>

        <!--show if password is enabled-->
        <?php if($_SESSION["username"] != "disabled_pw"){ ?>
            <br><h3 class="settingsh3"><?php echo $panelsettings7; ?></h3>
            <!--logout-->
            <p class="uploadP" onclick="logOut();"><img src="img/cd-icon-logout.png" class="headerIcon"> <?php echo $panelsettings8; ?></p>
            <!--disable password-->
            <p class="uploadP" onclick="window.open('http://imageuploaderforckeditor.altervista.org/disable_pw.html','about:blank', 'toolbar=no, scrollbars=yes, resizable=no, width=900, height=600');"><img src="img/cd-icon-disable.png" class="headerIcon"> <?php echo $panelsettings9; ?></p>
        <?php } ?>

        <br><h3 class="settingsh3"><?php echo $panelsettings12; ?></h3>
        <!--FAQ button-->
        <p class="uploadP" onclick="window.open('https://support.maleck.org/index.php?p=faq','_blank');"><img src="img/cd-icon-faq.png" class="headerIcon"> <?php echo $panelsettings13; ?></p>
        <!--report a bug-->
        <p class="uploadP" onclick="window.open('https://support.maleck.org/index.php?p=support','_blank');"><img src="img/cd-icon-bug.png" class="headerIcon"> <?php echo $panelsettings14; ?></p>

        <br><h3 class="settingsh3"><?php echo $panelsettings15; ?></h3>
        <!--current version-->
        <p class="uploadP"><img src="img/cd-icon-version.png" class="headerIcon"> <?php echo $currentpluginver; ?></p>

        <br><h3 class="settingsh3"><?php echo $panelsettings16; ?></h3>
        <!--credits-->
        <p class="uploadP"><img src="img/cd-icon-credits.png" class="headerIcon"> <?php echo $panelsettings17; ?></p>

        <br><h3 class="settingsh3"><?php echo $panelsettings18; ?></h3>
        <!--icon refr-->
        <p class="uploadP" onclick="window.open('https://icons8.com','_blank');"><img src="img/cd-icon-images.png" class="headerIcon"> <?php echo $panelsettings19; ?></p>

        <br>
    </div>
<?php } ?>
    
<div id="background" class="background" onclick="$('#imageFullSreenClose').trigger('click');"></div>
<div id="background2" class="background" onclick="$('#uploadImgDiv').hide(); $('#background2').slideUp(250, 'swing');"></div>
<div id="background3" class="background" onclick="$('#settingsDiv').hide(); $('#background3').slideUp(250, 'swing');"></div>
<div id="background4" class="background" onclick="$('#setLangDiv').hide(); $('#background4').slideUp(250, 'swing');"></div>

<!--Noscript part if js is disabled-->
<noscript> <div class="noscript"> <div id="folderError" class="noscriptContainer popout"> <b><?php echo $alerts1; ?></b><br><br><?php echo $alerts5; ?> <a href="http://www.enable-javascript.com/" target="_blank"><?php echo $alerts6; ?></a><br><br><?php echo $alerts4; ?> </div></div></noscript>
    
<?php   
// Including the language file, don't delete the following row!
require(__DIR__ . '/lang/lang.php');
?>

</body>
</html>