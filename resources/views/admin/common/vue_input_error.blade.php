<div v-if="{{ $target }}" v-for="message in {{ $target }}"
     class="invalid-feedback invalid-control">
    <i class="fas fa-exclamation-triangle icon icon-lg"></i>
    @{{ message }}
</div>