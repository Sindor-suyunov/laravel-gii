<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenerateSameModelsDTO
{
    public string|null $model_namespace;
    public array|null $table_names;
    public bool|null $model_is_fillable;
    public bool|null $model_has_casts;
    public bool|null $model_has_relations;
    public string|null $table_schema;
    public string|null $model_path;
    public bool|null $add_resource_controller;
    public string|null $controller_namespace;
    public string|null $controller_path;

    public static function fromRequest(Request $request): GenerateSameModelsDTO
    {
        $self = new self();
        $self->model_namespace = $request->input('model_namespace');
        $self->table_names = json_decode($request->input('tables'));
        $self->model_is_fillable = (bool)$request->input('model_is_fillable');
        $self->model_has_casts = (bool)$request->input('model_has_casts');
        $self->model_has_relations = (bool)$request->input('model_has_relations');
        $self->table_schema = $request->input('table_schema');
        $self->model_path = $request->input('model_path');
        $self->add_resource_controller = (bool)$request->input('add_resource_controller');
        $self->controller_namespace = $request->input('controller_namespace');
        $self->controller_path = $request->input('controller_path');
        return $self;
    }

}
