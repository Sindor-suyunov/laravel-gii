<?php

namespace Sindor\LaravelGii\livewire\model;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateControllerComponent extends Component
{
    public bool $controller_overwrite = false;
    public string $controller_namespace = 'App\Http\Controllers';
    public string $controller_parent_class = '\App\Http\Controllers\Controller';
    public string $controller_name = '';
    public string $controller_path = 'app\Http\Controllers';

    public $listeners = [
        'modelName' => 'changeControllerName',
        'validation' => 'check'
    ];

    protected array $rules = [
        'controller_namespace' => 'required',
        'controller_parent_class' => 'required',
        'controller_name' => 'required',
        'controller_path' => 'required',
    ];

    public function check(): void
    {
        $this->validate();
        $this->emit('validated','controller');
    }


    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('gii::livewire.model.create-controller-component');
    }

    public function changeControllerName($modelName): void
    {
        $this->controller_name = $modelName . 'Controller';
    }
}
