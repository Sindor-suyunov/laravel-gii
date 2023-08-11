<?php

namespace Sindor\LaravelGii\livewire\dto;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateDTOComponent extends Component
{
    public bool $dto_overwrite = false;
    public bool $is_save_model = true;
    public string $dto_namespace = 'App\Http\DTOs';
    public string $dto_parent_class = '';
    public string $dto_name = '';
    public string $dto_path = 'app\Http\DTOs';

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('gii::livewire.dto.create-d-t-o-component');
    }
    public $listeners = [
        'modelName' => 'changeDTOName',
        'validation' => 'check'
    ];

    protected array $rules = [
        'dto_namespace' => 'required',
        'dto_name' => 'required',
        'dto_path' => 'required',
    ];

    public function check(): void
    {
        $this->validate();
        $this->emit('validated', 'dto');
    }

    public function changeDTOName($modelName): void
    {
        $this->dto_name = $modelName . 'DTO';
    }
}
