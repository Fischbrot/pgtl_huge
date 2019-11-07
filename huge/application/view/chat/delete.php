<?php
if(isset($_POST["id"])) {
    GalleryModel::deleteImage($_POST["id"]);
}
?>