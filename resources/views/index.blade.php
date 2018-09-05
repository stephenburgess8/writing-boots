@extends('layouts.public')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper">
        <h1 class="boots-h1">Word Frequency Counter</h1>
        <form id="wb-form-main" class="boots-form" method="post">
            {{ csrf_field() }}
            <div class="wb-form-header">
                <details class="wb-form-options-details">
                    <summary>Options</summary>
                    <h4>Categories included in word frequency analysis</h4>
                    <fieldset class="wb-form-checkbox-wrapper">
                        <legend class="wb-form-options-legend">Function words</legend>
                            <input
                                id="articles"
                                name="feature"
                                type="checkbox"
                                value="articles"
                            />
                            <label for="articles">Articles</label>
                            <input
                                id="conjunctions"
                                name="feature"
                                type="checkbox"
                                value="conjunctions"
                            />
                            <label for="conjunctions">Conjunctions</label>
                            <input
                                id="demonstratives"
                                name="feature"
                                type="checkbox"
                                value="demonstratives"
                            />
                            <label for="demonstratives">Demonstratives</label>
                            <input
                                id="interjections"
                                name="feature"
                                type="checkbox"
                                value="interjections"
                            />
                            <label for="interjections">Interjections</label>
                            <input
                                id="interrogatives"
                                name="feature"
                                type="checkbox"
                                value="interrogatives"
                            />
                            <label for="interrogatives">Interrogatives</label>
                            <input
                                id="modals"
                                name="feature"
                                type="checkbox"
                                value="modals"
                            />
                            <label for="modals">Modals</label>
                            <input
                                id="possessives"
                                name="feature"
                                type="checkbox"
                                value="possessives"
                            />
                            <label for="possessives">Possessives</label>
                            <input
                                id="prepositions"
                                name="feature"
                                type="checkbox"
                                value="prepositions"
                            />
                            <label for="prepositions">Prepositions</label>
                            <input
                                id="pronouns"
                                name="feature"
                                type="checkbox"
                                value="pronouns"
                            />
                            <label for="pronouns">Pronouns</label>
                            <input
                                id="quantifiers"
                                name="feature"
                                type="checkbox"
                                value="quantifiers"
                            />
                            <label for="quantifiers">Quantifiers</label>
                    </fieldset>
                    <fieldset class="wb-form-checkbox-wrapper">
                        <legend class="wb-form-options-legend">Content words</legend>
                            <input
                                id="adverbs"
                                name="feature"
                                type="checkbox"
                                value="adverbs"
                            />
                            <label for="adverbs">Adverbs</label>
                            <input
                                id="adjectives"
                                name="feature"
                                type="checkbox"
                                value="adjectives"
                            />
                            <label for="adjectives">Adjectives</label>
                            <input
                                checked
                                id="numbers"
                                name="feature"
                                type="checkbox"
                                value="numbers"
                            />
                            <label for="numbers">Numbers</label>
                            
                        </fieldset>
                        <fieldset class="wb-form-checkbox-wrapper">
                            <legend  class="wb-form-options-legend" class="wb-form-options-legend  class="wb-form-options-legend"">Nouns</legend  class="wb-form-options-legend">
                            <input
                                checked
                                id="abstract-nouns"
                                name="feature"
                                type="checkbox"
                                value="abstract-nouns"
                            />
                            <label for="abstract-nouns">Abstract nouns</label>
                            <input
                                checked
                                id="place-object-nouns"
                                name="feature"
                                type="checkbox"
                                value="place-object-nouns"
                            />
                            <label for="place-object-nouns">Place/Object nouns</label>
                            <input
                                checked
                                id="people-nouns"
                                name="feature"
                                type="checkbox"
                                value="people-nouns"
                            />
                            <label for="people-nouns">People nouns</label>
                            <input
                                checked
                                id="time-nouns"
                                name="feature"
                                type="checkbox"
                                value="time-nouns"
                            />
                            <label for="time-nouns">Time nouns</label>
                            <input
                                checked
                                id="body-nouns"
                                name="feature"
                                type="checkbox"
                                value="body-nouns"
                            />
                            <label for="body-nouns">Body nouns</label>
                            
                        </fieldset>
                        <fieldset class="wb-form-checkbox-wrapper">
                            <legend class="wb-form-options-legend">Verbs</legend>
                            <input
                                id="most-common-verbs"
                                name="feature"
                                type="checkbox"
                                value="most-common-verbs"
                            />
                            <label for="most-common-verbs">Most common verbs</label>
                            <input
                                id="common-verbs"
                                name="feature"
                                type="checkbox"
                                value="common-verbs"
                            />
                            <label for="common-verbs">Common verbs</label>
                            <input
                                checked
                                id="less-common-verbs"
                                name="feature"
                                type="checkbox"
                                value="less-common-verbs"
                            />
                            <label for="less-common-verbs">Less common verbs</label>
                    </fieldset>
                </details>
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
