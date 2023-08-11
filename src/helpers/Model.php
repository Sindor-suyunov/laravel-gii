<?php

namespace Sindor\LaravelGii\helpers;

abstract class Model
{
    public static function generateFillableProperty(?array $columns): string
    {
        if ($columns) {
            $result = "\n\t/**\n\t* The attributes that are mass assignable.\n\t*\n\t* @var array\n\t*/\n\t";
            $result .= 'protected $fillable = [' . PHP_EOL;
            foreach ($columns as $column) {
                if (in_array($column, Data::doNotTouchFields())) continue;
                $result .= "\t\t" . "'$column',\n";
            }
            $result .= "\t];";
            return $result;
        }
        return "\r";
    }

    public static function generateCastsProperty(?array $columns, string $table_name): string
    {
        if ($columns) {
            $result = "\n\t/**\n\t* The attributes that should be cast.\n\t*\n\t* @var array\n\t*/\n\t";
            $result .= 'protected $casts = [' . PHP_EOL;
            foreach ($columns as $column) {
                if (in_array($column, Data::doNotTouchFields())) continue;
                $result .= "\t\t" . "'$column' => " . "'" . Data::getLaravelPropertyTypeFromDB($table_name, $column) . "',\n";
            }
            $result .= "\t];";
            return $result;
        }
        return "\r";
    }

    public static function generateModelRelations(string $table_name): string
    {
        return self::generateBelongsToRelations($table_name) . self::generateHasManyRelations($table_name);
    }

    public static function generateBelongsToRelations(string $table_name): string
    {
        $belongsTos = Data::getBelongsToTableNames($table_name);
        $belongsTodata = "";
        if ($belongsTos) {
            foreach ($belongsTos as $column => $table) {
                $modelName = Generator::generateSingularModelNameFromTableName($table);
                $belongsTodata .= "\n\t/**\n\t* Get the $modelName model\n\t*/\n\t";
                $belongsTodata .= "public function " . Generator::generateSingularModelNameFromColumnName($column) . "(): \Illuminate\Database\Eloquent\Relations\BelongsTo\n\t{\n\t\t";
                $belongsTodata .= 'return $this->belongsTo(' . $modelName . '::class, ' . "'$column');\n\t}\n";
            }
        }
        return $belongsTodata;
    }

    public static function generateHasManyRelations(string $table_name): string
    {
        $hasManyRelations = Data::getHasManyTableNames($table_name);
        $manyRelations = "";
        if ($hasManyRelations) {
            foreach ($hasManyRelations as $column => $table) {
                $modelName = Generator::generateSingularModelNameFromTableName($table);
                $manyRelations .= "\n\t/**\n\t* Get the " . $modelName . "[] models\n\t*/\n\t";
                $manyRelations .= "public function " . Generator::generatePluralModelNameFromTableName($table) . "(): \Illuminate\Database\Eloquent\Relations\HasMany\n\t{\n\t\t";
                $manyRelations .= 'return $this->hasMany(' . $modelName . '::class, ' . "'$column');\n\t}\n";
            }
        }
        return $manyRelations;
    }
}
