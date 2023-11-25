<?php

namespace App\Models;

use App\Core\Database;

class Category
{
    // returns all the categories in the db;
    public static function all()
    {
        $sql = "SELECT * FROM categories";

        return (new Database)->query($sql);
    }

    // creates new category;
    public static function create($name)
    {
        $sql = "INSERT INTO categories(name) VALUES (:name);";

        $params = [":name" => $name];

        return (new Database)->query($sql, $params);
    }

    // creates new category;
    public static function update($id, $name)
    {
        $sql = "UPDATE categories SET name = :name WHERE id = :id";

        $params = [
            ":name" => $name,
            ":id" => $id
        ];

        return (new Database)->query($sql, $params);
    }

    // deletes a category from db;
    public static function delete($id)
    {
        $sql = "DELETE FROM categories WHERE categories.id = :id";

        $params = [":id" => $id];

        return (new Database)->query($sql, $params);
    }
}