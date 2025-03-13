@props([
    'name' => '',
    'id' => '',
    'label' => '',
    //'value' => '',
    'rows' => ''
])
{{-- El text area no tiene el atributo value como el input --}}
<style>
    textarea {
        resize: none;
    }
</style>

<div class="mb-2">
    <label for="{{$id}}" class="form-label">{{$label}}</label>
    <textarea class="form-control" name="{{$name}}" id="{{$id}}" rows="{{$rows}}"></textarea>
</div>