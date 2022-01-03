/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
/**
 * Vueコンポーネント登録
 */
// 非同期検索
Vue.component('async-search', require('./components/AsyncSearch.vue').default);
// 項目追加
Vue.component('additional', require('./components/Additional.vue').default);
// インジケータ
Vue.component('indicator', require('./components/Indicator.vue').default);
// 例外
Vue.component('exception', require('./components/Exception.vue').default);
// ジョブチェック
Vue.component('job-check', require('./components/JobCheck.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * イベント管理用Vueインスタンス作成
 */
dispatcher = new Vue({
    data: {
        EVENT: {
            // 例外ハンドリング
            HANDLE_EXCEPTION: 'event-handle-exception',
            // インジケータ表示
            SHOW_INDICATOR: 'event-show-indicator',
            // インジケータ非表示
            HIDE_INDICATOR: 'event-hide-indicator',
            // インジケータキャンセル
            CANCEL_INDICATOR: 'event-cancel-indicator',
            // ジョブチェック：スタート
            JOB_CHECK_START: 'event-job-check-start',
            // ジョブチェック：エラー
            JOB_CHECK_ERROR: 'event-job-check-error',
            // ジョブチェック：成功
            JOB_CHECK_SUCCESS: 'event-job-check-success',
            // ジョブチェック：失敗
            JOB_CHECK_FAILED: 'event-job-check-failed'
        }
    }
});
