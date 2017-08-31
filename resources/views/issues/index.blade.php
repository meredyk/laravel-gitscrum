@section('title',  trans('gitscrum-sprints'))

@extends('layouts.kanban')

@section('breadcrumb')
<div class="col-lg-6">
    <h3>
        @include('partials.includes.breadcrumb-sprint', ['obj'=>$sprint])
        @if( !is_null($sprint) )
        {{trans('gitscrum.sprint-planning')}}
        @else
        {{trans('gitscrum.my-planning')}}
        @endif
    </h3>
</div>
<div class="col-lg-6 text-right">
    @if( !is_null($sprint) )
        @include('partials.lnk-favorite', ['favorite' => $sprint->favorite, 'type' => 'sprint',
            'id' => $sprint->id, 'btnSize' => 'btn-sm font-bold', 'text' => trans('gitscrum.favorite')])
        &nbsp;&nbsp;
        <div class="btn-group">
            <a href="{{route('issues.create', ['scope' => 'sprint', 'slug'=>$sprint->slug])}}"
                class="btn btn-sm btn-primary"
                data-toggle="modal" data-target="#modalLarge">
                <i class="fa fa-plus" aria-hidden="true"></i> {{trans('gitscrum.create-issue')}}</a>
            <a href="{{route('sprints.edit', ['slug'=>$sprint->slug])}}"
                class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalLarge">
                <i class="fa fa-pencil" aria-hidden="true"></i> {{trans('gitscrum.edit-sprint')}}</a>
            <form action="{{route('sprints.destroy')}}" method="POST" class="form-delete pull-right">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="slug" value="{{$sprint->slug}}" />
                <button class="btn btn-sm btn-default btn-submit-form" type="submit">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    @endif
</div>
@endsection

@section('content')
<div class="kanban-board">

    <div class="kanban-board-scroll">
        <div class="agile-column connectColumn" data-endpoint="{{route('api.configStatus.position.update')}}">
        @foreach ($configStatus as $status)
        <div style="float:left" class="row">
            <div class="agile" data-value="{{$status->id}}">
                <h5 class="handle">
                    <i class="fa fa-arrows-h" data-toggle="tooltip" title="{{trans('gitscrum.drag-it')}}"
                       aria-hidden="true"></i>
                    {{$status->title}}
                    (
                    @if(isset($issues[$status->id]))
                        <span>{{count($issues[$status->id])}}</span>
                    @else
                        <span>0</span>
                    @endif
                    )
                </h5>
                <div class="agile-list-scroll">
                    <ul class="sortable-list connectList agile-list"
                        data-color="{{$status->color}}" data-closed="{{$status->is_closed}}"
                        data-value="{{$status->id}}" data-endpoint="{{route('issues.status.update')}}">
                        @if(isset($issues[$status->id]))

                            {{ $card = $issues[$status->id] }}

                            <li id="{{$card->id}}" class="card-detail" data-value="{{$card->id}}" style="border-left:3px solid #{{$card->type->color}}">

                                <h4><a href="{{route('issues.show', ['slug' => $card->slug])}}">{{$card->title}}</a>
                                    <small>{{$card->productBacklog->title}}</small>
                                </h4>

                                <div class="team-members">
                                    @each('partials.lists.users-min', $card->users, 'user')
                                </div>

                                <div class="icons">
                                    @include('partials.boxes.issue-icons', ['issue' => $card])
                                </div>

                                @if(isset($card->sprint))
                                    <a href="{{route('issue_types.index', ['sprint_slug' => $card->sprint->slug,
        'type_slug' => $card->type->slug])}}">
        <span class="label label-primary" style="background-color:#{{$card->type->color}}">
    {{$card->type->title}}</span></a>
                                @else
                                    <span class="label label-default">
    {{$card->type->title}}</span></a>
                                @endif

                                <span class="label label-warning"> Effort:{{$card->configEffort->title}}</span>

                                <div class="options">
                                    <a href="{{route('issues.edit', ['slug' => $card->slug])}}"
                                       data-toggle="modal" data-target="#modalLarge">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> {{trans('gitscrum.edit-issue')}}</a>
                                    <div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</div>

@endsection
