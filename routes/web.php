<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HTTPS強制
\URL::forceScheme('https');

if (env("APP_SITE") === "front") {

    // 企業掲載版（学生向けサイト）
    Route::group(['namespace' => 'Front'], function () {
        // 会員を登録する(基本情報入力）
        Route::get('/entry', 'MemberEntryController@indexOne')->name("front.member-entry.one");
        Route::get('/entry/revise', 'MemberEntryController@reviseOne')->name("front.member-entry.revise-one");
        Route::post('/entry', 'MemberEntryController@toNextPageOne')->name("front.member-entry.one-next");
        // 会員を登録する(現住所・連絡先入力）
        Route::get('/entry/2', 'MemberEntryController@indexTwo')->name("front.member-entry.two");
        Route::get('/entry/2/revise', 'MemberEntryController@reviseTwo')->name("front.member-entry.revise-two");
        Route::post('/entry/2', 'MemberEntryController@toNextPageTwo')->name("front.member-entry.two-next");
        // 会員を登録する(学校情報入力）
        Route::get('/entry/3', 'MemberEntryController@indexThree')->name("front.member-entry.three");
        Route::get('/entry/3/revise', 'MemberEntryController@reviseThree')->name("front.member-entry.revise-three");
        Route::post('/entry/3', 'MemberEntryController@toNextPageThree')->name("front.member-entry.three-next");
        // 会員を登録する(志望情報入力）
        Route::get('/entry/4', 'MemberEntryController@indexFour')->name("front.member-entry.four");
        Route::get('/entry/4/revise', 'MemberEntryController@reviseFour')->name("front.member-entry.revise-four");
        Route::post('/entry/4', 'MemberEntryController@toNextPageFour')->name("front.member-entry.four-next");
        // 会員を登録する(ID・パスワード入力）
        Route::get('/entry/5', 'MemberEntryController@indexFive')->name("front.member-entry.five");
        Route::get('/entry/5/revise', 'MemberEntryController@reviseFive')->name("front.member-entry.revise-five");
        Route::post('/entry/5', 'MemberEntryController@toConfirm')->name("front.member-entry.to-confirm");
        // 会員を登録する（確認）
        Route::get('/entry/confirm', 'MemberEntryController@confirm')->name("front.member-entry.confirm");
        Route::post('/entry/confirm', 'MemberEntryController@store')->name("front.member-entry.store");
        // 会員を登録する（受付）
        Route::get('/entry/reception', 'MemberEntryController@reception')->name("front.member-entry.reception");
        // 会員を登録する（完了）
        Route::get('/entry/complete', 'MemberEntryController@complete')->name("front.member-entry.complete");

        // 海外会員の登録（基本情報の入力）
        Route::get('/oversea-entry', 'OverseasMemberEntryController@IndexOne')->name("front.overseas-member-entry.one");
        Route::get('/oversea-entry/revise', 'OverseasMemberEntryController@ReviseOne')->name("front.overseas-member-entry.revise-one");
        Route::post('/oversea-entry', 'OverseasMemberEntryController@ToNextPageOne')->name("front.overseas-member-entry.one-next");
        // 会員を登録する(現住所・連絡先入力）
        Route::get('/oversea-entry/2', 'OverseasMemberEntryController@indexTwo')->name("front.overseas-member-entry.two");
        Route::get('/oversea-entry/2/revise', 'OverseasMemberEntryController@reviseTwo')->name("front.overseas-member-entry.revise-two");
        Route::post('/oversea-entry/2', 'OverseasMemberEntryController@toNextPageTwo')->name("front.overseas-member-entry.two-next");
        // 会員を登録する(学校情報入力）
        Route::get('/oversea-entry/3', 'OverseasMemberEntryController@indexThree')->name("front.overseas-member-entry.three");
        Route::get('/oversea-entry/3/revise', 'OverseasMemberEntryController@reviseThree')->name("front.overseas-member-entry.revise-three");
        Route::post('/oversea-entry/3', 'OverseasMemberEntryController@toNextPageThree')->name("front.overseas-member-entry.three-next");
        // 会員を登録する(志望情報入力）
        Route::get('/oversea-entry/4', 'OverseasMemberEntryController@indexFour')->name("front.overseas-member-entry.four");
        Route::get('/oversea-entry/4/revise', 'OverseasMemberEntryController@reviseFour')->name("front.overseas-member-entry.revise-four");
        Route::post('/oversea-entry/4', 'OverseasMemberEntryController@toNextPageFour')->name("front.overseas-member-entry.four-next");
        // 会員を登録する(ID・パスワード入力）
        Route::get('/oversea-entry/5', 'OverseasMemberEntryController@indexFive')->name("front.overseas-member-entry.five");
        Route::get('/oversea-entry/5/revise', 'OverseasMemberEntryController@reviseFive')->name("front.overseas-member-entry.revise-five");
        Route::post('/oversea-entry/5', 'OverseasMemberEntryController@toConfirm')->name("front.overseas-member-entry.to-confirm");
        // 会員を登録する（確認）
        Route::get('/oversea-entry/confirm', 'OverseasMemberEntryController@confirm')->name("front.overseas-member-entry.confirm");
        Route::post('/oversea-entry/confirm', 'OverseasMemberEntryController@store')->name("front.overseas-member-entry.store");
        // 会員を登録する（受付）
        Route::get('/oversea-entry/reception', 'OverseasMemberEntryController@reception')->name("front.overseas-member-entry.reception");
        // 会員を登録する（完了）
        Route::get('/oversea-entry/complete', 'OverseasMemberEntryController@complete')->name("front.overseas-member-entry.complete");

        // ログイン
        Route::get('/login', 'MemberLoginController@index')->name("front.member.login");
        Route::post('/login', 'MemberLoginController@login')->name("front.member.login.execute");
        // ログアウト
        Route::get('/logout', 'MemberLogoutController@logout')->name("front.member.logout");

        // ログイン状態で表示切替があるグループ（ヘッダー切り替え含む）
        Route::group(['middleware' => ['front.confirm_login']], function () {
            // 403
            Route::get('403/{key}', function (string $key) {
                $message = trans($key);
                if ($message == $key) {
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                } else {
                    throw new \ReLab\Commons\Exceptions\FatalBusinessException($key);
                }
            });

            // 404
            Route::get('404', function () {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            });

            // 500
            Route::get('500', function () {
                throw new \ReLab\Commons\Exceptions\FatalException("500");
            });

            // トップを表示する
            Route::get('/', 'TopController@index')->name("front.top");
            Route::post('/', 'TopController@search')->name("front.top.search");
            // お問合せ（入力）
            Route::get('/mypage/contact', 'ContactController@index')->name("front.contact");
            Route::get('/mypage/revise', 'ContactController@revise')->name("front.contact.revise");
            Route::post('/mypage/contact', 'ContactController@toConfirm')->name("front.contact.to-confirm");
            // お問合せ（確認）
            Route::get('/mypage/contact/confirm', 'ContactController@confirmIndex')->name("front.contact.confirm");
            Route::post('/mypage/contact/confirm', 'ContactController@execute')->name("front.contact.execute");
            // お問合せ（完了）
            Route::get('/mypage/contact/complete', 'ContactController@completeIndex')->name("front.contact.complete");

            /** ニュース */
            //ニュース一覧
            Route::get('news', function () {
                return view('front.news.index');
            })->name("front.news.list");
            //ニュース記事
            Route::get('news/1/detail', function () {
                return view('front.news.detail.20190827_01');
            })->name("front.news.detail_1");
            //ニュース記事_2
            Route::get('news/2/detail', function () {
                return view('front.news.detail.20190912_01');
            })->name("front.news.detail_2");
            //ニュース記事_3
            Route::get('news/3/detail', function () {
                return view('front.news.detail.20191024_01');
            })->name("front.news.detail_3");
            //ニュース記事_4
            Route::get('news/6/detail', function () {
                return view('front.news.detail.20200303_02');
            })->name("front.news.detail_4");
            //ニュース記事_5
            Route::get('news/5/detail', function () {
                return view('front.news.detail.20200303_01');
            })->name("front.news.detail_5");
            //ニュース記事_6
            Route::get('news/4/detail', function () {
                return view('front.news.detail.20200303_00');
            })->name("front.news.detail_6");
            // 東栄住宅ページ
            Route::get('lp/touei-housing-corporation')->name("front.lp.touei-housing-corporation");
            //サンプル記事
            Route::get('news/sample', function () {
                return view('front.news.detail.sample');
            })->name("front.news.sample");

            /** パートナー企業 */
            Route::get('partner', function () {
                return view('front.partner.partner');
            })->name('front.partner');

            /** 静的ページ */
            Route::get('company', function () {
                $url = 'https://in-fit.co.jp/';
                return Redirect::to($url);
            })->name("front.static.company");
            Route::get('about', function () {
                return view('front.static.about');
            })->name("front.static.about");
            Route::get('term', function () {
                return view('front.static.term');
            })->name("front.static.term");
            Route::get('describe', function () {
                return view('front.static.describe');
            })->name("front.static.describe");
            Route::get('use', function () {
                return view('front.static.use');
            })->name("front.static.use");
            Route::get('customer', function () {
                return view('front.static.customer');
            })->name("front.static.customer");
            Route::get('customer/customer1', function () {
                return view('front.static.customer1');
            })->name("front.static.customer1");
            Route::get('customer/customer2', function () {
                return view('front.static.customer2');
            })->name("front.static.customer2");
            Route::get('customer/customer3', function () {
                return view('front.static.customer3');
            })->name("front.static.customer3");
            Route::get('policy', function () {
                return view('front.static.policy');
            })->name("front.static.policy");
            Route::get('privacy', function () {
                return view('front.static.privacy');
            })->name("front.static.privacy");
            Route::get('personal', function () {
                return view('front.static.personal');
            })->name("front.static.personal");
            Route::get('select-entry', function () {
                return view('front.static.select_entry');
            })->name("front.static.select_entry");
        });

        // ログイン確認後のみ表示可能なグループ
        Route::group(['middleware' => ['front.authenticate']], function () {
            // 企業を検索する // TODO: 企業数が増えるまでの暫定対応
            Route::get('/company-search', 'CompanySearchController@index')->name("front.company.list");
            Route::get('/company-search/reload', 'CompanySearchController@reload')->name("front.company.list.reload");
            // 企業を参照する // TODO: 企業数が増えるまでの暫定対応
            Route::get('/company-search/{companyId}/detail', 'CompanyDetailController@index')->name("front.company.detail");
            // メッセージ一覧
            Route::get('/mypage/message/unread', 'MessageListController@unreadMessage')->name("front.message.unread_message_list");
            // メッセージ詳細
            Route::get('/mypage/message', 'MessageDetailController@index')->name("front.message.list");
            Route::get('/mypage/message/{userAccountId}/detail', 'MessageDetailController@index')->name("front.message.detail");
            // メッセージ送信
            Route::post('/mypage/message/delete_msg', 'MessageDetailController@deleteMessage')->name("front.message.delete-message");
            // メッセージ詳細（面接予約を依頼する）
            Route::get('/mypage/message/{userAccountId}/detail-request', 'MessageDetailController@index')->name("front.message.detail-request");
            // メッセージ送信
            Route::post('/mypage/message/{userAccountId}/detail', 'MessageDetailController@sendMessage')->name("front.message.send-message");
            // Web面接企業一覧（Web面接予約を一覧する・Web面接履歴を一覧する）
            Route::get('/mypage/video', 'VideoInterviewListController@index')->name("front.video-interview.list");
            // Web面接予約詳細を表示する
            Route::get('/mypage/video/{interviewAppointmentId}/reservation-detail', 'VideoInterviewReservationDetailController@index')->name("front.video-interview.reservation-detail");
            // Web面接予約をキャンセルする（確認）
            Route::get('/mypage/video/{interviewAppointmentId}/cancel', 'VideoInterviewCancelConfirmController@index')->name("front.video-interview.cancel-confirm");
            Route::post('/mypage/video/{interviewAppointmentId}/cancel', 'VideoInterviewCancelConfirmController@execute')->name("front.video-interview.cancel-execute");
            // Web面接に参加する
            Route::get('/mypage/video/{interviewAppointmentId}/room', 'VideoInterviewRoomController@index')->name("front.video-interview.room")->where('interviewAppointmentId', '^[0-9]+$');

            Route::group(['middleware' => ['nocache']], function () {
                // プロフィールを表示する
                Route::get('/mypage/profile', 'ProfileController@index')->name("front.profile");
                Route::get('/mypage/profile/preview', 'ProfileController@preview')->name("front.profile.preview");
                // プロフィールを変更する（個人情報）
                Route::get('/mypage/profile/personal', 'ProfilePersonalEditController@index')->name("front.profile.personal.edit");
                Route::post('/mypage/profile/personal', 'ProfilePersonalEditController@store')->name("front.profile.personal.edit.store");
                Route::post('/mypage/profile/overseas_personal', 'ProfilePersonalEditController@overseas_store')->name("front.profile.personal.edit.overseas_store");
                // プロフィールを変更する（現在住所・連絡先）
                Route::get('/mypage/profile/address', 'ProfileAddressEditController@index')->name("front.profile.address.edit");
                Route::post('/mypage/profile/address', 'ProfileAddressEditController@store')->name("front.profile.address.edit.store");
                Route::post('/mypage/profile/overseas_address', 'ProfileAddressEditController@overseas_store')->name("front.profile.address.edit.overseas_store");
                // プロフィールを変更する（学校情報）
                Route::get('/mypage/profile/school', 'ProfileSchoolEditController@index')->name("front.profile.school.edit");
                Route::post('/mypage/profile/school', 'ProfileSchoolEditController@store')->name("front.profile.school.edit.store");
                Route::post('/mypage/profile/overseas_school', 'ProfileSchoolEditController@overseas_store')->name("front.profile.school.edit.overseas_store");
                // プロフィールを変更する（写真・ハッシュタグ）
                Route::get('/mypage/profile/photo', 'ProfilePhotoEditController@index')->name("front.profile.photo.edit");
                Route::post('/mypage/profile/photo', 'ProfilePhotoEditController@update')->name("front.profile.photo.edit.update");
                // プロフィールを変更する（PR（動画アップロード含む））
                Route::get('/mypage/profile/pr', 'ProfilePREditController@index')->name("front.profile.pr.edit");
                Route::post('/mypage/profile/pr', 'ProfilePREditController@update')->name("front.profile.pr.edit.update");
                // プロフィールを変更する（自己紹介）
                Route::get('/mypage/profile/self-introduction', 'ProfileSelfIntroductionEditController@index')->name("front.profile.self-introduction.edit");
                Route::post('/mypage/profile/self-introduction', 'ProfileSelfIntroductionEditController@store')->name("front.profile.self-introduction.edit.store");
                // プロフィールを変更する（志望情報）
                Route::get('/mypage/profile/desired', 'ProfileDesiredEditController@index')->name("front.profile.desired.edit");
                Route::post('/mypage/profile/desired', 'ProfileDesiredEditController@store')->name("front.profile.desired.edit.store");
                // プロフィールを変更する（語学・資格）
                Route::get('/mypage/profile/language', 'ProfileLanguageEditController@index')->name("front.profile.language.edit");
                Route::post('/mypage/profile/language', 'ProfileLanguageEditController@store')->name("front.profile.language.edit.store");
                // プロフィールを変更する（経歴）
                Route::get('/mypage/profile/career', 'ProfileCareerEditController@index')->name("front.profile.career.edit");
                Route::post('/mypage/profile/career', 'ProfileCareerEditController@store')->name("front.profile.career.edit.store");
                // プロフィールを変更する（ID・パスワード）
                Route::get('/mypage/profile/id', 'ProfileIdAndPassEditController@index')->name("front.profile.id-and-pass.edit");
                Route::post('/mypage/profile/id', 'ProfileIdAndPassEditController@store')->name("front.profile.id-and-pass.edit.store");
            });
        });
    });

} elseif (env("APP_SITE") === "client") {

    // 学生掲載版（企業向けサイト）
    Route::group(['namespace' => 'Client'], function () {
        // ログイン
        Route::get('/login', 'ClientLoginController@index')->name("client.login");
        Route::post('/login', 'ClientLoginController@login')->name("client.login.execute");
        // ログアウト
        Route::get('/logout', 'ClientLogoutController@logout')->name("client.logout");

        // ログイン状態で表示切替があるグループ（ヘッダー切り替え含む）
        Route::group(['middleware' => ['client.confirm_login']], function () {
            // 403
            Route::get('403/{key}', function (string $key) {
                $message = trans($key);
                if ($message == $key) {
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                } else {
                    throw new \ReLab\Commons\Exceptions\FatalBusinessException($key);
                }
            });

            // 404
            Route::get('404', function () {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            });

            // 500
            Route::get('500', function () {
                throw new \ReLab\Commons\Exceptions\FatalException("500");
            });

            // トップを表示する
            Route::get('/', 'TopController@index')->name("client.top");
            // お問合せ（入力）
            Route::get('/mypage/contact', 'ContactController@index')->name("client.contact");
            Route::get('/mypage/revise', 'ContactController@revise')->name("client.contact.revise");
            Route::post('/mypage/contact', 'ContactController@toConfirm')->name("client.contact.to-confirm");
            // お問合せ（確認）
            Route::get('/mypage/contact/confirm', 'ContactController@confirmIndex')->name("client.contact.confirm");
            Route::post('/mypage/contact/confirm', 'ContactController@execute')->name("client.contact.execute");
            // お問合せ（完了）
            Route::get('/mypage/contact/complete', 'ContactController@completeIndex')->name("client.contact.complete");

            /** ニュース */
            //ニュース一覧
            Route::get('news', function () {
                return view('client.news.index');
            })->name("client.news.list");
            //ニュース記事
            Route::get('news/1/detail', function () {
                return view('client.news.detail.20190827_01');
            })->name("client.news.detail_1");
            //ニュース記事_2
            Route::get('news/2/detail', function () {
                return view('client.news.detail.20190912_01');
            })->name("client.news.detail_2");
            //ニュース記事_3
            Route::get('news/3/detail', function () {
                return view('client.news.detail.20191024_01');
            })->name("client.news.detail_3");
            //ニュース記事_4
            Route::get('news/6/detail', function () {
                return view('client.news.detail.20200303_02');
            })->name("client.news.detail_4");
            //ニュース記事_5
            Route::get('news/5/detail', function () {
                return view('client.news.detail.20200303_01');
            })->name("client.news.detail_5");
            //ニュース記事_6
            Route::get('news/4/detail', function () {
                return view('client.news.detail.20200303_00');
            })->name("client.news.detail_6");
            // 東栄住宅ページ
            Route::get('lp/touei-housing-corporation')->name("client.lp.touei-housing-corporation");
            //サンプル記事
            Route::get('news/sample', function () {
                return view('client.news.detail.sample');
            })->name("client.news.sample");

            /** パートナー企業 */
            Route::get('partner', function () {
                return view('client.partner.partner');
            })->name('client.partner');

            /** 静的ページ */
            Route::get('company', function () {
                $url = 'https://in-fit.co.jp/';
                return Redirect::to($url);
            })->name("client.static.company");
            Route::get('/term', function () {
                return view('client.static.term');
            })->name("client.static.term");
            Route::get('/use', function () {
                return view('client.static.use');
            })->name("client.static.use");
            Route::get('/policy', function () {
                return view('client.static.policy');
            })->name("client.static.policy");
            Route::get('privacy', function () {
                return view('client.static.privacy');
            })->name("client.static.privacy");
            Route::get('/personal', function () {
                return view('client.static.personal');
            })->name("client.static.personal");
        });

        Route::group(['middleware' => ['client.authenticate']], function () {
            Route::group(['middleware' => ['nocache']], function () {
                // 学生を検索する
                Route::get('/student-search', 'StudentSearchController@index')->name("client.student.list");
                Route::get('/student-search/reload', 'StudentSearchController@reload')->name("client.student.list.reload");
                // 学生を参照する
                Route::get('/student-search/{userAccountId}/detail', 'StudentDetailController@index')->name("client.student.detail");

                Route::post('/like-member', 'LikeMemberController@create')->name("client.like.member");
                Route::get('/like-member/list/{page?}', 'LikeMemberController@index')->name("client.like.member.list");
            });
            // メッセージ一覧
            Route::get('/mypage/message/unread', 'MessageListController@unreadMessage')->name("client.message.unread_message_list");
            // メッセージ詳細
            Route::get('/mypage/message', 'MessageDetailController@index')->name("client.message.list");
            Route::get('/mypage/message/{userAccountId}/detail', 'MessageDetailController@index')->name("client.message.detail");
            // メッセージ送信
            Route::post('/mypage/message/{userAccountId}/detail', 'MessageDetailController@sendMessage')->name("client.message.send-message");
            // メッセージ送信
            Route::post('/mypage/message/delete_msg', 'MessageDetailController@deleteMessage')->name("client.message.delete-message");
            // Web面接学生一覧（Web面接予約を一覧する・Web面接履歴を一覧する）
            Route::get('/mypage/video', 'VideoInterviewListController@index')->name("client.video-interview.list");
            // Web面接を予約登録する（入力）
            Route::get('/mypage/video/{userAccountId}/entry', 'VideoInterviewEntryController@index')->name("client.video-interview.entry");
            Route::get('/mypage/video/{userAccountId}/revise', 'VideoInterviewEntryController@revise')->name("client.video-interview.revise");
            Route::post('/mypage/video/{userAccountId}/entry', 'VideoInterviewEntryController@toConfirm')->name("client.video-interview.to-confirm");
            // Web面接を予約登録する（確認）
            Route::get('/mypage/video/{userAccountId}/confirm', 'VideoInterviewEntryController@confirmIndex')->name("client.video-interview.confirm");
            Route::post('/mypage/video/{userAccountId}/confirm', 'VideoInterviewEntryController@execute')->name("client.video-interview.execute");
            // Web面接予約詳細を表示する
            Route::get('/mypage/video/{interviewAppointmentId}/reservation-detail', 'VideoInterviewReservationDetailController@index')->name("client.video-interview.reservation-detail");
            // Web面接予約をキャンセルする（確認）
            Route::get('/mypage/video/{interviewAppointmentId}/cancel', 'VideoInterviewCancelConfirmController@index')->name("client.video-interview.cancel-confirm");
            Route::post('/mypage/video/{interviewAppointmentId}/cancel', 'VideoInterviewCancelConfirmController@execute')->name("client.video-interview.cancel-execute");
            // Web面接に参加する
            Route::get('/mypage/video/{interviewAppointmentId}/room', 'VideoInterviewRoomController@index')->name("client.video-interview.room")->where('interviewAppointmentId', '^[0-9]+$');
            // 企業情報を変更する
            Route::get('/company-edit', 'CompanyBasicInformationEditController@index')->name("client.company-edit.basic-information");
            Route::post('/company-edit', 'CompanyBasicInformationEditController@store')->name("client.company-edit.basic-information.store");
            Route::get('/company-edit/preview', 'CompanyBasicInformationEditController@preview')->name("client.company-edit.basic-information.preview");
            // 求人を一覧する
            Route::get('/company-edit/recruiting', 'CompanyRecruitingListController@index')->name("client.company-edit.recruiting.list");
            // 求人を登録する
            Route::get('/company-edit/recruiting/create', 'CompanyRecruitingCreateController@index')->name("client.company-edit.recruiting.create");
            Route::post('/company-edit/recruiting/create', 'CompanyRecruitingCreateController@create')->name("client.company-edit.recruiting.create.execute");
            // 求人を変更する
            Route::get('/company-edit/recruiting/edit', 'CompanyRecruitingEditController@index')->name("client.company-edit.recruiting.edit")->where('jobApplicationsId', '^[0-9]+$');
            Route::post('/company-edit/recruiting/edit', 'CompanyRecruitingEditController@edit')->name("client.company-edit.recruiting.edit.execute");
            // 求人を削除する
            Route::get('/company-edit/recruiting/{jobApplicationsId}/delete',
                'CompanyRecruitingDeleteController@index')->name("client.company-edit.recruiting.delete.confirm")->where('jobApplicationsId', '^[0-9]+$');
            Route::post('/company-edit/recruiting/{jobApplicationsId}/delete', 'CompanyRecruitingDeleteController@delete')->name("client.company-edit.recruiting.delete.execute");

            // CSVファイルを読み込む
            Route::get('/csv-import', 'MemberCsvImportController@import')->name("client.csv-import");
        });
    });

} elseif (env("APP_SITE") === "admin") {
    // 管理系
    Route::group(['namespace' => 'Admin'], function () {
        // ログイン
        Route::get('/', 'AdminLoginController@index')->name("admin.top");
        Route::post('/login', 'AdminLoginController@login')->name("admin.login");

        // 403
        Route::get('403/{key}', function (string $key) {
            $message = trans($key);
            if ($message == $key) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            } else {
                throw new \ReLab\Commons\Exceptions\FatalBusinessException($key);
            }
        });

        // 404
        Route::get('404', function () {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        });

        // 500
        Route::get('500', function () {
            throw new \ReLab\Commons\Exceptions\FatalException("500");
        });

        // ログイン確認後のみ表示可能なグループ
        Route::group(['middleware' => ['admin.authenticate']], function () {
            // ログアウト
            Route::get('/logout', 'AdminLogoutController@logout')->name("admin.logout");
            // 企業一覧
            Route::get('/company', 'CompanyListController@index')->name("admin.company.list");
            Route::get('/company/reload', 'CompanyListController@reload')->name("admin.company.reload");
            // 企業登録
            Route::get('/company/create','CompanyCreateController@index')->name('admin.company.create');
            Route::post('/company/create','CompanyCreateController@store');
            // 企業変更
            Route::get('/company/{companyId}/edit', 'CompanyEditController@index')->where('companyId', '^[0-9]+$')->name("admin.company.edit");
            Route::post('/company/{companyId}/edit', 'CompanyEditController@update')->where('companyId', '^[0-9]+$');
            Route::post('/company/{companyId}/deleteLogo', 'CompanyEditController@deleteLogo')->where('companyId', '^[0-9]+$')->name("admin.company.delete_logo");
            //求人一覧
            Route::get('/jobApplication','JobApplicationController@index')->name('admin.jobApplication.list');
            Route::get('/jobApplication/reload', 'JobApplicationController@reload')->name('admin.jobApplication.list.reload');
            // 求人削除
            Route::get('/jobApplication/{jobApplicationId}/delete', 'JobApplicationDeleteController@destroy')->where('jobApplicationId', '^[0-9]+$')->name('admin.jobApplication.delete');
            Route::post('/jobApplication/{jobApplicationId}/delete', 'JobApplicationDeleteController@destroy');
            // メッセージ一覧
            Route::get('/message', 'AdminMessageListController@index')->name('admin.message.list');
            Route::get('/message/reload', 'AdminMessageListController@reload')->name('admin.message.reload');
            // 会員一覧
            Route::get('/member', 'MemberListController@index')->name("admin.member.list");
            Route::get('/member/reload', 'MemberListController@reload')->name("admin.member.reload");
            // 会員登録
            Route::get('/member/create', 'MemberCreateController@index')->name("admin.member.create");
            Route::post('/member/create', 'MemberCreateController@store');
            // 会員変更
            Route::get('/member/{memberId}/edit', 'MemberEditController@index')->where('memberId', '^[0-9]+$')->name("admin.member.edit");
            Route::post('/member/{memberId}/edit', 'MemberEditController@update')->where('memberId', '^[0-9]+$');
            Route::post('/member/{memberId}/overseas_edit', 'MemberEditController@overseasUpdate')->where('memberId', '^[0-9]+$')->name("admin.member.overseas_edit");
            // 会員削除
            Route::post('member/{memberId}/delete', 'MemberDeleteController@destroy')->name("admin.member.delete");
            // 求人登録
            Route::get('/job-application/create', 'JobApplicationCreateController@index')->name('admin.job-application.create');
            Route::post('/job-application/create', 'JobApplicationCreateController@store');
            // 求人変更
            Route::get('/job-application/{jobApplicationId}/edit', 'JobApplicationEditController@index')->name('admin.job-application.edit');
            Route::post('/job-application/{jobApplicationId}/edit', 'JobApplicationEditController@update');
            // 求人変更(求人をプレビューする)
            Route::get('/job-application/{companyId}/preview', 'JobApplicationPreviewController@preview')->name('admin.job-application.preview');
            // 予約一覧
            Route::get('/interview-appointment', 'InterviewAppointmentListController@index')->name("admin.interview-appointment.list");
            Route::get('/interview-appointment/reload', 'InterviewAppointmentListController@reload')->name("admin.interview-appointment.reload");
            // 予約登録
            Route::get('/interview-appointment/create', 'InterviewAppointmentCreateController@index')->name('admin.interview-appointment.create');
            Route::post('/interview-appointment/create', 'InterviewAppointmentCreateController@store');
            // 予約詳細
            Route::get('/interview-appointment/{interviewAppointmentId}', 'InterviewAppointmentDetailController@show')->where('interviewAppointmentId', '^[0-9]+$')->name("admin.interview-appointment.detail");
            // 予約キャンセル
            Route::post('/interview-appointment/{interviewAppointmentId}/cancel', 'InterviewAppointmentCancelController@revoke')->where('interviewAppointmentId', '^[0-9]+$')->name("admin.interview-appointment.cancel");
            // ビデオ通話履歴一覧
            Route::get('/video', 'VideoInterviewListController@index')->name("admin.video-interview.list");
            Route::get('/video/reload', 'VideoInterviewListController@reload')->name("admin.video-interview.reload");
            // 企業別ビデオ通話履歴一覧
            Route::get('/video/company/{companyId}', 'VideoInterviewCompanyListController@index')->where('companyId', '^[0-9]+$')->name("admin.video-interview.company.list");
            Route::get('/video/company/{companyId}/reload', 'VideoInterviewCompanyListController@reload')->where('companyId', '^[0-9]+$')->name("admin.video-interview.company.reload");
            // 会員別ビデオ通話履歴一覧
            Route::get('/video/member/{memberId}', 'VideoInterviewMemberListController@index')->where('memberId', '^[0-9]+$')->name("admin.video-interview.member.list");
            Route::get('/video/member/{memberId}/reload', 'VideoInterviewMemberListController@reload')->where('memberId', '^[0-9]+$')->name("admin.video-interview.member.reload");
            // メッセージ詳細
            Route::get('/message/detail/{memberUserAccountId}/{companyUserAccountId}','AdminMessageDetailController@index')->where(['memberUserAccountId','companyUserAccountId'], '^[0-9]+$')->name('admin.message.detail');
            // メッセージステータス変更
            Route::post('/message/detail/{memberUserAccountId}/{companyUserAccountId}/{messageId}','AdminMessageDetailController@update')->where(['memberUserAccountId','companyUserAccountId','messageId'], '^[0-9]+$')->name('admin.message.status');
            // 例文一覧
            Route::get('/model-sentence','ModelSentenceListController@index')->name('admin.model-sentence.list');
            Route::get('/model-sentence/reload','ModelSentenceListController@reload')->name('admin.model-sentence.reload');
            // 例文作成
            Route::get('/model-sentence/create','ModelSentenceCreateController@index')->name('admin.model-sentence.create');
            Route::post('/model-sentence/create','ModelSentenceCreateController@store');
            // 例文変更
            Route::get('/model-sentence/{modelSentenceId}/edit','ModelSentenceEditController@index')->name('admin.model-sentence.edit');
            Route::post('/model-sentence/{modelSentenceId}/edit','ModelSentenceEditController@update');
            // 例文削除
            Route::post('/model-sentence/{modelSentenceId}/delete','ModelSentenceDeleteController@destroy')->name('admin.model-sentence.delete');
        });
    });
}
