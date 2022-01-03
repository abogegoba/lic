<div class="d-sm-flex align-items-sm-end justify-content-sm-between">
    <div class="btn-row">
        <div class="btn-col btn-row-sm mb-sm-0">
            <button type="button" class="btn btn-lg btn-primary js-btn-link" data-href="{{route($createRoute)}}"
                    v-if="component.searched" v-bind:disabled="component.result.canCreate === false">
                <i class="fas fa-plus-circle icon icon-lg"></i>
                <span>新規登録する</span>
            </button>
            <button v-else type="button" class="btn btn-lg btn-primary js-btn-link" data-href="{{route($createRoute)}}"
                    {{$data->get("canCreate") ? "" :"disabled"}}>
                <i class="fas fa-plus-circle icon icon-lg"></i>
                <span>新規登録する</span>
            </button>
        </div>

        <div class="btn-col btn-row-sm mb-sm-0">
            <button type="button" class="btn btn-lg btn-primary js-btn-link" data-href="{{route($csvRoute)}}"
                    v-if="component.searched" v-bind:disabled="component.result.canSetCsv === false">
                <i class="fas fa-plus-circle icon icon-lg"></i>
                <span>一括登録する</span>
            </button>
            <button v-else type="button" class="btn btn-lg btn-primary js-btn-link" data-href="{{route($csvRoute)}}"
                    {{$data->get("canSetCsv") ? "" :"disabled"}}>
                <i class="fas fa-plus-circle icon icon-lg"></i>
                <span>一括登録する</span>
            </button>
        </div>
    </div>
</div>