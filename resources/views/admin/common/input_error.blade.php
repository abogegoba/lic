@if (!empty($errors) && !empty($target) && !empty($errors->get($target)))
    <div class="invalid-form">
        @foreach($errors->get($target) as $message)
            @if(is_array($message))
                @php
                    $message = array_unique($message)
                @endphp
                @foreach($message as $m)
                    <div class="invalid-feedback invalid-control">
                        <i class="fas fa-exclamation-triangle icon icon-lg"></i>
                        {{$m}}
                    </div>
                @endforeach
            @else
                <div class="invalid-feedback invalid-control">
                    <i class="fas fa-exclamation-triangle icon icon-lg"></i>
                    {{$message}}
                </div>
            @endif
        @endforeach
    </div>
@endif