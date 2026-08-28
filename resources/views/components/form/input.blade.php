@if ($type === 'hidden')
    <input type="hidden" id="{{ $id ?: $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
@else
    <div class="mb-3">
        @if ($label)
            <label for="{{ $id ?: $name }}" class="form-label">
                {{ $label }}
                @if ($required)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif

        <input 
            type="{{ $type }}" 
            class="form-control @error($name) is-invalid @enderror" 
            id="{{ $id ?: $name }}" 
            name="{{ $name }}" 
            @required($required) 
            value="{{ old($name, $value) }}" 
            @readonly($readonly)
        >

        @error($name)
            <div class="text-danger mt-1 d-flex align-items-center" style="font-size: 0.825rem; font-weight: 500;">
                <i class="bi bi-exclamation-circle-fill me-1"></i>
                <span>{{ $message }}</span>
            </div>
        @enderror
    </div>
@endif