<?php

namespace Sindor\LaravelGii\helpers;

use Illuminate\Support\Pluralizer;

abstract class Generator
{
    public static function generateFillableProperty(?array $columns):string
    {
        if ($columns){
            $result = "/**\n\t* The attributes that are mass assignable.\n\t*\n\t* @var array\n\t*/\n\t";
            $result .= 'protected $fillable = [' . PHP_EOL;
            foreach ($columns as $column) {
                $result .= "\t\t" . "'$column',\n";
            }
            $result .= "\t];";
            return $result;
        }
        return "";
    }

    public static function generateCastsProperty(?array $columns, string $table_name): string
    {
        if($columns){
            $result = "/**\n\t* The attributes that should be cast.\n\t*\n\t* @var array\n\t*/\n\t";
            $result .= 'protected $casts = [' . PHP_EOL;
            foreach ($columns as $column) {
                $result .= "\t\t" . "'$column' => " . "'" . Data::getLaravelPropertyTypeFromDB($table_name, $column) . "',\n";
            }
            $result .= "\t];";
            return $result;
        }
        return "";
    }

    public static function generateModelRelations(string $schema, string $table_name): string
    {
        return self::generateBelongsToRelations($schema, $table_name) . self::generateHasManyRelations($schema, $table_name);
    }

    public static function generateBelongsToRelations(string $schema, string $table_name): string
    {
        $belongsTos = Data::getBelongsToTableNames($schema, $table_name);
        $belongsTodata = "";
        if ($belongsTos){
            $belongsTodata .= "\n\t";
            foreach ($belongsTos as $column => $table){
                $modelName = self::generateSingularModelNameFromTableName($table);
                $belongsTodata .= "/**\n\t* Get the $modelName model\n\t*/\n\t";
                $belongsTodata .= "public function get" .$modelName . "(): \Illuminate\Database\Eloquent\Relations\BelongsTo\n\t{\n\t\t";
                $belongsTodata .= 'return $this->belongsTo(' . $modelName . '::class, ' . "'$column');\n\t}\n";
            }
        }
        return $belongsTodata;
    }

    public static function generateHasManyRelations(string $schema, string $table_name): string
    {
        $hasManyRelations = Data::getHasManyTableNames($schema, $table_name);
        $manyRelations = "";
        if ($hasManyRelations){
            $manyRelations .= "\n\t";
            foreach ($hasManyRelations as $column => $table){
                $modelName = self::generateSingularModelNameFromTableName($table);
                $manyRelations .= "/**\n\t* Get the ".$modelName."[] models\n\t*/\n\t";
                $manyRelations .= "public function get" . self::generatePluralModelNameFromTableName($table) . "(): \Illuminate\Database\Eloquent\Relations\HasMany\n\t{\n\t\t";
                $manyRelations .= 'return $this->hasMany(' . $modelName . '::class, ' . "'$column');\n\t}\n";
            }
        }
        return $manyRelations;
    }

    public static function generateSingularModelNameFromTableName(string $table_name): string
    {
        return str(Pluralizer::singular($table_name))->camel()->ucfirst();
    }

    public static function generatePluralModelNameFromTableName(string $table_name): string
    {
        return str(Pluralizer::plural($table_name))->camel()->ucfirst();
    }

    public static function generateActionsForResourceController(?string $model_name): string
    {
        $result = "";

        // index
        $result .= "/**\n\t* Display a listing of the resource.\n\t*/";
        $result .= "\n\tpublic function index()";
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // create
        $result .= "\t/**\n\t* Show the form for creating a new resource.\n\t*/";
        $result .= "\n\tpublic function create()";
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // store
        $result .= "\t/**\n\t* Store a newly created resource in storage.\n\t*/";
        $result .= "\n\t" .'public function store(Request $request)';
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // show
        $result .= "\t/**\n\t* Display the specified resource.\n\t*/";
        $result .= "\n\t" .'public function show('. $model_name.' $model)';
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // edit
        $result .= "\t/**\n\t* Show the form for editing the specified resource.\n\t*/";
        $result .= "\n\t" .'public function edit(Request $request, '. $model_name.' $model)';
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // update
        $result .= "\t/**\n\t* Update the specified resource in storage.\n\t*/";
        $result .= "\n\t" .'public function update(Request $request, '. $model_name.' $model)';
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // destroy
        $result .= "\t/**\n\t* Remove the specified resource from storage.\n\t*/";
        $result .= "\n\t" .'public function destroy(Request $request, '. $model_name.' $model)';
        $result .= "\n\t{\n\t\t//\n\t}\n";

        return $result;
    }
}
