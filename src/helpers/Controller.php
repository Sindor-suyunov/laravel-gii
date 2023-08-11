<?php

namespace Sindor\LaravelGii\helpers;

abstract class Controller
{
    public static function generateActionsForResourceController(?string $model_name): string
    {
        $result = "";
        $model = "$" . str($model_name)->singular()->lcfirst();
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
        $result .= "\n\t" . 'public function store(Request $request)';
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // show
        $result .= "\t/**\n\t* Display the specified resource.\n\t*/";
        $result .= "\n\t" . "public function show($model_name $model)";
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // edit
        $result .= "\t/**\n\t* Show the form for editing the specified resource.\n\t*/";
        $result .= "\n\t" . 'public function edit(Request $request, ' . $model_name . " $model)";
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // update
        $result .= "\t/**\n\t* Update the specified resource in storage.\n\t*/";
        $result .= "\n\t" . 'public function update(Request $request, ' . $model_name . " $model)";
        $result .= "\n\t{\n\t\t//\n\t}\n\n";

        // destroy
        $result .= "\t/**\n\t* Remove the specified resource from storage.\n\t*/";
        $result .= "\n\t" . 'public function destroy(Request $request, ' . $model_name . " $model)";
        $result .= "\n\t{\n\t\t//\n\t}\n";

        return $result;
    }

}
