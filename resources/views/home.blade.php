@extends('layouts.flex')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper wdi-content-wrapper--panels">
        <div class="wdi-panel-main">
            <div class="wdi-form-wrapper">
                <form id="wb-form-main" class="boots-form wdi-form-flex" method="post">
                    {{ csrf_field() }}
                    <div class="boots-input-textarea-container">
                        <textarea id="wb-content-input" class="boots-input-textarea" name="boots-content" rows="10" cols="100">@if (isset($text)){{$text}} @else{{'The cat was playing in the garden.'}}@endif</textarea>
                    </div>
                        {{-- <label for="wb-title" class="wdi-form-input-label">Title</label> --}}
                     {{--    @if (isset($title))
                            <input name="wb-title" id="wb-title-input" class="boots-input-string" type="text" value="{{$title}}">
                        @else
                            <input name="wb-title" id="wb-title-input" class="boots-input-string" type="text" placeholder="Title (Optional)">
                        @endif --}}

                    <div class="wdi-panel-actions">
                        <h3 class="wdi-panel-header">Actions</h3>
                        <div class="wb-form-submit-container">
                            <input class="boots-button-submit" id="wb-form-main-submit" type="submit" value="Save Note">
                        </div>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">Delete</a>
                        </div>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">See Versions</a>
                        </div>
                        <div class="wdi-panel-action">
                            <a class="wdi-panel-action-link" href="#">Preview</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="boots-card">
                <div class="boots-card-header">{{ __('Saved Notes') }}</div>
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
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="wdi-panel-side">
            <h3 class="wdi-h4 wdi-panel-header">Metadata</h3>
            <div class="wdi-panel-body">
                <ul>
                    <li>Title: 43101419j</li>
                    <li>Last Saved: 2:10 PM, Nov. 16th, 2019</li>
                    <li>Description: Out of respect for human interaction? i don't know. trying to imagine an existence where i do not use any google service at all, including replacements like duckduckgo. not to avoid the company itself, but to avoid 'computerization' as a human brain</li>
                    <li>Tags: <a href="/tags/test">Test</a>, <a href="/tags/journal">Journal</a></li>
                    <li>Privacy: Only Me</li>
                </ul>
            </div>
            <h3 class="wdi-h4 wdi-panel-header">Word Counts</h3>
            <div class="wdi-panel-body">
                <ul>
                    <li>Words: 1232</li>
                    <li>Characters: 75430</li>
                    <li>Sentences: 42</li>
                    <li>Paragraphs: 6</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
