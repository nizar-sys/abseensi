{{-- default alert group --}}
@if ($type === 'success')
    <div class="{{ $class }} alert alert-success" role="alert">
        <h4 class="alert-title">{{ $title }}</h4>
        <div class="text-muted">{{ $text }}</div>
    </div>
@elseif($type === 'error')
    <div class="{{ $class }} alert alert-danger" role="alert">
        <h4 class="alert-title">{{ $title }}</h4>
        <div class="text-muted">{{ $text }}</div>
    </div>
@elseif($type === 'info')
    <div class="{{ $class }} alert alert-info" role="alert">
        <h4 class="alert-title">{{ $title }}</h4>
        <div class="text-muted">{{ $text }}</div>
    </div>
@elseif($type === 'warning')
    <div class="{{ $class }} alert alert-warning" role="alert">
        <h4 class="alert-title">{{ $title }}</h4>
        <div class="text-muted">{{ $text }}</div>
    </div>

    {{-- dismissable alert group --}}
@elseif ($type === 'dismis-success')
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                <h4 class="alert-title">{{ $title }}</h4>
                <div class="text-muted">{{ $text }}</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@elseif ($type === 'dismis-error')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                <h4 class="alert-title">{{ $title }}</h4>
                <div class="text-muted">{{ $text }}</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@elseif ($type === 'dismis-info')
    <div class="alert alert-info alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                <h4 class="alert-title">{{ $title }}</h4>
                <div class="text-muted">{{ $text }}</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@elseif ($type === 'dismis-warning')
    <div class="alert alert-warning alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                <h4 class="alert-title">{{ $title }}</h4>
                <div class="text-muted">{{ $text }}</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
    {{-- important alert group --}}
@elseif ($type === 'important-success')
    <div class="alert alert-important alert-success alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                {{ $text }}
            </div>
        </div>
        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@elseif ($type === 'important-error')
    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                {{ $text }}
            </div>
        </div>
        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@elseif ($type === 'important-warning')
    <div class="alert alert-important alert-warning alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                {{ $text }}
            </div>
        </div>
        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@elseif ($type === 'important-info')
    <div class="alert alert-important alert-info alert-dismissible" role="alert">
        <div class="d-flex">
            <div>
                <x-icon type="{{ $icon }}" classicon="" />
            </div>
            <div>
                {{ $text }}
            </div>
        </div>
        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif
