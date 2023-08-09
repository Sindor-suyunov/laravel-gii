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
    public string|array $table_name = '';

    public string $model_parent_class = '\Illuminate\Database\Eloquent\Model';
    public string $model_namespace = 'App\Models';
    public bool $model_overwrite = false;
    public string $model_name = '';
    public string $model_path = 'app\Models';

    public bool $model_create_fillable = false;
    public bool $model_create_casts = false;
    public bool $model_create_relations = false;

    public bool $has_traits = false;
    public string $traits = '';

    public bool $has_interfaces = false;
    public string $interfaces = '';

    protected array $rules = [
        'model_parent_class' => 'required',
        'model_namespace' => 'required',
        'table_name' => 'required',
        'model_name' => 'required',
        'model_path' => 'required',
        'traits' => 'required_if:has_traits,true',
        'interfaces' => 'required_if:has_interfaces,true',
    ];

    public $listeners = ['validation' => 'check'];

    public function check(): void
    {
        $this->validate();
        $this->emit('validated','model');
    }

    public function generateModelName(): void
    {
        $this->model_name = Generator::generateSingularModelNameFromTableName($this->table_name);
        $this->emit('modelName', $this->model_name);
    }

    public function render(): View|FoundApplication|Factory|Application
    {
        return view('gii::livewire.model.create-model-component');
    }
}
