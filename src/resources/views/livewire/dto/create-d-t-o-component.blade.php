<div class="row mt-2">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="dto_namespace" class="form-label text-white">
                        DTO namespace
                    </label>
                    <input type="text"
                           name="dto[namespace]"
                           class="form-control form-control-lg"
                           id="dto_namespace"
                           wire:model="dto_namespace"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                    @error('dto_namespace')<span
                        class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="dto_name" class="form-label text-white">
                        DTO name
                    </label>
                    <input type="text"
                           name="dto[name]"
                           class="form-control form-control-lg"
                           id="dto_name"
                           wire:model="dto_name">
                    @error('dto_name')<span
                        class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="dto_path" class="form-label text-white">
                        DTO path
                    </label>
                    <input type="text"
                           name="dto[path]"
                           class="form-control form-control-lg"
                           id="dto_path"
                           wire:model="dto_path"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                           value="{{ $dto_path }}">
                    @error('dto_path')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="dto_parent_class" class="form-label text-white">
                        DTO parent class
                    </label>
                    <input type="text"
                           name="dto[parent_class]"
                           class="form-control form-control-lg"
                           id="dto_parent_class"
                           wire:model="dto_parent_class"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                           value="{{ $dto_parent_class }}">
                    @error('dto_parent_class')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 d-flex justify-content-around flex-column">
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="dto_overwrite_"
                   type="checkbox"
                   role="switch"
                   wire:model="dto_overwrite"
                   @checked($dto_overwrite)
                   id="dto_overwrite">
            <label class="form-check-label text-white" for="dto_overwrite">
                Overwrite DTO if exists
            </label>
            <input type="hidden" name="dto[overwrite]" value="{{ $dto_overwrite }}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="is_save_model"
                   type="checkbox"
                   role="switch"
                   wire:model="is_save_model"
                   @checked($is_save_model)
                   id="is_save_model">
            <label class="form-check-label text-white" for="is_save_model">
                Generate save model method
            </label>
            <input type="hidden" name="dto[is_save_model]" value="{{ $is_save_model }}">
        </div>
    </div>
</div>
