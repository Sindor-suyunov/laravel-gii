<?php

namespace Sindor\LaravelGii\helpers;

use Illuminate\Support\Pluralizer;

abstract class Generator
{
    public static function generateSingularModelNameFromColumnName(string $column_name): string
    {
        if (str($column_name)->endsWith('_id')){
            $column_name = str($column_name)->remove('_id');
        }
        return $column_name->camel()->singular();
    }

    public static function generateSingularModelNameFromTableName(string $table_name): string
    {
        return str(Pluralizer::singular($table_name))->camel()->ucfirst();
    }

    public static function generatePluralModelNameFromTableName(string $table_name): string
    {
        return str(Pluralizer::plural($table_name))->camel();
    }
}
