<?php

namespace app\core;

abstract class DBModel extends Model
{
    abstract public function table_name(): string;
    abstract public function attributes(): array;

    public function save()
    {
        $tableName = $this->table_name();
        $attributes = $this->attributes();
        $attributes_string = implode(',',$attributes);
        $params_string = implode(',', array_map(fn($attr) => ":$attr", $attributes));

        $stat = self::prepare("INSERT INTO {$tableName}($attributes_string) VALUES ($params_string)");
        foreach ($attributes as $attribute) {
            $stat->bindValue(":{$attribute}", $this->{$attribute});
        }
        $stat->execute();
        return true;

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
