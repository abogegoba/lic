<div v-cloak v-if="{{$status}} == 409 && {{$exception}}" class="alert alert-error">
    <div v-for="(message, key) in {{$exception}}.messages">
        <i class="fas fa-info-circle icon"></i>
        @{{ message }}
    </div>
</div>