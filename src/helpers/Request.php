<?php

namespace Sindor\LaravelGii\helpers;

use Doctrine\DBAL\Schema\Column;

abstract class Request
{
    public static function authorization(bool $auth = true): string
    {
        $string = "false";
        if ($auth) $string = "true";
        return "public function authorize(): bool\n\t{\n\t\treturn " . $string . ";\n\t}";
    }

    public static function getValidation(?string $table_name): string
    {
        $result = "";
        if ($columns = Data::getColumnsWithInfo($table_name)) {
            $result .= "\n\n\tpublic function validation(): array\n\t{\n\t\treturn [";
            foreach ($columns as $column) {
                if (in_array($column->getName(), Data::doNotTouchFields())) continue;
                $result .= self::validationForColumn($column, $table_name);
            }
            $result .= "\n\t\t];\n\t}";
        }
        return $result;
    }

    public static function validationForColumn(Column $column, string $table_name): string
    {
        $result = "\n\t\t\t'" . $column->getName() . "' => [";
        $result .= $column->getNotnull() ? "'required', " : "'nullable', ";
        $result .= "'" . Data::getLaravelPropertyTypeFromDB($table_name, $column->getName()) . "', ";
        $result .= $column->getLength() ? "'max:" . $column->getLength() . "', " : "";
        $result = substr($result, 0, -2);
        $result .= "],";
        return $result;
    }
}
