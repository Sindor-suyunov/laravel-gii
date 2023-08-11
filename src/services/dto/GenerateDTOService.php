<?php

namespace Sindor\LaravelGii\services\dto;

use Sindor\LaravelGii\DTOs\GenerateDTO;
use Sindor\LaravelGii\helpers\DTO;
use Sindor\LaravelGii\helpers\Universal;

class GenerateDTOService
{

    public function __construct(public GenerateDTO $data)
    {
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->namespace,
            'CLASS_NAME' => $this->data->name,
            'PARENT' => $this->getParent(),
            'PROPERTIES' => $this->getProperties(),
            'SAVE_MODEL' => $this->getSaveModel(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return Universal::getReadyContent(
            Universal::getStubPath('dto','dto'),
            $this->getStubVariables()
        );
    }

    public function generateDTO(): void
    {
        $path = Universal::makeFileWithDirectory($this->data->path, $this->data->name);
        Universal::putContent($path, $this->getContents(), $this->data->overwrite);
    }

    private function getProperties(): string
    {
        return DTO::getProperties($this->data->table_name);
    }

    private function getSaveModel(): string
    {
        if ($this->data->is_save_model)
            return DTO::getSaveModelFunction($this->data->table_name, '\\' . $this->data->model_namespace . '\\' . $this->data->model_name);
        return "";
    }

    private function getParent(): string
    {
        if ($this->data->parent_class)
            return " extends " . $this->data->parent_class;
        return "";
    }
}
