<?php

namespace Sindor\LaravelGii\services\model;

use Sindor\LaravelGii\DTOs\GenerateModelDTO;
use Sindor\LaravelGii\helpers\Model;
use Sindor\LaravelGii\helpers\Universal;

class GenerateModelService
{

    public function __construct(public GenerateModelDTO $data)
    {
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->namespace,
            'CLASS_NAME' => $this->data->name,
            'PARENT_CLASS' => $this->data->parent_class,
            'FILLABLE' => $this->getFillable(),
            'CASTS' => $this->getCasts(),
            'RELATIONS' => $this->getRelations(),
            'TRAITS' => $this->getTraits(),
            'INTERFACES' => $this->getInterfaces(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return Universal::getReadyContent(
            Universal::getStubPath('model','model'),
            $this->getStubVariables()
        );
    }

    public function generateModel(): void
    {
        $path = Universal::makeFileWithDirectory($this->data->path, $this->data->name);
        Universal::putContent($path, $this->getContents(), $this->data->overwrite);
    }

    private function getFillable(): string
    {
        if ($this->data->has_fillable) {
            return Model::generateFillableProperty($this->data->columns);
        }
        return "";
    }

    private function getCasts(): string
    {
        if ($this->data->has_casts) {
            return Model::generateCastsProperty($this->data->columns, $this->data->table_name);
        }
        return "";
    }

    private function getRelations(): string
    {
        if ($this->data->has_relations) {
            return Model::generateModelRelations($this->data->table_name);
        }
        return "";
    }

    private function getTraits(): string
    {
        if ($this->data->has_traits and $this->data->traits){
            return "\n\tuse " . $this->data->traits . ";\n";
        }
        return "";
    }

    private function getInterfaces(): string
    {
        if ($this->data->has_interfaces and $this->data->interfaces){
            return "implements " . $this->data->interfaces;
        }
        return "";
    }
}
