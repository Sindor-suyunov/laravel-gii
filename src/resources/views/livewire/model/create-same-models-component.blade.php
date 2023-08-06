@php use Sindor\LaravelGii\helpers\Data; @endphp
<form wire:submit="check" action="{{ route('generate-models-same-namespace') }}" method="POST"
      xmlns:wire="http://www.w3.org/1999/xhtml">
    @csrf
    <div class="row">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="model_namespace" class="form-label text-white">Model namespace</label>
                        <input type="text"
                               name="model_namespace"
                               class="form-control form-control-lg"
                               id="model_namespace"
                               wire:model="model_namespace"
                               pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                        @error('model_namespace')<span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="model_path" class="form-label text-white">Model path</label>
                        <input type="text"
                               name="model_path"
                               class="form-control form-control-lg"
                               id="model_path"
                               wire:model="model_path"
                               pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                        @error('model_path')<span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="mb-3">
                        <label for="table" class="form-label text-white">Select multiple tables for models (models' name will be automatically generated)</label>
                        <select wire:model="table_names"
                                name="table_names"
                                id="table"
                                class="form-select form-select-lg" multiple>
                            @if($tableNames = Data::getAllTableNames())
                                <option selected disabled>-- select --</option>
                                @foreach($tableNames as $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            @else
                                <option disabled>no tables</option>
                            @endif
                        </select>
                        <input type="hidden" name="tables" value="{{ collect($table_names) }}">
                        @error('table_names')<span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="row properties">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               name="model_create_fillable"
                               type="checkbox"
                               role="switch"
                               wire:model="model_create_fillable"
                               @checked($model_create_fillable)
                               id="model_create_fillable">
                        <label class="form-check-label text-white" for="model_create_fillable">Add <span
                                class="bg-light text-black px-2 py-1">$fillable</span> property</label>
                        <input type="hidden" name="model_is_fillable" value="{{ $model_create_fillable }}">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               name="model_create_casts"
                               type="checkbox"
                               wire:model="model_create_casts"
                               role="switch"
                               @checked($model_create_casts)
                               id="model_create_casts">
                        <label class="form-check-label text-white" for="model_create_casts">
                            Add
                            <span class="bg-light text-black px-2 py-1">$casts</span>
                            property
                        </label>
                        <input type="hidden" name="model_has_casts" value="{{ $model_create_casts }}">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               name="model_create_relations"
                               type="checkbox"
                               role="switch"
                               wire:model="model_create_relations"
                               @checked($model_create_relations)
                               id="model_create_relations">
                        <label class="form-check-label text-white" for="model_create_relations">Add relational methods if
                            has</label>
                        <input type="hidden" name="model_has_relations" value="{{ $model_create_relations }}">
                    </div>
                </div>
            </div>
            <div class="row controller">
                <div class="col-sm-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               name="add_resource_controller"
                               type="checkbox"
                               role="switch"
                               wire:model="add_resource_controller"
                               @checked($add_resource_controller)
                               id="add_resource_controller">
                        <label class="form-check-label text-white" for="add_resource_controller">
                            Add resource controller
                        </label>
                        <input type="hidden" name="add_resource_controller" value="{{ $add_resource_controller }}">
                    </div>
                </div>
                @if($add_resource_controller)
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <label for="controller_namespace" class="form-label text-white">Controllers' namespace (controllers' name will be automatically generated)</label>
                            <input type="text"
                                   name="controller_namespace"
                                   class="form-control form-control-lg"
                                   id="controller_namespace"
                                   wire:model="controller_namespace"
                                   pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                            @error('controller_namespace')<span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="controller_path" class="form-label text-white">Controllers' path</label>
                            <input type="text"
                                   name="controller_path"
                                   class="form-control form-control-lg"
                                   id="controller_path"
                                   wire:model="controller_path"
                                   pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                                   value="{{ $controller_path }}">
                            @error('controller_path')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>
            <div class="row mt-3">
                <div class="mb-3">
                    <button type="button" wire:click="check" class="btn btn-info">Check form</button>
                    @if($hasError)
                        <button type="submit" class="btn btn-light" disabled>Generate model</button>
                    @else
                        <button type="submit" class="btn btn-success">Generate model</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
