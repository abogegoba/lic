<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if (env("APP_SITE") === "front") {
    // 企業掲載版（学生向けサイト）グループ
    Route::group(['namespace' => 'Front'], function () {
        // ログイン状態で表示切替があるグループ（ヘッダー切り替え含む）
        Route::group(['middleware' => ['front.confirm_login']], function () {
            // 企業検索
            Route::get('/company-search/list.json', 'CompanySearchController@search')->name("front.company.search");
        });

        // ログイン確認後のみ表示可能なグループ
        Route::group(['middleware' => ['front.authenticate']], function () {
            // メッセージ送信
            Route::post('/message/detail.json', 'MessageDetailController@sendMessage')->name("front.message.send-message");
            // プロフィール（写真・タグ）変更
            Route::post('/mypage/profile/photo.json', 'ProfilePhotoEditController@store')->name("front.profile.photo.edit.store");
            Route::post('/mypage/profile/pr/upload-video.json', 'ProfilePREditController@uploadVideo')->name("front.profile.pr.edit.upload-video");

            // Web面接開始
            Route::post('/mypage/video/{interviewAppointmentId}/start.json', 'VideoInterviewRoomController@startVideo')->name("front.video-interview.start")->where('interviewAppointmentId',
                '^[0-9]+$');
            // Web面接終了
            Route::post('/mypage/video/history/{videoCallHistoryId}/end.json', 'VideoInterviewRoomController@endVideo')->name("front.video-interview.end")->where('videoCallHistoryId', '^[0-9]+$');
        });
        Route::post('/mypage/profile/photo/upload-photo.json', 'ProfilePhotoEditController@uploadPhoto')->name("front.profile.photo.edit.upload-photo");
    });

} elseif (env("APP_SITE") === "client") {
    // 学生掲載版（企業向けサイト）グループ
    Route::group(['namespace' => 'Client'], function () {
        // ログイン状態で表示切替があるグループ（ヘッダー切り替え含む）
        Route::group(['middleware' => ['client.confirm_login']], function () {
            // 学生検索
            Route::get('/student-search/list.json', 'StudentSearchController@search')->name("client.student.search");
            Route::get('/student-search/overseas_list.json', 'StudentSearchController@overseas_search')->name("client.overseas.student.search");
        });

        // ログイン確認後のみ表示可能なグループ
        Route::group(['middleware' => ['client.authenticate']], function () {
            // メッセージ送信
            Route::post('/message/detail.json', 'MessageDetailController@sendMessage')->name("client.message.send-message");
            // 企業情報を変更する　画像・動画アップロード
            Route::post('/company-edit/upload.json', 'CompanyBasicInformationEditController@upload')->name("client.company-edit.basic-information.upload");
        });
    });

} elseif (env("APP_SITE") === "admin") {
    // 管理系グループ
    Route::group(['namespace' => 'Admin'], function () {
        // ログイン確認後のみ表示可能なグループ
        Route::group(['middleware' => ['admin.authenticate']], function () {
            // 画像・動画アップロード
            Route::post('/file/upload.json', 'FileUploadController@upload')->name("admin.upload");
            // 企業検索
            Route::get('/company/list.json', 'CompanyListController@search')->name("admin.company.search");
            //求人検索
            Route::get('/jobApplication/reload/list.json','JobApplicationController@search')->name('admin.jobApplication.search');
            //メッセージ検索
            Route::get('/message/reload/list.json','AdminMessageListController@search')->name('admin.message.search');
            // 会員検索
            Route::get('/member/list.json', 'MemberListController@search')->name("admin.member.search");
            // 予約検索
            Route::get('/interview-appointment/list.json', 'InterviewAppointmentListController@search')->name("admin.interview-appointment.search");
            // ビデオ通話履歴一覧
            Route::get('/video-interview/list.json','VideoInterviewListController@search')->name('admin.video-interview.search');
            // 企業別ビデオ通話一覧
            Route::get('/video-interview/company/list.json','VideoInterviewCompanyListController@search')->name('admin.video-interview.company.search');
            // 会員別ビデオ通話一覧
            Route::get('/video-interview/member/list.json','VideoInterviewMemberListController@search')->name('admin.video-interview.member.search');
            // 例文検索
            Route::get('/model-sentence/list.json','ModelSentenceListController@search')->name('admin.model-sentence.search');
        });
    });
}
