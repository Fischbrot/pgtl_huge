<?php
$target_dir    = "C:/xampp/htdocs/huge/gallery_upload";
$string = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(32))), 0, 32);
$target_file   = $target_dir . "/" . $string;
$uploadOk      = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image (mime type)
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    //$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        $database = DatabaseFactory::getFactory()->getConnection();
        $all_images = array();

        $t_name = basename($_FILES["fileToUpload"]["name"]);

        $user_t = UserModel::getUserDataByUserNameOrEmail(Session::get('user_name'));

        $public_bool = false;
        if (isset($_POST["hide"])) {
            $public_bool = false;
        } else {
            $public_bool = true;
        }

        $sql = "INSERT INTO images (public, user_id, path) VALUES (:public, :user_id, :name)";
        $query = $database->prepare($sql);
        $query->execute(array(':public' => $public_bool, ':user_id' => $user_t->user_id, ':name' => $string));




    } else {
        echo $_FILES["fileToUpload"]["tmp_name"];
        echo $target_file;
        echo "Sorry, there was an error uploading your file.";
    }
}
?>