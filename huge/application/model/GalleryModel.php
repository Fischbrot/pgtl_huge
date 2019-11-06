<?php

/**
 * Handles all data manipulation of the admin part
 */
class GalleryModel
{
    /**
     * Simply write the deletion and suspension info for the user into the database, also puts feedback into session
     *
     * @return array
     */

    public static function getPublicContent() {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT `path` FROM `images` WHERE public = 1");
        $query->execute();

        $i = 0;
        $all_images = array();
        $target_dir = "C:/xampp/htdocs/huge/gallery_upload/";

        foreach ($query->fetchAll() as $image) {
            $path = $target_dir . $image->path;
            $img = file_get_contents($path); 
            $tmp = base64_encode($img);
           // die();
            $src = 'data: '.mime_content_type($path).';base64,'.$tmp;

            $all_images[$i] = $src;
            $i++;
            
        }

        return $all_images;
    }

    public static function getUserContent($user_id) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT `path` FROM `images` WHERE `user_id`= :user_id");
        $query->execute(array(':user_id' => $user_id));

        $i = 0;
        $all_images = array();
        $target_dir = "C:/xampp/htdocs/huge/gallery_upload/";

        foreach ($query->fetchAll() as $image) {
            $path = $target_dir . $image->path;
            $img = file_get_contents($path); 
            $tmp = base64_encode($img);
            $src = 'data: '.mime_content_type($path).';base64,'.$tmp;

            $all_images[$i] = $src;
            $i++;
        }

        return $all_images;
    }
}
