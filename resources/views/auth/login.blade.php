@section('title',  trans('gitscrum.title-login'))

@extends('layouts.master', ['hideNavbar' => true, 'bodyClass' => 'body-login'])

@section('content')
    
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="middle-box text-center loginscreen">
            <h1 style="color: #E74C3C"><strong>{{ env('APP_TITLE') }}</strong></h1>
            <h5 class="lead">{{trans('gitscrum.welcome-to')}} <strong>GitScrum</strong></h5>

            <h5>{{trans('gitscrum.authentication')}}</h5>
            <a href="{{route('auth.provider', ['provider' => 'github'])}}" class="btn btn-lg btn-default btn-loader">
                    <i class="fa fa-github" aria-hidden="true"></i>&nbsp;&nbsp;<strong>GitHub</strong>
            </a>

            <a href="{{route('auth.provider', ['provider' => 'gitlab'])}}" class="btn btn-lg btn-default btn-loader">
                    <i class="fa fa-gitlab" aria-hidden="true"></i>&nbsp; <strong>GitLab</strong>
            </a>

            <p><a href="https://gitscrum.com/community" target="_blank"><strong>GitScrum</strong> Community</a></p>
            <p class="small">The GitScrum Community is licensed under the
            <a href="https://github.com/GitScrum-Community/laravel-gitscrum/blob/master/LICENSE.md" target="_blank">MIT license</a></p>
        </div>
    </div>
</div>

@endsection
