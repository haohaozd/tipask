@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif首页 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('space_content')
    <h2 class="h4">最近动态</h2>
    <div class="stream-doing clearfix">
        @foreach($doings as $doing)
        <section class="stream-doing-item">
            <p class="stream-doing-item-info">{{ timestamp_format($doing->created_at) }} {{ $doing->action_text }}</p>
            <div class="stream-doing-item-title">
                @if(in_array($doing->action,['follow_question','answer','ask','append_reward','answer_adopted']))
                <h4><a href="{{ route('ask.question.detail',['id'=>$doing->source_id]) }}">{{ $doing->subject }}</a></h4>
                @elseif(in_array($doing->action,['create_article']))
                <h4><a href="{{ route('blog.article.detail',['id'=>$doing->source_id]) }}">{{ $doing->subject }}</a></h4>
                @endif
            </div>
            @if(in_array($doing->action,['answer']))
            <p class="stream-doing-item-quote">
                {{ $doing->content }}
            </p>
            @endif
        </section>
        @endforeach
    </div>
@endsection

