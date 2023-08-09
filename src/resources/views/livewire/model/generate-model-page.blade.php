<form action="{{ route('generate-model') }}" method="POST"
      xmlns:wire="http://www.w3.org/1999/xhtml">
    @csrf

    <div class="mt-3 model">
        <span class="h4 text-white bg-danger px-2 py-1 rounded">Model</span>
        @livewire('create-model')
    </div>

    <div class="controller mt-5">
        <span class="h4 text-white bg-danger px-2 py-1 rounded">
            Resource Controller for model
        </span>
        <span class="mt-2 form-check form-switch">
            <input class="form-check-input"
                   name="addResourceController"
                   type="checkbox"
                   role="switch"
                   wire:model="addResourceController"
                   wire:click="check"
                   id="addResourceController">
                <label class="form-check-label text-white" for="addResourceController">
                    Add resource controller
                </label>
                <input type="hidden" name="addResourceController" value="{{ $addResourceController }}">
        </span>
        @if($addResourceController)
            @livewire('create-controller')
        @endif
    </div>

    <div class="row">
        <div class="offset-sm-8 col-sm-4">
            <button type="button" wire:click="check" class="btn btn-info">Check form</button>
            @if($hasError)
                <button type="submit" class="btn btn-light" disabled>Generate model</button>
            @else
                <button type="submit" class="btn btn-success">Generate model</button>
            @endif
        </div>
    </div>

</form>
