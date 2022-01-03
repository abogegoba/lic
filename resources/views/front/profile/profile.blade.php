@extends('front.common.root')

@section('title','プロフィール詳細│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li>マイページ</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content" id="profile">
        <h2 class="main__content__headline">プロフィール</h2>
        <div class="form__preview">
            <div class="form__controls">
                <input type="button" value="登録内容でプレビュー" class="preview js-btn-target-blank" data-href="{{route('front.profile.preview')}}">
            </div>
        </div>
        <form action="{{route('front.profile.personal.edit')}}" class="form__modify">
            <dl>
                <dt>氏名</dt>
                <dd>{{$data->get('member.lastName')}}　{{$data->get('member.firstName')}}
                    （{{$data->get('member.lastNameKana')}}　{{$data->get('member.firstNameKana')}}）
                </dd>
                @if($data->get('member.country') > 1)
                <dt>English Name</dt>
                <dd>{{$data->get('member.englishName')}}</dd>
                @endif
                <dt>生年月日</dt>
                <dd>{{$data->getWithFormat('member.birthday','Y年n月j日')}}</dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.address.edit')}}" class="form__modify">
            <dl>
                @if($data->get('member.country') > 1)
                <dt>国籍</dt>
                <dd>{{\App\Domain\Entities\Member::CITIZENSHIP_OVERSEAS_LIST[$data->get('member.country')]}}</dd>
                @endif
                <dt>現住所</dt>
                <dd>
                    @if($data->get('member.country') > 1)
                        {{$data->get('member.city')}}
                    @else
                        {{$data->get('member.addressString')}}
                    @endif

                    @if($data->get('member.blockNumber'))
                        <br>{{$data->get('member.blockNumber')}}
                    @endif
                </dd>
                <dt>連絡先</dt>
                <dd>{{$data->get('member.phoneNumber')}}</dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.school.edit')}}" class="form__modify">
            <dl>
                <dt>学校情報</dt>
                <dd>{{\App\Domain\Entities\School::SCHOOL_TYPE_LIST[$data->get('member.oldSchool.schoolType')]}}
                    @if($data->get('member.country') == 1)
                    ／{{isset(\App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]) ? \App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')] : \App\Domain\Entities\School::OVERSEAS_FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]}}
                    @endif
                    <br>{{$data->get('member.oldSchool.name')}}
                    <br>{{$data->get('member.oldSchool.departmentName')}}
                    <br>{{$data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')}}{{$data->get('member.oldSchool.alreadyGraduated')? '卒業':'卒業予定'}}
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.photo.edit')}}" class="form__modify">
            <dl>
                <dt>写真・ハッシュタグ</dt>
                <dd>
                    <div class="flex">
                        <section>
                            <h2>証明写真</h2>
                            <picture>
                                <img src="{{$data->get('member.idPhotoFilePathForFrontShow')}}" alt="証明写真">
                            </picture>
                        </section>
                        <section>
                            <h2>プライベート写真</h2>
                            <picture>
                                <img src="{{$data->get('member.privatePhotoFilePathForFrontShow')}}" alt="プライベート写真">
                            </picture>
                        </section>
                    </div>
                    <h2>ハッシュタグ</h2>
                    <ul>
                        @if(!empty($data->get('member.hashTag')))
                            <li class="tag {{$data->get('member.hashTag.color')? \App\Domain\Entities\Tag::TAG_COLLAR_CLASS_LIST[$data->get('member.hashTag.color')]:''}}">{{$data->get('member.hashTag.name')}}</li>
                        @else
                            未登録
                        @endif
                    </ul>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.pr.edit')}}" class="form__modify">
            <dl>
                <dt>PR</dt>
                <dd>
                    <h2>PR動画</h2>
                    @if(!empty($data->get('prVideos')) && count($data->get('prVideos')) >0)
                        @foreach($data->get('prVideos') as $key => $prVideo)
                            <section>
                                <h3>{{$prVideo->get('title')}}</h3>
                                <div class="content">
                                    @if(preg_match('/\.(png|jpeg|jpg)$/i', $prVideo->get("url")))
                                        <picture>
                                            <img src="{{$prVideo->get("url")}}" alt="">
                                        </picture>
                                    @else
                                        <div class="video">
                                            <video controlsList="nodownload" controls="controls" muted="muted" poster="">
                                                <source src="{{$prVideo->get('url')}}">
                                                <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                            </video>
                                        </div>
                                    @endif
                                </div>
                                <p>{!!nl2br($prVideo->get('description'))!!}</p>
                            </section>
                        @endforeach
                    @else
                        未登録
                    @endif
                    <h2>自己PR文</h2>
                    <p>
                        @if(!empty($data->get('member.introduction')))
                            {!!nl2br($data->get('member.introduction'))!!}
                        @else
                            未登録
                        @endif
                    </p>
                    @if($data->get('member.country') == 1)
                    <h2>体育会所属経験</h2>
                    <p>
                        @if($data->get('member.affiliationExperience') !== null)
                            {{\App\Domain\Entities\Member::AFFILIATION_EXPERIENCE_LABEL_LIST[$data->get('member.affiliationExperience')]}}
                        @else
                            未登録
                        @endif
                    </p>
                    @endif
                    <h2>インスタフォロワー数</h2>
                    <p>
                        @if($data->get('member.instagramFollowerNumber'))
                            {{\App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_LABEL_LIST[$data->get('member.instagramFollowerNumber')]}}
                        @else
                            未登録
                        @endif
                    </p>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.self-introduction.edit')}}" class="form__modify">
            <dl>
                <dt>自己紹介</dt>
                <dd>
                    @foreach($data->get("selfIntroductions") as $displayNumber => $selfIntroductions)
                        <h2>
                            {{$selfIntroductions['title']}}
                        </h2>
                        <p>{!!nl2br($selfIntroductions['content'])!!}</p>
                    @endforeach
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.desired.edit')}}" class="form__modify">
            <dl>
                <dt>志望情報</dt>
                <dd>
                    <h2>志望業種</h2>
                    <p>
                        @if(!empty($data->get('member.aspirationBusinessTypes')) && count(($data->get('member.aspirationBusinessTypes')))>0)
                            @foreach($data->get('member.aspirationBusinessTypes') as $key => $aspirationBusinessType)
                                {{$key===0? '':'/ '}}{{$aspirationBusinessType->get('name')}}
                            @endforeach
                        @else
                            未登録
                        @endif
                    </p>
                    <h2>志望職種</h2>
                    <p>
                        @if(!empty($data->get('member.aspirationJobTypes')) && count(($data->get('member.aspirationJobTypes')))>0)
                            @foreach($data->get('member.aspirationJobTypes') as $key => $aspirationJobType)
                                {{$key===0? '':'/ '}}{{$aspirationJobType->get('name')}}
                            @endforeach
                        @else
                            未登録
                        @endif
                    </p>
                    <h2>志望勤務地</h2>
                    <p>
                        @if(!empty($data->get('member.aspirationPrefectures')) && count(($data->get('member.aspirationPrefectures')))>0)
                            @foreach($data->get('member.aspirationPrefectures') as $key => $aspirationPrefectures)
                                {{$key===0? '':'/ '}}{{$aspirationPrefectures->get('name')}}
                            @endforeach
                        @else
                            未登録
                        @endif
                    </p>
                    <h2>インターン</h2>
                    <p>{{$data->get('member.internNeeded') === true? '希望する':'希望しない'}}</p>
                    <h2>就活イベントやその他就職活動に関する情報取得について</h2>
                    <p>{{$data->get('member.recruitInfoNeeded') === true? '希望する':'希望しない'}}</p>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.language.edit')}}" class="form__modify">
            <dl>
                <dt>語学・資格</dt>
                <dd>
                    <h2>語学</h2>
                    <p>
                        TOEIC　　{{!empty($data->get('member.languageAndCertification')) && !empty($data->get('member.languageAndCertification.toeicScore'))? $data->get('member.languageAndCertification.toeicScore').'点':'未登録'}}
                        <br>
                        TOEFL　　{{!empty($data->get('member.languageAndCertification')) && !empty($data->get('member.languageAndCertification.toeflScore'))? $data->get('member.languageAndCertification.toeflScore').'点':'未登録'}}
                    </p>
                    <h2>保有資格・検定など</h2>
                    <ul>
                        @if(!empty($data->get('member.languageAndCertification.certifications')) && count(($data->get('member.languageAndCertification.certifications')))>0)
                            @foreach($data->get('member.languageAndCertification.certifications') as $key => $certifications)
                                <li>

                                    {{$certifications->get('name')}}
                                </li>
                            @endforeach
                        @else
                            未登録
                        @endif
                    </ul>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.career.edit')}}" class="form__modify">
            <dl>
                <dt>経歴</dt>
                <dd>
                    @if(!empty($data->get('member.careers')) && count(($data->get('member.careers')))>0)
                        @foreach($data->get('member.careers') as $key => $careers)
                            <p>{{$careers->getWithFormat('period','Y年n月')}}<br>
                                {{$careers->get('name')}}</p>
                        @endforeach
                    @else
                        未登録
                    @endif
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="{{route('front.profile.id-and-pass.edit')}}" class="form__modify">
            <dl>
                <dt>ID・パスワード</dt>
                <dd>
                    <p>{{$data->get('member.userAccount.mailAddress')}}</p>
                    <ul class="notice">
                        <li>※メールアドレスをパスワードとして利用します</li>
                        <li>※パスワードはご入力いただいたものです。</li>
                        <li>(セキュリティの観点より本画面では非表示です。）</li>
                    </ul>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <div class="form__preview">
            <div class="form__controls">
                <input type="button" value="登録内容でプレビュー" class="preview js-btn-target-blank" data-href="{{route('front.profile.preview')}}">
            </div>
        </div>
    </div>
@stop
