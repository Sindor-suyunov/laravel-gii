<?php

namespace Sindor\LaravelGii\livewire\model;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GenerateModelPage extends Component
{
    public bool $addResourceController = false;
    public bool $addRequest = false;
    public bool $addDTO = false;

    public bool $hasError = true;
    public array $has_errors = [
        'model' => true,
        'controller' => false,
        'request' => false,
        'dto' => false,
    ];

    public $listeners = ['validated' => 'validated'];

    public function check(): void
    {
        if ($this->addResourceController){
            $this->has_errors['controller'] = true;
        }if ($this->addRequest){
            $this->has_errors['request'] = true;
        }if ($this->addDTO){
            $this->has_errors['dto'] = true;
        }
        $this->emit('validation');
        $this->checkHasError();
    }

    public function validated($name): void
    {
        if (key_exists($name, $this->has_errors)) {
            $this->has_errors[$name] = false;
        }
        $this->checkHasError();
    }

    public function checkHasError(): void
    {
        if (in_array(true, $this->has_errors)) {
            $this->hasError = true;
        }else{
            $this->hasError = false;
        }
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('gii::livewire.model.generate-model-page');
    }
}
