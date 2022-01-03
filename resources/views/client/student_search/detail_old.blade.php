@extends('client.common.root')

@section('title')
{{$data->get('member.lastName')}}　{{$data->get('member.firstName')}}のプロフィール｜新卒・第二新卒採用ならLinkT(リンクト)
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/student-search/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/student-search/detail/index.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/student/detail.js') }}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.student.list')}}">学生検索</a></li>
            <li>学生詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <section class="main__content">
        <header class="result-hdr">
            <div class="round-img">
                <picture>
                    <img src="{{$data->get('member.idPhotoFilePathForClientShow')}}" alt="証明写真">
                </picture>
            </div>
            <div>
                <h3>{{$data->get('member.lastName')}}　{{$data->get('member.firstName')}}<span>（{{$data->get('member.age').'歳'}}
                        ／{{$data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')}}{{$data->get('member.oldSchool.alreadyGraduated')? '卒業':'卒業予定'}}）</span></h3>                <div>
                    <p>{{$data->get('member.oldSchool.name')}}／{{$data->get('member.oldSchool.departmentName')}}</p>
                    @if(!empty($data->get('member.hashTag')))
                        <span class="tag {{$data->get('member.hashTag.color')? \App\Domain\Entities\Tag::TAG_COLLAR_CLASS_LIST[$data->get('member.hashTag.color')]:''}}">{{$data->get('member.hashTag.name')}}</span>
                    @endif
                    @if($data->get('member.internNeeded') === true)
                        <span class="intern">インターン希望</span>
                    @endif
                </div>
                <ul class="student-type">
                    @if($data->get('member.affiliationExperience'))
                        <li>体育会系経験あり</li>
                    @endif
                    @if($data->get('member.instagramFollowerNumber') && ($data->get('member.instagramFollowerNumber') !== \App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_OTHER))
                        <li>インスタフォロワー{{\App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_LABEL_LIST[$data->get('member.instagramFollowerNumber')]}}</li>
                    @endif
                </ul>
            </div>
            <picture>
                <img src="{{$data->get('member.privatePhotoFilePathForClientShow')}}" alt="プライベート写真">
            </picture>
        </header>
        <form action="{{route('client.message.detail', ['userAccountId' => $data->get('memberUserAccountId')])}}">
            <button class="button message" type="submit">この学生にメッセージする</button>
        </form>
        <section class="pr">
            @if(!empty($data->get('member.introduction')))
                <h2>自己PR</h2>
                <p> {!!nl2br($data->get('member.introduction'))!!}</p>
            @endif
            @foreach($data->get('prVideos') as$key => $prVideo)
                <section>
                    <h3>{{$prVideo['title']}}</h3>
                    <div class="content">
                        @if(preg_match('/\.(png|jpeg|jpg)$/i', $prVideo['prVideoPath']))
                            <picture>
                                <img src="{{$prVideo['prVideoPath']}}" alt="">
                            </picture>
                        @else
                            <div class="video">
                                <video class="pr__movie" controls="controls" muted="muted" poster="" playsinline="">
                                    <source src="{{$prVideo['prVideoPath']}}">
                                    <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                </video>
                            </div>
                        @endif
                    </div>
                    <p>{!!nl2br($prVideo['description'])!!}</p>
                </section>
            @endforeach
        </section>
        @if(count($data->get('prVideos')) != 0 || !empty($data->get('member.introduction')))
            <form action="{{route('client.message.detail', ['userAccountId' => $data->get('memberUserAccountId')])}}">
                <button class="button message" type="submit">この学生にメッセージする</button>
            </form>
        @endif
        <section class="profile">
            <h2>プロフィール詳細</h2>
            <dl class="basic">
                <dt>氏名</dt>
                <dd>{{$data->get('member.lastName')}}　{{$data->get('member.firstName')}}（{{$data->get('member.lastNameKana')}}　{{$data->get('member.firstNameKana')}}）</dd>
                <dt>生年月日</dt>
                <dd>{{$data->getWithFormat('member.birthday','Y年n月j日')}}（{{$data->get('member.age').'歳'}}）</dd>
                <dt>国籍</dt>
                <dd>
                    @if($data->get('member.country') > 1)
                        {{\App\Domain\Entities\Member::CITIZENSHIP_OVERSEAS_LIST[$data->get('member.country')]}}
                    @else
                        {{'日本'}}
                    @endif
                </dd>
                <dt>現住所</dt>
                <dd>
                    @if($data->get('member.country') > 1)
                        {{$data->get('member.city')}}
                    @else
                        {{$data->get('member.addressString')}}
                    @endif
                </dd>
                <dt>学校種別</dt>
                <dd>{{\App\Domain\Entities\School::SCHOOL_TYPE_LIST[$data->get('member.oldSchool.schoolType')]}}</dd>
                <dt>学校情報</dt>
                <dd>{{$data->get('member.oldSchool.name')}}<br>{{$data->get('member.oldSchool.departmentName')}}</dd>

                @if($data->get('member.country') == 1)
                <dt>学部系統</dt>
                <dd>{{isset(\App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]) ? \App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')] : \App\Domain\Entities\School::OVERSEAS_FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]}}</dd>
                @endif

                <dt>卒業年月</dt>
                <dd>{{$data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')}}</dd>
                @if(!empty($data->get('member.careers')) && count(($data->get('member.careers')))>0)
                    <dt>経歴</dt>
                    <dd>
                        <ul>
                            @foreach($data->get('member.careers') as $key => $careers)
                                <li>{{$careers->getWithFormat('period','Y年n月')}}<br>{{$careers->get('name')}}</li>
                            @endforeach
                        </ul>
                    </dd>
                @endif
                @if(!empty($data->get('member.aspirationSelfIntroductions')))
                    @foreach($data->get('member.aspirationSelfIntroductions') as $selfIntroduction)
                        <dt>
                            {{$selfIntroduction->get('title')}}
                        </dt>
                        <dd>{!!nl2br($selfIntroduction->get('content'))!!}</dd>
                    @endforeach
                @endif
                @if(!empty($data->get('member.aspirationBusinessTypes')) && count(($data->get('member.aspirationBusinessTypes')))>0)
                    <dt>志望業種</dt>
                    <dd>
                        @foreach($data->get('member.aspirationBusinessTypes') as $key => $aspirationBusinessType)
                            {{$key===0? '':'/ '}}{{$aspirationBusinessType->get('name')}}
                        @endforeach
                    </dd>
                @endif
                @if(!empty($data->get('member.aspirationJobTypes')) && count(($data->get('member.aspirationJobTypes')))>0)
                    <dt>志望職種</dt>
                    <dd>
                        @foreach($data->get('member.aspirationJobTypes') as $key => $aspirationJobType)
                            {{$key===0? '':'/ '}}{{$aspirationJobType->get('name')}}
                        @endforeach
                    </dd>
                @endif
                @if(!empty($data->get('member.aspirationPrefectures')) && count(($data->get('member.aspirationPrefectures')))>0)
                    <dt>志望勤務地</dt>
                    <dd>
                        @foreach($data->get('member.aspirationPrefectures') as $key => $aspirationPrefectures)
                            {{$key===0? '':'/ '}}{{$aspirationPrefectures->get('name')}}
                        @endforeach
                    </dd>
                @endif
                @if(!empty($data->get('member.languageAndCertification')) &&(($data->get('member.languageAndCertification.toeicScore')||$data->get('member.languageAndCertification.toeflScore'))||(!empty($data->get('member.languageAndCertification.certifications')) && count(($data->get('member.languageAndCertification.certifications')))>0)))
                    <dt>語学・資格</dt>
                    <dd>
                        @if(($data->get('member.languageAndCertification.toeicScore')||$data->get('member.languageAndCertification.toeflScore')))
                            <ol>
                                @if($data->get('member.languageAndCertification.toeicScore'))
                                    <li>
                                        TOEIC {{$data->get('member.languageAndCertification.toeicScore')}}点
                                    </li>
                                @endif
                                @if($data->get('member.languageAndCertification.toeflScore'))
                                    <li>
                                        TOEFL {{$data->get('member.languageAndCertification.toeflScore')}}点
                                    </li>
                                @endif
                            </ol>
                        @endif
                        @if(!empty($data->get('member.languageAndCertification.certifications')) && count(($data->get('member.languageAndCertification.certifications')))>0)
                            <ol>
                                @foreach($data->get('member.languageAndCertification.certifications') as $key => $certifications)
                                    <li>
                                        {{$certifications->get('name')}}
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    </dd>
                @endif
            </dl>
        </section>
        <form action="{{route('client.message.detail', ['userAccountId' => $data->get('memberUserAccountId')])}}" class="ftr-form">
            <div class="form__controls">
                <input type="button" class="prev js-btn-link js-key-save" value="戻る" data-href="{{route("client.student.list.reload")}}">
                <button class="button message" type="submit">この学生にメッセージする</button>
            </div>
        </form>
    </section>
@stop
