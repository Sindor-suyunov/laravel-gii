<div class="row mt-2">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="controller_namespace" class="form-label text-white">Controller
                        namespace</label>
                    <input type="text"
                           name="controller[namespace]"
                           class="form-control form-control-lg"
                           id="controller_namespace"
                           wire:model="controller_namespace"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                    @error('controller_namespace')<span
                        class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="controller_name" class="form-label text-white">Controller
                        name</label>
                    <input type="text"
                           name="controller[name]"
                           class="form-control form-control-lg"
                           id="controller_name"
                           wire:model="controller_name">
                    @error('controller_name')<span
                        class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="controller_path" class="form-label text-white">Controller
                        path</label>
                    <input type="text"
                           name="controller[path]"
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
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="controller_parent_class" class="form-label text-white">Controller
                        parent class</label>
                    <input type="text"
                           name="controller[parent_class]"
                           class="form-control form-control-lg"
                           id="controller_parent_class"
                           wire:model="controller_parent_class"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                           value="{{ $controller_parent_class }}">
                    @error('controller_parent_class')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @if($has_traits)
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="traits" class="form-label text-white">Controller traits (write with commas)</label>
                        <input type="text"
                               name="controller[traits]"
                               class="form-control form-control-lg"
                               id="traits"
                               wire:model="traits"
                               placeholder="\App\Traits\Trait1, ...">
                        @error('traits')<span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            @else
                <input type="hidden" name="controller[traits]" value="">
            @endif
            @if($has_interfaces)
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="interfaces" class="form-label text-white">Controller interfaces (write with commas)</label>
                        <input type="text"
                               name="controller[interfaces]"
                               class="form-control form-control-lg"
                               id="interfaces"
                               wire:model="interfaces"
                               placeholder="\App\Interfaces\Interface1, ...">
                        @error('interfaces')<span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            @else
                <input type="hidden" name="controller[interfaces]" value="">
            @endif
        </div>
    </div>
    <div class="col-sm-4 d-flex justify-content-around flex-column">
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="controller_overwrite_"
                   type="checkbox"
                   role="switch"
                   wire:model="controller_overwrite"
                   @checked($controller_overwrite)
                   id="controller_overwrite">
            <label class="form-check-label text-white" for="controller_overwrite">
                Overwrite resource controller if exists
            </label>
            <input type="hidden" name="controller[overwrite]" value="{{ $controller_overwrite }}">
        </div>

        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="is_generation_actions"
                   type="checkbox"
                   role="switch"
                   wire:model="is_generation_actions"
                   @checked($is_generation_actions)
                   id="is_generation_actions">
            <label class="form-check-label text-white" for="is_generation_actions">
                Generate actions
            </label>
            <input type="hidden" name="controller[is_generation_actions]" value="{{ $is_generation_actions }}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="has_traits"
                   type="checkbox"
                   role="switch"
                   wire:model="has_traits"
                   @checked($has_traits)
                   id="has_traits">
            <label class="form-check-label text-white" for="has_traits">
                Add traits
            </label>
            <input type="hidden" name="controller[has_traits]" value="{{ $has_traits }}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="has_interfaces"
                   type="checkbox"
                   role="switch"
                   wire:model="has_interfaces"
                   @checked($has_interfaces)
                   id="has_interfaces">
            <label class="form-check-label text-white" for="has_interfaces">
                Add interfaces
            </label>
            <input type="hidden" name="controller[has_interfaces]" value="{{ $has_interfaces }}">
        </div>
    </div>
</div>
