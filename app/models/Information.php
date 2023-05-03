<?php

namespace App\models;

use App\helpers\Connection;

class Information
{
    public static function informat_content($id)
    {
        $query = Connection::make()->prepare("SELECT informations.*,information_images.image
    FROM `informations`,information_images
    WHERE information_images.information_id = informations.id AND informations.id =:id");
        $query->execute([':id' => $id]);
        return $query->fetch();
    }
    public static function informat()
    {
        $query = Connection::make()->query("SELECT
        informations.*
    FROM
        `informations`");
        return $query->fetchAll();
    }
    
}
