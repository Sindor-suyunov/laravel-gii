<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sindor\LaravelGii\helpers\Data;

class GenerateModelDTO
{
    public string|null $model_namespace;
    public string|null $table_name;
    public string|null $model_name;
    public bool|null $model_is_fillable;
    public bool|null $model_has_casts;
    public bool|null $model_has_relations;
    public array|null $columns;
    public string|null $model_path;
    public bool|null $add_resource_controller;
    public string|null $controller_namespace;
    public string|null $controller_name;
    public string|null $controller_path;

    public static function fromRequest(Request $request): GenerateModelDTO
    {
        $self = new self();
        $self->model_namespace = $request->input('model_namespace');
        $self->table_name = $request->input('table');
        $self->model_name = $request->input('model_name');
        $self->model_is_fillable = (bool)$request->input('model_is_fillable');
        $self->model_has_casts = (bool)$request->input('model_has_casts');
        $self->model_has_relations = (bool)$request->input('model_has_relations');
        $self->columns = [];
        $self->model_path = $request->input('model_path');
        $self->add_resource_controller = (bool)$request->input('add_resource_controller');
        $self->controller_namespace = $request->input('controller_namespace');
        $self->controller_name = $request->input('controller_name');
        $self->controller_path = $request->input('controller_path');
        $self->getColumns();
        return $self;
    }

    private function getColumns(): void
    {
        if ($this->table_name) $this->columns = Data::getColumns($this->table_name);
    }
}
