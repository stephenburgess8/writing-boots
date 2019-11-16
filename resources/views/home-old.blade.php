@extends('layouts.boots')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper">
        <h1 class="boots-h1">Word Frequency Counter</h1>
        <form id="wb-form-main" class="boots-form" method="post">
            {{ csrf_field() }}
            <div class="wb-form-header">
                <label for="wb-title" class="boots-form-input-label">Title</label>
                @if (isset($title))
                    <input name="wb-title" id="wb-title-input" class="boots-input-string" type="text" value="{{$title}}">
                @else
                    <input name="wb-title" id="wb-title-input" class="boots-input-string" type="text" placeholder="Title (Optional)">
                @endif
                <div class="wb-form-submit-container">
                    <input class="boots-button-submit" id="wb-form-main-submit" type="submit" value="Analyze">
                </div>
            </div>
            <div class="boots-input-textarea-container">
                <textarea id="wb-content-input" class="boots-input-textarea" name="boots-content" rows="10" cols="100">@if (isset($text)){{$text}} @else{{'The cat was playing in the garden.'}}@endif</textarea>
            </div>
        </form>
    </div>
    <div class="boots-content-wrapper">
        <div class="wb-table-wrapper">
            <h4 class="wb-results-frequencies-header">Text Analysis</h4>
            <table class="wb-table-results">
                <tbody>
                    @isset($wordCount)
                    <tr>
                        <td class="wb-table-results-cell">Words</td>
                        <td class="wb-table-results-cell">{{ $wordCount }}</td>
                    </tr>
                    @endisset
                    @isset($sentenceCount)
                    <tr>
                        <td class="wb-table-results-cell">Sentences</td>
                        <td class="wb-table-results-cell">{{ $sentenceCount }}</td>
                    </tr>
                    @endisset
                    @isset($paragraphCount)
                    <tr>
                        <td class="wb-table-results-cell">Paragraphs</td>
                        <td class="wb-table-results-cell">{{ $paragraphCount }}</td>
                    </tr>
                    @endisset
                    @isset($averageWordLength)
                    <tr>
                        <td class="wb-table-results-cell">Average Characters Per Word</td>
                        <td class="wb-table-results-cell">{{ $averageWordLength }}</td>
                    </tr>
                    @endisset
                    @isset($averageSentenceLength)
                    <tr>
                        <td class="wb-table-results-cell">Average Words Per Sentence</td>
                        <td class="wb-table-results-cell">{{ $averageSentenceLength }}</td>
                    </tr>
                    @endisset
                    @isset($averageParagraphLength)
                    <tr>
                        <td class="wb-table-results-cell">Average Sentences Per Paragraph</td>
                        <td class="wb-table-results-cell">{{ $averageParagraphLength }}</td>
                    </tr>
                    @endisset
                    @isset($syllables)
                    <tr>
                        <td class="wb-table-results-cell">Syllables</td>
                        <td class="wb-table-results-cell">{{ $syllables }}</td>
                    </tr>
                    @endisset
                </tbody>
            </table>
        </div>
        <div class="wb-table-wrapper">
            <h4 class="wb-results-frequencies-header">Readability Grade Level</h4>
            <table class="wb-table-results">
                <tbody>
                    @isset($gunningIndex)
                    <tr>
                        <td class="wb-table-results-cell">Gunning Index</td>
                        <td class="wb-table-results-cell">{{ $gunningIndex }}</td>
                    </tr>
                    @endisset
                    @isset($fleschScore)
                    <tr>
                        <td class="wb-table-results-cell">Flesch Score</td>
                        <td class="wb-table-results-cell">{{ $fleschScore }}</td>
                    </tr>
                    @endisset
                    @isset($fleschGrade)
                    <tr>
                        <td class="wb-table-results-cell">Flesch Grade</td>
                        <td class="wb-table-results-cell">{{ $fleschGrade }}</td>
                    </tr>
                    @endisset
                    @isset($fleschKincaidGrade)
                    <tr>
                        <td class="wb-table-results-cell">Flesch-Kincaid Grade</td>
                        <td class="wb-table-results-cell">{{ $fleschKincaidGrade }}</td>
                    </tr>
                    @endisset
                    @isset($smogLevel)
                    <tr>
                        <td class="wb-table-results-cell">SMOG Level</td>
                        <td class="wb-table-results-cell">{{ $smogLevel }}</td>
                    </tr>
                    @endisset
                    @isset($colemanLiauGrade)
                    <tr>
                        <td class="wb-table-results-cell">Coleman Liau Grade</td>
                        <td class="wb-table-results-cell">{{ $colemanLiauGrade }}</td>
                    </tr>
                    @endisset
                    @isset($ari)
                    <tr>
                        <td class="wb-table-results-cell">Automated readability index</td>
                        <td class="wb-table-results-cell">{{ $ari }}</td>
                    </tr>
                    @endisset
                    @isset($averageGrade)
                    <tr>
                        <td class="wb-table-results-cell">Average Grade Level</td>
                        <td class="wb-table-results-cell">{{ $averageGrade }}</td>
                    </tr>
                    @endisset
                </tbody>
            </table>
        </div>
        @isset($frequencies)
        <div class="wb-table-wrapper">
            <h4 class="wb-results-frequencies-header">Less common words by frequency</h4>
            <ul>
                @foreach ($frequencies as $word => $count)
                    <li>{{$word}} - {{$count}}</li>
                @endforeach
            </ul>
        </div>
        @endisset
    </div>
</div>
@endsection
