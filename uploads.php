<?php

if(isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)) {
        if($fileError == 0) {
            if($fileSize < 1000000) {
                // Creating a new unique name for file
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                // Creating a path for the new file in uploads folder and uploading it
                $fileDestination = 'uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header('Location: index.php?uploadSuccess');
            } else {
                echo "File size too big!";
            }
        } else {
            echo "There was an error while uploading the file!";
        }
    } else {
        echo "File not supported!";
    }
}

?>