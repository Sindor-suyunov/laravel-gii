<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;

class GenerateDTO
{
    public bool $is_save_model;
    public bool $overwrite;

    public string $namespace;
    public string $name;
    public string $path;
    public string $parent_class;

    public string|null $table_name;
    public string|null $model_namespace;
    public string|null $model_name;

    public static function fromRequest(Request $request): GenerateDTO
    {
        $self = new self();
        foreach ($request->get('dto') as $key => $value) {
            $self->$key = $value ?: "";
        }
        return $self;
    }
}
