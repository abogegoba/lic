<?php

namespace App\Providers;

use App\Adapters\Gateways\Criteria\AdminMessageListSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\BusinessTypeSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\CompanySearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\CompanyUploadedFileSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\DefaultSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\InterviewAppointmentListSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\InterviewAppointmentSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\JobApplicationSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\JobTypeSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\MemberSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\MessageDetailSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\MessageSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\ModelSentenceListSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\PrefectureSearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\VideoCallHistorySearchDoctrineCriteria;
use App\Adapters\Gateways\Criteria\VideoCallHistoryListSearchDoctrineCriteria;
use App\Business\Interfaces\Gateways\Criteria\AdminMessageListSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\BusinessTypeSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\CompanySearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\CompanyUploadedFileSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\DefaultSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\GeneralCriteria;
use App\Business\Interfaces\Gateways\Criteria\InterviewAppointmentListSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\InterviewAppointmentSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\JobApplicationSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\JobTypeSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\MemberSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\MessageDetailSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\MessageSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\ModelSentenceListSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\PrefectureSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\VideoCallHistorySearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\VideoCallHistoryListSearchCriteria;
use Illuminate\Support\ServiceProvider;
use ReLab\Doctrine\Criteria\GeneralDoctrineCriteria;

class CriteriaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // ??????
        $this->app->bind(
            GeneralCriteria::class,
            GeneralDoctrineCriteria::class
        );
        // ??????
        $this->app->bind(
            DefaultSearchCriteria::class,
            DefaultSearchDoctrineCriteria::class
        );
        // ????????????
        $this->app->bind(
            PrefectureSearchCriteria::class,
            PrefectureSearchDoctrineCriteria::class
        );
        // ??????
        $this->app->bind(
            JobTypeSearchCriteria::class,
            JobTypeSearchDoctrineCriteria::class
        );
        // ??????
        $this->app->bind(
            BusinessTypeSearchCriteria::class,
            BusinessTypeSearchDoctrineCriteria::class
        );
        // ???????????????
        $this->app->bind(
            MessageSearchCriteria::class,
            MessageSearchDoctrineCriteria::class
        );
        // ?????????????????????
        $this->app->bind(
            MessageDetailSearchCriteria::class,
            MessageDetailSearchDoctrineCriteria::class
        );
        // ????????????????????????????????????
        $this->app->bind(
            CompanyUploadedFileSearchCriteria::class,
            CompanyUploadedFileSearchDoctrineCriteria::class
        );
        // ??????
        $this->app->bind(
            CompanySearchCriteria::class,
            CompanySearchDoctrineCriteria::class
        );
        // ????????????
        $this->app->bind(
            InterviewAppointmentSearchCriteria::class,
            InterviewAppointmentSearchDoctrineCriteria::class
        );
        // ?????????????????????
        $this->app->bind(
            VideoCallHistorySearchCriteria::class,
            VideoCallHistorySearchDoctrineCriteria::class
        );
        // ???????????????????????????
        $this->app->bind(
            VideoCallHistoryListSearchCriteria::class,
            VideoCallHistoryListSearchDoctrineCriteria::class
        );
        // ??????
        $this->app->bind(
            MemberSearchCriteria::class,
            MemberSearchDoctrineCriteria::class
        );
        // ??????????????????
        $this->app->bind(
            InterviewAppointmentListSearchCriteria::class,
            InterviewAppointmentListSearchDoctrineCriteria::class
        );
        // ????????????
        $this->app->bind(
            JobApplicationSearchCriteria::class,
            JobApplicationSearchDoctrineCriteria::class
        );

        // ?????????????????????
        $this->app->bind(
            AdminMessageListSearchCriteria::class,
            AdminMessageListSearchDoctrineCriteria::class
        );

        // ????????????
        $this->app->bind(
            ModelSentenceListSearchCriteria::class,
            ModelSentenceListSearchDoctrineCriteria::class
        );
    }
}
