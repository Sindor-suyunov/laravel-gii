<?php

namespace Sindor\LaravelGii\DTOs;

use Illuminate\Http\Request;

class GenerateFormRequestDTO
{
    public bool $is_authorization;
    public bool $is_generation_validation;
    public bool $overwrite;

    public string $namespace;
    public string $name;
    public string $path;
    public string $parent_class;

    public string|null $table_name;

    public static function fromRequest(Request $request): GenerateFormRequestDTO
    {
        $self = new self();
        foreach ($request->get('request') as $key => $value) {
            $self->$key = $value ?: "";
        }
        return $self;
    }
}
