@if (!empty($errors) && !empty($targets))
<p class="invalid-message">

@foreach($targets as $target)
    @if(!empty($errors->get($target)))
        @foreach($errors->get($target) as $message)
            @if(is_array($message))
                @php
                    $messages = array_unique($message)
                @endphp
                @foreach($messages as $message)
                    {{$message}}<br>
                @endforeach
            @else
                {{$message}}<br>
            @endif
        @endforeach
    @endif
@endforeach
</p>
@endif
