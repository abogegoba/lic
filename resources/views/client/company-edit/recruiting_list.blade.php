@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','求人情報の編集│企業編集｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/company-edit/common.css')}}">
@stop

@section('js')
    <script>
        $(function () {
            @if(session('success') === 'delete')
            $('#delete-complete').show();
            setTimeout(function () {
                $('#delete-complete').fadeOut(1500);
            }, 2000);
            @else
            $('#delete-complete').remove();
            @endif

            @if(session('success') === 'create')
            $('#create-complete').show();
            setTimeout(function () {
                $('#create-complete').fadeOut(1500);
            }, 2000);
            @elseif(session('success') === 'edit')
            $('#edit-complete').show();
            setTimeout(function () {
                $('#edit-complete').fadeOut(1500);
            }, 2000);
            @elseif($errors->get("business_exception"))
            setTimeout(function () {
                $('#errors').fadeOut(1500);
            }, 2000);
            @else
            $('#create-complete').remove();
            @endif
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li>企業編集</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content" id="edit-recruiting">
        <h2 class="main__content__headline">企業編集</h2>
        @include('client.common.flash_message.business_error')
        <div class="alert" id="create-complete" hidden>登録しました</div>
        <div class="alert" id="edit-complete" hidden>変更しました</div>
        <div class="alert" id="delete-complete" hidden>削除しました</div>
        <div class="form__controls" style="margin-bottom: 1em;">
            <button class="preview js-btn-target-blank" data-href="{{route('client.company-edit.basic-information.preview')}}">登録内容でプレビュー</button>
        </div>
        <section class="switchTab">
            <ul>
                <li><a href="{{route('client.company-edit.basic-information')}}">基本情報</a></li>
                <li class="active"><a href="{{route('client.company-edit.recruiting.list')}}">求人一覧</a></li>
            </ul>
        </section>
        <button class="button add js-btn-link" data-href="{{route('client.company-edit.recruiting.create')}}">求人を追加</button>
        @if (!empty($data->get('companyRecruitingList')))
            @foreach($data->get('companyRecruitingList') as $key => $companyRecruiting)
                <div class="form__modify">
                    <dl>
                        <dt>
                            <a href="{{route('client.company-edit.recruiting.edit', ["jobApplicationsId" => $key])}}">{{$companyRecruiting->get('title')}}</a>{{$companyRecruiting->get('jobConditions')}}
                        </dt>
                        <dd>{{$companyRecruiting->get('jobTypeName')}}</dd>
                    </dl>
                    <form action="{{route('client.company-edit.recruiting.delete.confirm',["jobApplicationsId" => $key])}}">
                        <button class="button button-submit">削除</button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="alert alert-light no-data" role="alert">
                現在登録されている求人はございません
            </div>
        @endif
    </div>
@stop
