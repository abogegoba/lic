<div class="pager" v-if="component.hasResults">
    <ul class="pager__list" v-if="component.currentPageIndex > 0">
        <li class="pager__item" v-if="!component.isFirstPage"><a v-on:click="component.prev" href="#">＜</a></li>
        <li class="pager__item disabled" v-else>＜</li>
        <li class="pager__item" v-if="!component.isLastPage"><a v-on:click="component.next" href="#">＞</a></li>
        <li class="pager__item disabled" v-else>＞</li>
    </ul>
</div>
