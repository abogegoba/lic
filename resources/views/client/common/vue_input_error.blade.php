<div v-if="{{ $target }}" v-for="errorMessage in {{ $target }}">
    <p class="invalid-message">
        @{{ errorMessage }}
    </p>
</div>