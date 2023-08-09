<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;

class GenerateControllerDTO
{
    public bool $is_resource_controller = false;
    public bool $is_generation_actions = true;
    public bool $overwrite;
    public bool $has_traits;
    public bool $has_interfaces;

    public string $namespace;
    public string $name;
    public string $path;
    public string $parent_class;
    public string $model_name = '';
    public string $model_namespace = '';
    public string $traits;
    public string $interfaces;

    public static function fromRequest(Request $request): GenerateControllerDTO
    {
        $self = new self();
        foreach ($request->get('controller') as $key => $value) {
            $self->$key = $value ?: "";
        }
        return $self;
    }

    public function setAsResourceController(GenerateModelDTO $model): GenerateControllerDTO
    {
        $this->is_resource_controller = true;
        $this->model_name = $model->name;
        $this->model_namespace = $model->namespace;
        return $this;
    }
}
