<indicator v-cloak>
    <div slot="field" slot-scope="component">
        <div class="loading-overlay">
            <div class="loading">
                <div class="loading-icon mb-5">
                    <img src="{{ asset('img/icon_loading.png') }}" alt="">
                </div>
                <span>@{{ component.label }}</span>
            </div>
        </div>
    </div>
</indicator>