<?php

namespace Sindor\LaravelGii\helpers;

use Doctrine\DBAL\Schema\Column;

abstract class DTO
{

    public static function getSaveModelFunction(?string $table_name, string $model_name): string
    {
        $result = "\n\n\tpublic function storeModel(" . $model_name . ' $model, array $otherAttributes = []): bool' . "\n\t{";
        $result .= "\n\t\t" . '$model' . "->fill([";
        foreach (Data::getTrueColumns($table_name) as $column_name) {
            $result .= "\n\t\t\t'" . $column_name . "' => " . '$this->' . $column_name . ",";
        }
        $result = substr($result, 0, -1);
        $result .= "\n\t\t]);";
        $result .= "\n\t\tif (" . '$otherAttributes) $model->fill($otherAttributes);';
        $result .= "\n\t\t" . 'return $model->save();';
        $result .= "\n\t}";
        return $result;
    }

    public static function getProperties(?string $table_name): string
    {
        $result = "public function __construct(";
        $columns = Data::getColumnsWithInfo($table_name);
        foreach ($columns as $column) {
            /* @var Column $column */
            $name = $column->getName();
            if (in_array($name, Data::doNotTouchFields())) continue;
            $result .= "\n\t\tpublic " . Data::getProperTypeForClass(Data::getColumnTypeInLaravel($column));
            $result .= ($column->getNotnull()) ? " " : "|null ";
            $result .= "$" . $name . ",";
        }
        $result = substr($result, 0, -1);
        $result .= "\n\t)\n\t{}";
        return $result . self::getCreateFromRequest($table_name);
    }

    private static function getCreateFromRequest(?string $table_name): string
    {
        $result = "\n\n\tpublic function createFromRequest(\Illuminate\Foundation\Http\FormRequest " . '$request): self'. "\n\t{";
        $result .= "\n\t\treturn new self(";
        foreach (Data::getTrueColumns($table_name) as $column_name) {
            $result .= "\n\t\t\t" . $column_name . ': $request->input(' . "'" . $column_name . "'),";
        }
        $result = substr($result, 0, -1);
        $result .= "\n\t\t);\n\t}";
        return $result;
    }
}
