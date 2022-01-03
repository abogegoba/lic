<div class="pager" v-if="component.hasResults">
    <ul class="pager__list" v-if="component.currentPageIndex > 0">
        <li class="pager__item" v-if="component.isFirstPage">＜</li>
        <li class="pager__item disabled" v-else><a v-on:click="component.prev" href="#">＜</a></li>
        <template v-for="index in component.pageIndexes">
            <li v-if="index === component.currentPageIndex" class="pager__item active"><a href="javascript:void(0)">@{{ index }}</a></li>
            <li v-else-if="index !== 1 && index !== component.lastPageIndex && index !== component.currentPageIndex-1 && index !== component.currentPageIndex+1 && !(index-1 !== 1 && index-1 !== component.lastPageIndex && index-1 !== component.currentPageIndex-1 && index-1 !== component.currentPageIndex+1)" class="pager__item disabled">...</li>
            <li v-else-if="index !== 1 && index !== component.lastPageIndex && index !== component.currentPageIndex-1 && index !== component.currentPageIndex+1" class="pager__item disabled" style="display: none"></li>
            <li v-else class="pager__item"><a v-on:click="component.paging(index)" href="#">@{{ index }}</a></li>
        </template>
        <li class="pager__item" v-if="component.isLastPage">＞</li>
        <li class="pager__item disabled" v-else><a v-on:click="component.next" href="#">＞</a></li>
    </ul>
</div>