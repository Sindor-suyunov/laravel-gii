<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;

class GenerateControllerDTO
{
    public bool|null $add_resource_controller;
    public string|null $controller_namespace;
    public string|null $controller_name;
    public string|null $controller_path;
    public string|null $model_name;
    public string|null $model_namespace;

    public static function fromRequest(Request $request): GenerateControllerDTO
    {
        $self = new self();
        $self->add_resource_controller = $request->input('add_resource_controller');
        $self->controller_namespace = $request->input('controller_namespace');
        $self->controller_name = $request->input('controller_name');
        $self->controller_path = $request->input('controller_path');
        return $self;
    }

    public static function fromModelDTO(GenerateModelDTO $dto): GenerateControllerDTO
    {
        $self = new self();
        $self->model_name = $dto->model_name;
        $self->model_namespace = $dto->model_namespace;
        $self->controller_name = $dto->controller_name;
        $self->controller_namespace = $dto->controller_namespace;
        $self->controller_path = $dto->controller_path;
        return $self;
    }
}
