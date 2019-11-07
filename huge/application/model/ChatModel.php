<?php

/**
 * Handles all data manipulation of the admin part
 */
class ChatModel
{
    /**
     * Simply write the deletion and suspension info for the user into the database, also puts feedback into session
     *
     * @return array
     */

    public static function getChatMessages($chat_id) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM `messages` WHERE chat_id = :chat_id");
        $query->execute(array(':chat_id' => $chat_id));

        $i = 0;
        $all_messages = array();

        foreach ($query->fetchAll() as $chat_msg) {

            $all_messages[$i] = $chat_msg;
            $i++;
            
        }

        return $all_messages;
    }

    public static function getChats($user_id) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM `chats` WHERE :user IN (chat_host, chat_partner)");
        $query->execute(array(':user' => $user_id));

        $i = 0;
        $all_chats = array();

        foreach ($query->fetchAll() as $chat) {
            $all_chats[$i] = $chat;

            $i++;
        }

        

        return $all_chats;
    }

    public static function deleteImage($image_id) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("DELETE FROM `images` WHERE `id`= :image_id");
        $query->execute(array(':image_id' => $image_id));


        $target_dir = "C:/xampp/htdocs/huge/gallery_upload/";

        return true;
    }
}
