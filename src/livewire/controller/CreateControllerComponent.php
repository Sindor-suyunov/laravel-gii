<?php

namespace Sindor\LaravelGii\livewire\controller;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateControllerComponent extends Component
{
    public bool $controller_overwrite = false;
    public bool $is_generation_actions = true;
    public string $controller_namespace = 'App\Http\Controllers';
    public string $controller_parent_class = '\App\Http\Controllers\Controller';
    public string $controller_name = '';
    public string $controller_path = 'app\Http\Controllers';
    public bool $has_traits = false;
    public string $traits = '';

    public bool $has_interfaces = false;
    public string $interfaces = '';

    public $listeners = [
        'modelName' => 'changeControllerName',
        'validation' => 'check'
    ];

    protected array $rules = [
        'controller_namespace' => 'required',
        'controller_parent_class' => 'required',
        'controller_name' => 'required',
        'controller_path' => 'required',
        'traits' => 'required_if:has_traits,true',
        'interfaces' => 'required_if:has_interfaces,true',
    ];

    public function check(): void
    {
        $this->validate();
        $this->emit('validated','controller');
    }


    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('gii::livewire.controller.create-controller-component');
    }

    public function changeControllerName($modelName): void
    {
        $this->controller_name = $modelName . 'Controller';
    }
}
