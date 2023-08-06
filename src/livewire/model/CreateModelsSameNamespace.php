<?php

namespace Sindor\LaravelGii\livewire\model;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundApplication;
use Livewire\Component;
use Sindor\LaravelGii\helpers\Generator;

class CreateModelsSameNamespace extends Component
{
    public string $model_namespace;
    public array|string|null $table_names;
    public string $model_path;
    public bool $model_create_fillable;
    public bool $model_create_casts;
    public bool $model_create_relations;
    public bool $add_resource_controller;
    public string $controller_namespace;
    public string $controller_path;
    public bool $hasError = true;

    protected array $rules = [
        'model_namespace' => 'required',
        'table_names' => 'required',
        'model_path' => 'required',
        'controller_path' => "required_if:add_resource_controller,true",
        'controller_namespace' => "required_if:add_resource_controller,true",
    ];

    public function mount(): void
    {
        $this->model_namespace = 'App\Models';
        $this->model_path = 'app\Models';
        $this->table_names = '';
        $this->add_resource_controller = false;
        $this->controller_namespace = 'App\Http\Controllers';
        $this->controller_path = 'app\Http\Controllers';
        $this->model_create_relations = false;
        $this->model_create_casts = false;
        $this->model_create_fillable = false;
    }

    public function check()
    {
        $this->hasError = true;
        $this->validate();
        $this->hasError = false;
    }


    public function render(): View|FoundApplication|Factory|Application
    {
        return view('gii::livewire.model.create-same-models-component');
    }
}
