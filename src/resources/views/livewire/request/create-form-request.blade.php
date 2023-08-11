<div class="row mt-2">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="request_namespace" class="form-label text-white">
                        Request namespace
                    </label>
                    <input type="text"
                           name="request[namespace]"
                           class="form-control form-control-lg"
                           id="request_namespace"
                           wire:model="request_namespace"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                    @error('request_namespace')<span
                        class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="request_name" class="form-label text-white">
                        Request  name
                    </label>
                    <input type="text"
                           name="request[name]"
                           class="form-control form-control-lg"
                           id="request_name"
                           wire:model="request_name">
                    @error('request_name')<span
                        class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="request_path" class="form-label text-white">
                        Request path
                    </label>
                    <input type="text"
                           name="request[path]"
                           class="form-control form-control-lg"
                           id="request_path"
                           wire:model="request_path"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                           value="{{ $request_path }}">
                    @error('request_path')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="request_parent_class" class="form-label text-white">
                        Request parent class
                    </label>
                    <input type="text"
                           name="request[parent_class]"
                           class="form-control form-control-lg"
                           id="request_parent_class"
                           wire:model="request_parent_class"
                           pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                           readonly
                           value="{{ $request_parent_class }}">
                    @error('request_parent_class')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 d-flex justify-content-around flex-column">
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="request_overwrite_"
                   type="checkbox"
                   role="switch"
                   wire:model="request_overwrite"
                   @checked($request_overwrite)
                   id="request_overwrite">
            <label class="form-check-label text-white" for="request_overwrite">
                Overwrite request if exists
            </label>
            <input type="hidden" name="request[overwrite]" value="{{ $request_overwrite }}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="is_authorization"
                   type="checkbox"
                   role="switch"
                   wire:model="is_authorization"
                   @checked($request_overwrite)
                   id="is_authorization">
            <label class="form-check-label text-white" for="is_authorization">
                Authorization is true
            </label>
            <input type="hidden" name="request[is_authorization]" value="{{ $is_authorization }}">
        </div>

        <div class="form-check form-switch">
            <input class="form-check-input"
                   name="is_generation_validation"
                   type="checkbox"
                   role="switch"
                   wire:model="is_generation_validation"
                   @checked($is_generation_validation)
                   id="is_generation_validation">
            <label class="form-check-label text-white" for="is_generation_validation">
                Generate validation
            </label>
            <input type="hidden" name="request[is_generation_validation]" value="{{ $is_generation_validation }}">
        </div>
    </div>
</div>
