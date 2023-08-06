<?php

namespace Sindor\LaravelGii\services\model;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\DTOs\GenerateModelDTO;
use Sindor\LaravelGii\helpers\Generator;
use Sindor\LaravelGii\services\controller\GenerateResourceControllerService;

class GenerateModelService
{

    public function __construct(public GenerateModelDTO $data
    )
    {
    }

    private function createDirectory(): string
    {
        $path = str(base_path($this->data->model_path))->replace('\\', '/');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        return $path;
    }

    private function getStubPath(): string
    {
        return __DIR__ . "/../../stubs/model/model.stub";
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => str($this->data->model_namespace)->replace('/', '\\'),
            'CLASS_NAME' => $this->data->model_name,
            'FILLABLE' => $this->getFillable(),
            'CASTS' => $this->getCasts(),
            'RELATIONS' => $this->getRelations(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    private function getStubContents($stub, $stubVariables = []): array|bool|string
    {
        $contents = file_get_contents($stub);
        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }
        return $contents;
    }

    public function generateModel(): void
    {
        $path = $this->createDirectory() . "/" . $this->data->model_name . '.php';
        $contents = $this->getContents();

        if (!File::exists($path)) {
            File::put($path, $contents);
        }

        if ($this->data->add_resource_controller) {
            $service = new GenerateResourceControllerService(GenerateControllerDTO::fromModelDTO($this->data));
            $service->generateResourceController();
        }
    }

    private function getFillable(): string
    {
        if ($this->data->model_is_fillable) {
            return Generator::generateFillableProperty($this->data->columns);
        }
        return "";
    }

    private function getCasts(): string
    {
        if ($this->data->model_has_casts) {
            return Generator::generateCastsProperty($this->data->columns, $this->data->table_name);
        }
        return "";
    }

    private function getRelations(): string
    {
        if ($this->data->model_has_relations) {
            return Generator::generateModelRelations($this->data->table_schema, $this->data->table_name);
        }
        return "";
    }
}
