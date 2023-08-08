<?php

namespace Sindor\LaravelGii\livewire\model;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundApplication;
use Livewire\Component;
use Sindor\LaravelGii\DTOs\GenerateModelDTO;
use Sindor\LaravelGii\helpers\Generator;

class CreateModelComponent extends Component
{
    public string|null $table_name = '';

    public string $model_parent_class = '\Illuminate\Database\Eloquent\Model';
    public string $model_namespace = 'App\Models';
    public bool $model_overwrite = false;
    public string $model_name = '';
    public string $model_path = 'app\Models';

    public bool $model_create_fillable = false;
    public bool $model_create_casts = false;
    public bool $model_create_relations = false;

    public bool $add_resource_controller = false;
    public bool $controller_overwrite = false;
    public string $controller_namespace = 'App\Http\Controllers';
    public string $controller_parent_class = '\App\Http\Controllers\Controller';
    public string $controller_name = '';
    public string $controller_path = 'app\Http\Controllers';

    public bool $add_traits = false;
    public array $traits = [];

    public bool $hasError = true;

    protected array $rules = [
        'model_parent_class' => 'required',
        'model_namespace' => 'required',
        'table_name' => 'required',
        'model_name' => 'required',
        'model_path' => 'required',
        'controller_name' => "required_if:add_resource_controller,true",
        'controller_path' => "required_if:add_resource_controller,true",
        'controller_namespace' => "required_if:add_resource_controller,true",
        'controller_parent_class' => "required_if:add_resource_controller,true",
    ];

    public function generateModelName(): void
    {
        $this->model_name = Generator::generateSingularModelNameFromTableName($this->table_name);
        $this->generateControllerName();
    }

    public function generateControllerName(): void
    {
        if ($this->add_resource_controller) $this->controller_name = Generator::generateSingularModelNameFromTableName($this->table_name) . 'Controller';
    }

    public function check()
    {
        $this->hasError = true;
        $this->validate();
        $this->hasError = false;
    }

    public function render(): View|FoundApplication|Factory|Application
    {
        return view('gii::livewire.model.create-model-component');
    }
}
