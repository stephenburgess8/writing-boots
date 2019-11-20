@extends('layouts.flex')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper wdi-content-wrapper--panels">
        <div class="wdi-panel-main">
            <div class="wdi-form-wrapper">
                <form id="wb-form-main" class="boots-form wdi-form-flex" method="post">
                    {{ csrf_field() }}
                    <div class="boots-input-textarea-container">
                        <textarea id="wb-content-input" class="boots-input-textarea" name="content" rows="10" cols="100">@if (isset($content)){{$content}} @else{{'The cat was playing in the garden.'}}@endif</textarea>
                    </div>
                    <div class="wdi-panel-actions">
                        <h3 class="wdi-panel-header">Actions</h3>
                        <div class="wb-form-submit-container">
                            <input class="boots-button-submit" id="wb-form-main-submit" type="submit" value="Save Note">
                        </div>
                        <small><strong>Last Saved</strong><br><time>Nov. 16th, 2019<br>2:10 PM</time></small>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">Versions</a>
                        </div>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">Publish</a>
                        </div>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">Preview</a>
                        </div>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">Compost</a>
                        </div>
                    </div>
                    <div class="wdi-panel-actions">
                        <h3 class="wdi-h4 wdi-panel-header">Metadata</h3>
                        <div class="wdi-panel-body">
                            <ul>
                                <li class="wdi-panel-list-item">
                                    <label for="title" class="wdi-form-input-label">Title</label>
                                    @if (isset($title))
                                        <input name="title" id="wb-title-input" class="wdi-input-string" type="text" value="{{ $title }}">
                                    @else
                                        <input name="title" id="wb-title-input" class="wdi-input-string" type="text" placeholder="Title">
                                    @endif 
                                </li>
                                <li class="wdi-panel-list-item">
                                    <label for="title" class="wdi-form-input-label">Description</label>
                                    @if (isset($content))
                                        <textarea id="wdi-comment-input" class="wdi-input-textarea" name="comment">{{ $content }}</textarea>
                                    @else
                                        <textarea id="wdi-comment-input" class="wdi-input-textarea" name="comment">TOut of respect for human interaction? i don't know. trying to imagine an existence where i do not use any google service at all, including replacements like duckduckgo. not to avoid the company itself, but to avoid 'computerization' as a human brain.</textarea>
                                    @endif
                                </li>
                                <li class="wdi-panel-list-item"><strong>Tags</strong> <a href="/tags/test">Test</a>, <a href="/tags/journal">Journal</a></li>
                                <li class="wdi-panel-list-item"><strong>Privacy</strong> Only Me</li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <div class="boots-card wdi-card">
                <div class="boots-card-header">{{ __('Word Counts') }}</div>
                <div class="boots-card-body">
                    <div class="wdi-card-content">
                        <ul>
                            <li class="wdi-panel-list-item"><strong>Words</strong> 1232</li>
                            <li class="wdi-panel-list-item"><strong>Characters</strong> 75430</li>
                            <li class="wdi-panel-list-item"><strong>Sentences</strong> 42</li>
                            <li class="wdi-panel-list-item"><strong>Paragraphs</strong> 6</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="boots-card wdi-card">
                <div class="boots-card-header">{{ __('Most Frequent Words') }}</div>
                <div class="boots-card-body">
                    <div class="wdi-card-content">
                        <ul>
                            <li class="wdi-panel-list-item">1232 <strong>Juniper</strong></li>
                            <li class="wdi-panel-list-item">78 <strong>Wonderosa</strong></li>
                            <li class="wdi-panel-list-item">42 <strong>scorpion</strong></li>
                            <li class="wdi-panel-list-item">6 <strong>waves</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="boots-card wdi-card">
                <div class="boots-card-header">{{ __('Other Notes') }}</div>
                <div class="boots-card-body">
                    <div class="boots-mini">
                        <h3 class="boots-mini-header">This is a title</h3>
                        <div class="boots-mini-body">
                            <p>This is an exerpt which is about 24 words or maybe even less...</p>
                        </div>
                    </div>
                    <div class="boots-mini">
                        <h3 class="boots-mini-header">Another title</h3>
                        <div class="boots-mini-body">
                            <p>Here we see another example. That's great, isn't it?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wdi-panel-side">
        </div>
    </div>
@endsection
