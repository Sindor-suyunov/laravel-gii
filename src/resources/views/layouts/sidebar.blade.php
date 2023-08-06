@php
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    $is_model = in_array($currentRoute, ['create-model','create-models-same-namespace']);
@endphp
<div class="sidebar">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button @if($is_model) show @else collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#modelCollapse" @if($is_model) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="modelCollapse">
                    Model
                </button>
            </h2>
            <div id="modelCollapse" class="accordion-collapse collapse @if($is_model) show @endif accordion-item-dark" data-bs-parent="#accordionExample">
                <ul class="list-group list-group-flush list-group-item-dark">
                    <li class="list-group-item bg-dark active" aria-current="true">
                        <a href="{{ route('create-model') }}" class="text-white text-decoration-none">
                            Generate model
                        </a>
                    </li>
                    <li class="list-group-item bg-dark">
                        <a href="{{ route('create-models-same-namespace') }}" class="text-white text-decoration-none">
                            Generate many models (same namespace)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#controllerCollapse" aria-expanded="false" aria-controls="controllerCollapse">
                    <span>Controller</span> <span class="bg-danger text-white ms-auto px-2 rounded">development</span>
                </button>
            </h2>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#viewCollapse" aria-expanded="false" aria-controls="viewCollapse">
                    <span>View</span> <span class="bg-danger text-white ms-auto px-2 rounded">development</span>
                </button>
            </h2>
        </div>
    </div>
</div>
