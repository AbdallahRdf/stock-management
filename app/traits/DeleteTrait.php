<?php

namespace App\Traits;

use App\Core\Database;

trait DeleteTrait
{
    public static function delete($id)
    {
        $sql = "DELETE FROM " . static::TABLE_NAME . " WHERE id=:id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }
}