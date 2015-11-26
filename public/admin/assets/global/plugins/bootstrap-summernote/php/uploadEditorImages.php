<?php

if ($_FILES['file']['name']) {

    if (!$_FILES['file']['error']) {
        $name = md5(rand(100, 200));
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
//        $destination = '/images/content/' . $filename; //change this directory
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/images/content/' . $_POST['id'];

        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $destination = $dir .  '/' . $filename;
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        echo '/images/content/' . $_POST['id'] . '/' . $filename;//change this URL
    }
    else
    {
        echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}