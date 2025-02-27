<style>
    .custom-placeholder::placeholder {
        color: black; /* Cambia esto al color que desees */
        opacity: 0.5; /* Para asegurar que el color se aplique correctamente en todos los navegadores */
    }
</style>

<div class="mb-2">
   
    <label for="{{$id}}" class="form-label">
        {{$label}}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input 
        type="{{$type}}" 
        class="form-control custom-placeholder" 
        id="{{$id}}" 
        name="{{$name}}" 
        @required($required) 
        value="{{old($name, $value)}}" 
        @readonly($readonly)
    >
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>