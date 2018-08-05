<?php

namespace App\Services;

use Syllable;

class TextService
{
    private $text;
    private $title = null;
    private $words = [];
    private $wordCount = 0;

    private $excluded = ["\t", "\n", "\r", "\r\n", " ", "a", "and", "of", "the", "to", "in", "as", "that", "is", "for", "be", "with", "an", "would", "i", "or", "this", "on", "are", "not", "could", "in", "have", "it", "was", "can", "more", "from", "use", "most", "my", 'his', "you", "he", "they", "were", "her", "He", "had", "s", "she", "at", "The", "I", 'their', "out", "She", "t", "up", "back", "been", "into", "down", "them", "we", "one", "What", "They", "all", "but", "It", "like", "some", "d", "about", "than", "around", "just", "him", "what", "so", "get", "through", "over", "right", "me", "your", "let", "ve", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "do", "always", "before", "see", "made", "no", "know", "go", "there", "other", "got", "then", "return", "In", "This", "well"];

    public function __construct()  {
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        $this->words = [];
    }

    public function gettitle() {
        return $this->title;
    }

    public function settitle($title) {
        $this->title = $title;
    }

    public function getCharacterCount() {
        return strlen($this->text);
    }

    public function getWhiteSpaceCount() {
        return substr_count($this->text, ' ');
    }

    public function getCounts() {
        $words = $this->getWords($this->text);
        $this->setWords($words);
        $wordCount = sizeof($words);
        $averageWordLength = $this->getAverageWordLength($words);

        $sentences = $this->getSentences($this->text);
        $sentenceCount = sizeof($sentences);
        $averageSentenceLength = $this->getAverageSentenceLength($sentences);

        $paragraphs = $this->getParagraphs($this->text);
        $paragraphCount = sizeof($paragraphs);
        $averageParagraphLength = $this->getAverageParagraphLength($paragraphs);

        $syllableResults = $this->countSyllables($this->text);
        $syllableWords = $syllableResults['words'];
        $syllables = $syllableResults['syllables'];

        return array(
            "words" => $words,
            "wordCount" => $wordCount,
            "syllables" => $syllables,
            "sentenceCount" => $sentenceCount,
            "paragraphCount" => $paragraphCount,
            "averageWordLength" => sprintf('%0.2f', $averageWordLength),
            "averageSentenceLength" => sprintf('%0.2f', $averageSentenceLength),
            "averageParagraphLength" => sprintf('%0.2f', $averageParagraphLength)
        );
    }

    public function getFrequencies() {
        $words = [];
        $wordMap = [];

        if (sizeof($this->words) == 0) {
            $words = $this->getWords($this->text);
            $this->setWords($words);
        }
        else {
            $words = $this->words;
        }

        foreach ($words as $word) {
            if (!in_array($word, $this->excluded) && strlen($word) > 1) {
                if (array_key_exists($word, $wordMap)) {
                    $wordMap[$word] += 1;
                }
                else {
                    $wordMap[$word] = 1;
                }
            }
        }

        arsort($wordMap);
        return array_slice($wordMap, 0, 10);
    }

    private function setWords($words) {
        $this->words = $words;
    }

    private function getWords($textString) {
        $cleanedText = str_replace(["\"", ';', ':', ',', '.', '?', '¿', '!', "#", "…"], '', $textString);
        $cleanedText = str_replace([" ", " –", " –", " -", "- ", " '", "' ", "\0", "\x0B", "\t", "\r", "\n", "\v", "\f", "\x0c", "\\", "—"], " ", $cleanedText);
        $filteredWords = array_filter(explode(' ', trim($cleanedText)), function($elem) {
            return $elem != "";
        });
        return $filteredWords;
    }

    private function getAverageWordLength($words) {
        $wordCount = 0;
        $totalCharacters = 0;
        foreach ($words as $word) {
            $word = rtrim($word, ' ,.\t\n\r!?;:)-/\'¿');
            $word = ltrim($word);
            $length = strlen($word);

            if ($length > 0) {
                $wordCount++;
                $totalCharacters += $length;
            }
        }

        return $wordCount > 0 ? $totalCharacters / $wordCount : 0;
    }

    private function getSentences($textString) {
        return preg_split('/(?<=[.?!…])\s+/', $textString, -1, PREG_SPLIT_NO_EMPTY);
    }

    private function getAverageSentenceLength($sentences) {
        $sentenceCount = 0;
        $totalWords = 0;
        foreach ($sentences as $sentence) {
            if (strlen($sentence) > 0) {
                $words = $this->getWords($sentence);
                $wordCount = sizeof($words);
                
                if ($wordCount > 0) {
                    $sentenceCount++;
                    $totalWords += $wordCount;
                }
            }
        }

        return $sentenceCount > 0 ? $totalWords / $sentenceCount : 0;
    }

    private function getParagraphs($textString) {
        return preg_split('/(\r\n|\n|\r)+/', $textString);
    }

    private function getAverageParagraphLength($paragraphs) {
        $paragraphCount = 0;
        $totalSentences = 0;

        foreach ($paragraphs as $paragraph) {
            if (strlen($paragraph) > 0) {
                $sentences = $this->getSentences($paragraph);
                $sentenceCount = sizeof($sentences);
                
                if ($sentenceCount > 0) {
                    $paragraphCount++;
                    $totalSentences += $sentenceCount;
                }
            }
        }

        return $paragraphCount > 0 ? $totalSentences / $paragraphCount : 0;
    }

    public function countSyllables($text) {
        $syllable = new Syllable('en-us');
        $syllable->getSource()->setPath(dirname($_SERVER['DOCUMENT_ROOT']) . '/resources/lang/syllables');
        $syllable->getCache()->setPath(dirname($_SERVER['DOCUMENT_ROOT']) . '/storage/framework/cache');
        $words = $syllable->countWordsText($text);
        $syllables = $syllable->countSyllablesText($text);

        return [
            'words' => $words,
            'syllables' => $syllables
        ];
    }
}
