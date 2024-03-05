@if ($errors->any())
@foreach ($errors->all() as $e)
    <div class="error">
        {{ $e }}
    </div>
@endforeach
@endif