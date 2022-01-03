@extends('front.common.root')

@section('title','Web面接予約一覧│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common_custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script src="{{asset('js/mypage/video/list.js')}}"></script>
    <script>
        $(function () {
            @if(session('success') === 'cancel')
            $('#cancel-complete').show();
            setTimeout(function () {
                $('#cancel-complete').fadeOut(1500);
            }, 2000);
            @else
            $('#cancel-complete').remove();
            @endif
        });

        $(function () {
            @if(session('success') === 'create')
            $('#create-complete').show();
            setTimeout(function () {
                $('#create-complete').fadeOut(1500);
            }, 2000);
            @else
            $('#create-complete').remove();
            @endif
        });
    </script>
@stop

@section('vue')
    <script src="{{asset('js/mypage/video/calendar_vue.js')}}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>Web面接予約カレンダー</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('front.common.mypage_menu')
    {{--<div class="main__content video-container">
        <div class="alert" id="cancel-complete" hidden>Web面接をキャンセルしました</div>--}}

    <div class="main__content video-container">
        <div class="alert" id="create-complete" hidden>Web面接を登録しました</div>

        <section class="switchTab switchTab--video">
            <h2 class="main__content__headline js-headline">Web面接予約カレンダー</h2>
            <ul>
                <li class="js-reservation-select cursor-pointer"><a>予約</a></li>
                <li class="js-history-select cursor-pointer"><a>履歴</a></li>
            </ul>
        </section>
        <div class="js-reservation" id="reservation" data-data="{{json_encode($data->get('formattedInterviewAppointmentList'))}}">
            <template>
                <template v-if="Object.keys(formattedInterviewAppointmentList).length > 0">
                    <div class="calendar-title">
                        <div class="calendar-title__year-list">
                            <span class="year-list--icon  btn-monthMove prev fa fa-2x fa-chevron-circle-left" @click="prevYear"></span>
                            @{{currentYear+"年"}}
                            <span class="year-list--icon btn-monthMove next fa fa-2x fa-chevron-circle-right" @click="nextYear"></span>
                        </div>
                        <div class="calendar-title__month-list">
                            <div v-for="month in months" @click="moveMonth(month)" :class="checkSelectedMonth(month)">@{{month+"月"}}</div>
                        </div>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-body__item">
                            <div v-for="day in weeks" class="day weeks">@{{day}}</div>
                        </div>
                        <div class="calendar-body__item">
                            <div v-for="(day, index) in calendarMake" class="item__day" @click="moveDay(day.value)">
                                <p><span class="day" :class="checkToday(day.thisMonth, day.value)">@{{day.value}}</span></p>
                                <template v-if="getPlansAppointmentList(day.value).length > 0">
                                    <div class="plan-grp" v-for="(appointment, i) in getPlansAppointmentList(day.value)">
                                        <div>
                                            <template v-if="day.thisMonth === currentMonth && (i+1) <= 2">
                                                <span class="plan pc-show" :class="{'plan--cancel': (appointment.status === 20), 'plan--done': (appointment.status === 30)}" @click="toggleModal(appointment.id, true)">@{{appointment.appointmentTime}}　@{{appointment.companyName}}</span>
                                                <span class="plan sp-show" :class="{'plan--cancel': (appointment.status === 20), 'plan--done': (appointment.status === 30)}"></span>
                                            </template>
                                        </div>
                                        <template v-if="day.thisMonth === currentMonth">
                                            <div class="plan-modal" :class="{'active' : (selectedCompanyId === appointment.id && isOpen) }">
                                                <button class="plan-modal__close" @click="toggleModal(appointment.id, false)"><img src="{{asset('img/mypage/video/times-solid.png')}}"></button>
                                                <div class="plan-modal__contents">
                                                    <p :data-href="appointment.companyDetailUrl" class="plan-modal__name js-link-area cursor-pointer"><img class="ico" src="{{asset('img/mypage/video/user-regular.svg')}}">@{{appointment.companyName}}</p>
                                                    <ul class="plan-modal__list">
                                                        <li><img class="ico" src="{{asset('img/mypage/video/clock-regular.svg')}}">@{{day.thisMonth}}/@{{day.value}}(<span :class="checkSelectedWeek(day.thisWeek)">@{{weeks[day.thisWeek]}}</span>) @{{appointment.appointmentTime}}〜</li>
                                                    </ul>
                                                    <div class="plan-modal__more-grp">
                                                        <template>
                                                            <p v-if="appointment.status === 10" class="button js-link-area cursor-pointer" :data-href="appointment.videoInterviewReservationDetailUrl">Web面接詳細へ</p>
                                                            <p v-if="appointment.status === 10" class="button button--cancel js-link-area cursor-pointer" :data-href="appointment.videoInterviewCancelUrl">Web面接キャンセル</p>
                                                            <p v-else class="button button--done cursor-pointer">@{{appointment.status === 20 ? "Web面接キャンセル済" : "面接実施済"}}</p>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template v-if="day.thisMonth === currentMonth">
                                    <template v-if="getPlansMoreNum(day.value) > 2">
                                        <p @click="toggleMore(day.value, true)" class="more-links pc-show">他@{{getPlansMoreNum(day.value) -2}}件</p>
                                        <p class="more-links sp-show">+</p>
                                    </template>
                                    <div class="plan-modal plan-modal--more" :class="{'active' : (selectDay === day.value && isMore) }">
                                        <span class="plan-modal--more__days">@{{day.thisMonth}}/@{{day.value}} (<span :class="checkSelectedWeek(day.thisWeek)">@{{weeks[day.thisWeek]}}</span>)</span>
                                        <button class="plan-modal__close" @click="toggleMore(day.value, false)"><img src="{{asset('img/mypage/video/times-solid.png')}}"></button>
                                        <div class="plan-modal__contents">
                                            <template v-if="getPlansAppointmentList(day.value).length > 0">
                                                <div v-for="appointment in getPlansAppointmentList(day.value)">
                                                    <template v-if="day.thisMonth === currentMonth">
                                                        <span class="plan" :class="{'plan--cancel': (appointment.status === 20), 'plan--done': (appointment.status === 30)}" @click="toggleModal(appointment.id, true)">@{{appointment.appointmentTime}}　@{{appointment.companyName}}</span>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-sp-plans">
                        <template>
                            <div v-for="(appointment, i) in getPlansAppointmentList(currentDate)">
                                <div v-if="i == 0" class="calendar-sp-plans__day">
                                    <p><span :class="checkSelectedWeek(appointment.appointmentDate)">@{{weeks[appointment.appointmentDate]}}</span></p>
                                    <p>@{{appointment.appointmentDay}}</p>
                                </div>
                                <div class="plan-modal" :class="{'active' : (currentDate == appointment.appointmentDay) }">
                                    <button class="plan-modal__close" @click="toggleModal(appointment.id, false)"><img src="{{asset('img/mypage/video/times-solid.png')}}"></button>
                                    <div class="plan-modal__contents">
                                        <p :data-href="appointment.companyDetailUrl" class="plan-modal__name js-link-area cursor-pointer"><img class="ico" src="{{asset('img/mypage/video/user-regular.svg')}}">@{{appointment.companyName}}</p>
                                        <ul class="plan-modal__list">
                                            <li><img class="ico" src="{{asset('img/mypage/video/clock-regular.svg')}}">@{{appointment.appointmentMonth}}/@{{appointment.appointmentDay}}(<span :class="checkSelectedWeek(appointment.appointmentDate)">@{{weeks[appointment.appointmentDate]}}</span>) @{{appointment.appointmentTime}}〜</li>
                                        </ul>
                                        <div class="plan-modal__more-grp">
                                            <template>
                                                <p v-if="appointment.status === 10" class="button js-link-area cursor-pointer" :data-href="appointment.videoInterviewReservationDetailUrl">Web面接詳細へ</p>
                                                <p v-if="appointment.status === 10" class="button button--cancel js-link-area cursor-pointer" :data-href="appointment.videoInterviewCancelUrl">Web面接キャンセル</p>
                                                <p v-else class="button button--done cursor-pointer">@{{appointment.status === 20 ? "Web面接キャンセル済" : "面接実施済"}}</p>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
                <div v-else class="alert alert-light no-data" role="alert">
                    現在データはございません
                </div>
            </template>
        </div>

        <div class="js-history" id="history" data-data="{{json_encode($data->get('formattedVideoCallHistoryList'))}}">
            <template>
                <template v-if="Object.keys(formattedVideoCallHistoryList).length > 0">
                    <div class="calendar-title">
                        <div class="calendar-title__year-list">
                            <span class="year-list--icon btn-monthMove prev fa fa-2x fa-chevron-circle-left" @click="prevYear"></span>
                            @{{currentYear+"年"}}
                            <span class="year-list--icon btn-monthMove next fa fa-2x fa-chevron-circle-right" @click="nextYear"></span>
                        </div>
                        <div class="calendar-title__month-list">
                            <div v-for="month in months" @click="moveMonth(month)" :class="checkSelectedMonth(month)">@{{month+"月"}}</div>
                        </div>
                    </div>
                    <p v-if="getHistoryList().length <= 0" class="no-count">面接履歴はありません。</p>
                    <div class="reservation__column">
                        <template v-for="(history, index) in getHistoryList()">
                            <div class="reservation__grp" :class="{'active' : (isAcc && history.day == currentDate)}">
                                <template v-for="(item, i) in history.list">
                                    <section class="reservation__list">
                                        <h3 v-if="i == 0" @click="toggleAccordion(item.startDay)" class="reservation__title">@{{item.startYear}}年@{{item.startMonth}}月@{{item.startDay}}日(<span :class="checkSelectedWeek(item.startDate)">@{{weeks[item.startDate]}}</span>)</h3>
                                        <dl class="basic">
                                            <dt>
                                                <div :data-href="item.companyDetailUrl" class="js-link-area cursor-pointer">@{{item.companyName}}</div>
                                            </dt>
                                            <dd>
                                                <div>@{{item.startTime}}</div>
                                                <p>面接実施済</p>
                                            </dd>
                                        </dl>
                                    </section>
                                </template>
                            </div>
                        </template>
                    </div>
                </template>
                <div v-else class="alert alert-light no-data" role="alert">
                    現在データはございません
                </div>
            </template>
        </div>
    </div>
@stop