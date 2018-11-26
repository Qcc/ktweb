@extends('layouts.app')

@section('title', $topic->title)

@section('description', $topic->excerpt)

@section('content')

<p>
	{{ $topic->title }}
</p> <label>Body</label>
<p>
	{{ $topic->body }}
</p> <label>User_id</label>
<p>
	{{ $topic->user_id }}
</p> <label>Category_id</label>
<p>
	{{ $topic->category_id }}
</p> <label>Reply_count</label>
<p>
	{{ $topic->reply_count }}
</p> <label>View_count</label>
<p>
	{{ $topic->view_count }}
</p> <label>Last_reply_user_id</label>
<p>
	{{ $topic->last_reply_user_id }}
</p> <label>Order</label>
<p>
	{{ $topic->order }}
</p> <label>Excerpt</label>
<p>
	{{ $topic->excerpt }}
</p> <label>Slug</label>
<p>
	{{ $topic->slug }}
</p>
<div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        作者：{{ $topic->user->name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('users.show', $topic->user->id) }}">
                                <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $topic->title }}
                    </h1>
    
                    <div class="article-meta text-center">
                        {{ $topic->created_at->diffForHumans() }}
                        ⋅
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        {{ $topic->reply_count }}
                    </div>
    
                    <div class="topic-body">
                        {!! $topic->body !!}
                    </div>
    
                    <div class="operate">
                        <hr>
                        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-default btn-xs" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑
                        </a>
                        <a href="#" class="btn btn-default btn-xs" role="button">
                            <i class="glyphicon glyphicon-trash"></i> 删除
                        </a>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
@endsection
