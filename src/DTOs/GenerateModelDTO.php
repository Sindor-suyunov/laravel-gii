<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sindor\LaravelGii\helpers\Data;

class GenerateModelDTO
{
    public string|null $table_name;

    public array|null $columns;

    public string|null $model_name = null;
    public string|null $model_parent_class = null;
    public bool|null $model_overwrite;
    public string|null $model_namespace;
    public string|null $model_path;

    public bool|null $model_is_fillable;
    public bool|null $model_has_casts;
    public bool|null $model_has_relations;

    public bool|null $add_resource_controller;
    public bool|null $controller_overwrite;
    public string|null $controller_namespace;
    public string|null $controller_name;
    public string|null $controller_path;
    public string|null $controller_parent_class;

    public static function fromRequest(Request $request): GenerateModelDTO
    {
        $self = new self();
        $self->columns = [];
        $self->model_parent_class = $request->input('model_parent_class');
        $self->table_name = $request->input('table');
        $self->model_overwrite = (bool)$request->input('model_overwrite');
        $self->model_name = $request->input('model_name');
        $self->model_namespace = $request->input('model_namespace');
        $self->model_path = $request->input('model_path');
        $self->model_is_fillable = (bool)$request->input('model_is_fillable');
        $self->model_has_casts = (bool)$request->input('model_has_casts');
        $self->model_has_relations = (bool)$request->input('model_has_relations');
        $self->add_resource_controller = (bool)$request->input('add_resource_controller');
        $self->controller_namespace = $request->input('controller_namespace');
        $self->controller_name = $request->input('controller_name');
        $self->controller_path = $request->input('controller_path');
        $self->controller_parent_class = $request->input('controller_parent_class');
        $self->controller_overwrite = (bool)$request->input('controller_overwrite');
        $self->getColumns();
        return $self;
    }

    private function getColumns(): void
    {
        if ($this->table_name) $this->columns = Data::getColumns($this->table_name);
    }
}
