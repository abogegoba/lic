<div v-if="{{ $target }}" v-for="errorMessage in {{ $target }}" class="invalid-message">
    <p class="invalid-message">
        @{{ errorMessage }}
    </p>
</div>