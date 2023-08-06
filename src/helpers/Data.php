<?php

namespace Sindor\LaravelGii\helpers;

use Illuminate\Support\Facades\DB;

abstract class Data
{
    public static function getAllTableNames(): ?array
    {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $tableNames = [];
        if ($tables) {
            foreach ($tables as $item) {
                $tableNames[] = $item;
            }
            $tableNames = collect($tableNames)->sort()->toArray();
        }
        return $tableNames;
    }

    public static function getHasManyTableNames(string $table_name): ?array
    {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTables();
        if ($tables){
            $result = [];
            foreach ($tables as $table){
                if ($foreignKeys = $table->getForeignKeys()){
                    foreach ($foreignKeys as $foreignKey){
                        if ($table_name == $foreignKey->getForeignTableName()){
                            $result[$foreignKey->getLocalColumns()[0]] = $table->getName();
                        }
                    }
                }
            }
            return $result;
        }
        return [];
    }

    public static function getBelongsToTableNames(string $table_name): ?array
    {
        $columns = DB::connection()->getDoctrineSchemaManager()->listTableForeignKeys($table_name);
        if ($columns){
            $result = [];
            foreach ($columns as $column){
                $result[$column->getLocalColumns()[0]] = $column->getForeignTableName();
            }
            return $result;
        }
        return [];
    }

    public static function getColumnType(string $table_name, string $column): string
    {
        return DB::connection()->getSchemaBuilder()->getColumnType($table_name, $column);
    }

    public static function getLaravelPropertyTypeFromDB(string $table_name, string $column): string
    {
        $type = self::getColumnType($table_name, $column);
        if (in_array($type, ['bigint', 'smallint'])) {
            return "integer";
        } elseif (in_array($type, ['json', 'jsonb'])) {
            return "array";
        } elseif (in_array($type, ['date', 'datetime', 'timestamp'])) {
            return "datetime";
        } elseif (in_array($type, ['text', 'string'])) {
            return "string";
        }
        return $type;
    }

    public static function getColumns(?string $table_name): array
    {
        return collect(DB::connection()->getDoctrineSchemaManager()->listTableColumns($table_name))->keys()->toArray();
    }
}
