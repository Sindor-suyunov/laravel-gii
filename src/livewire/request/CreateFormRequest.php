<?php

namespace Sindor\LaravelGii\livewire\request;

use Livewire\Component;

class CreateFormRequest extends Component
{
    public bool $request_overwrite = false;
    public bool $is_generation_validation = true;
    public bool $is_authorization = true;
    public string $request_namespace = 'App\Http\Requests';
    public string $request_parent_class = '\Illuminate\Foundation\Http\FormRequest';
    public string $request_name = '';
    public string $request_path = 'app\Http\Requests';

    public $listeners = [
        'modelName' => 'changeRequestName',
        'validation' => 'check'
    ];

    protected array $rules = [
        'request_namespace' => 'required',
        'request_parent_class' => 'required',
        'request_name' => 'required',
        'request_path' => 'required',
    ];

    public function check(): void
    {
        $this->validate();
        $this->emit('validated', 'request');
    }

    public function changeRequestName($modelName): void
    {
        $this->request_name = $modelName . 'FormRequest';
    }

    public function render()
    {
        return view('gii::livewire.request.create-form-request');
    }
}
