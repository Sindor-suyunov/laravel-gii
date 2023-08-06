<?php

namespace Sindor\LaravelGii\helpers;

use Illuminate\Support\Facades\DB;

abstract class Data
{
    public static function getAllTableNames(): ?array
    {
        $tables = DB::select("SHOW TABLES;");
        $tableNames = [];
        if ($tables){
            foreach ($tables as $item){
                foreach ($item as $key => $value){
                    $tableNames[] = $value;
                }
            }
            $tableNames = collect($tableNames)->sort()->toArray();
        }
        return $tableNames;
    }

    public static function getHasManyTableNames(string $schema, string $table_name): ?array
    {
        return collect(DB::select("SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = ? and REFERENCED_TABLE_NAME = ?",[$schema, $table_name]))->pluck('TABLE_NAME','COLUMN_NAME')->toArray();
    }

    public static function getBelongsToTableNames(string $schema, string $table_name): ?array
    {
        return collect(DB::select("SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = ? and REFERENCED_TABLE_NAME is not null and TABLE_NAME = ?",[$schema, $table_name]))->pluck('REFERENCED_TABLE_NAME','COLUMN_NAME')->toArray();
    }

    public static function getColumnType(string $table_name, string $column): string
    {
        return DB::getSchemaBuilder()->getColumnType($table_name, $column);
    }

    public static function getLaravelPropertyTypeFromDB(string $table_name, string $column): string
    {
        $type = self::getColumnType($table_name, $column);
        if (in_array($type,['bigint','smallint'])){
            return "integer";
        }elseif (in_array($type,['json','jsonb'])){
            return "array";
        }elseif (in_array($type,['date','datetime','timestamp'])){
            return "datetime";
        }elseif (in_array($type,['text','string'])){
            return "string";
        }
        return $type;
    }

    public static function getColumns(?string $table_name): array
    {
        return collect(DB::select("describe $table_name"))->pluck('Field')->toArray();
    }
}
