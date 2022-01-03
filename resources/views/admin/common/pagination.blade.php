<nav v-if="list.hasResults">
    <ul v-if="list.currentPageIndex > 0" class="pagination justify-content-end">
        <li v-if="list.isFirstPage" class="page-item disabled">
            <a class="page-link" href="javascript:void(0)" aria-label="前へ" tabindex="-1">
                <span><i class="fas fa-angle-left icon"></i></span>
                <span class="sr-only">前へ</span>
            </a>
        </li>
        <li v-if="!list.isFirstPage" class="page-item">
            <a v-on:click="list.prev" class="page-link" href="javascript:void(0)" aria-label="前へ" tabindex="-1">
                <span><i class="fas fa-angle-left icon"></i></span>
                <span class="sr-only">前へ</span>
            </a>
        </li>
        <template v-for="index in list.pageIndexes">
            <li v-if="index == list.currentPageIndex" class="page-item active"><a class="page-link" href="javascript:void(0)">@{{ index }}</a></li>
            <li v-else-if="index == '...'" class="page-item disabled"><a class="page-link" href="javascript:void(0)" tabindex="-1">...</a></li>
            <li v-else class="page-item"><a v-on:click="list.paging(index)" class="page-link" href="javascript:void(0)">@{{ index }}</a></li>
        </template>
        <li v-if="list.isLastPage" class="page-item disabled">
            <a class="page-link" href="javascript:void(0)" aria-label="次へ">
                <span><i class="fas fa-angle-right icon"></i></span>
                <span class="sr-only">次へ</span>
            </a>
        </li>
        <li v-if="!list.isLastPage" class="page-item">
            <a v-on:click="list.next" class="page-link" href="javascript:void(0)" aria-label="次へ">
                <span><i class="fas fa-angle-right icon"></i></span>
                <span class="sr-only">次へ</span>
            </a>
        </li>
    </ul>
</nav>