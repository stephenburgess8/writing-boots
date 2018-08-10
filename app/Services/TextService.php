<?php

namespace App\Services;

use Syllable;

class TextService
{
    private $text;
    private $title = null;
    private $words = [];
    private $wordCount = 0;

    private $excluded = ["\t", "\n", "\r", "\r\n", " ", "a", "and", "of","the", "to", "in", "as",
                        "that", "is", "for", "be", "with", "an", "would", "i", "or", "this", "on",
                        "are", "not", "could", "in", "have", "it", "was", "can", "more", "from",
                        "use", "most", "my", "his", "you", "he", "they", "were", "her", "had",
                        "s", "she", "at", "their", "out", "t", "up", "back", "may", "same", "those",
                        "been", "into", "down", "them", "we", "one", "what", "all", "but", "might",
                        "like", "some", "d", "about", "than", "around", "just", "him", "our", 
                        "what", "so", "get", "through", "over", "right", "me", "your", "let", "ve",
                        "one", "two", "three", "four", "five", "six", "seven", "eight", "nine",
                        "ten", "do", "always", "before", "see", "made", "no", "know", "go",
                        "there", "other", "got", "then", "return", "well", "which", "by", "will"];

    public function __construct()  {
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        $this->words = [];
    }

    public function getWhiteSpaceCount() {
        return substr_count($this->text, ' ');
    }

    public function getCounts() {
        $words = $this->getWords($this->text);
        $this->setWords($words);
        $wordCount = sizeof($words);
        $wordLength = $this->getAverageWordLength($words);
        $averageWordLength = $wordLength['averageWordLength'];
        $characterCount = $wordLength['characterCount'];

        $sentences = $this->getSentences($this->text);
        $sentenceCount = sizeof($sentences);
        $averageSentenceLength = $this->getAverageSentenceLength($sentences);

        $paragraphs = $this->getParagraphs($this->text);
        $paragraphCount = sizeof($paragraphs);
        $averageParagraphLength = $this->getAverageParagraphLength($paragraphs);

        $syllableResults = $this->countSyllables($this->text);
        $syllableCount = $syllableResults['syllables'];
        $polysyllables = $syllableResults['polysyllables'];

        $gunningIndex = $this->getGunningIndex($averageSentenceLength, $polysyllables, $wordCount);
        $fleschScore = $this->getFleschScore($wordCount, $sentenceCount, $syllableCount);
        $fleschKincaidGrade = $this->getFleschKincaid($wordCount, $sentenceCount, $syllableCount);
        $smogLevel = $this->getSmog($polysyllables, $sentenceCount);
        $colemanLiau = $this->getColemanLiau($characterCount, $sentenceCount, $wordCount);
        $ari = $this->getAri($characterCount, $wordCount, $sentenceCount);
        if ($smogLevel) {
            $averageGrade = ($gunningIndex + $fleschScore['grade'] + $fleschKincaidGrade + $smogLevel + $colemanLiau + $ari) / 6;
        }
        else {
            $averageGrade = ($gunningIndex + $fleschScore['grade'] + $fleschKincaidGrade + $colemanLiau + $ari) / 5;
        }

        return array(
            "words" => $words,
            "wordCount" => $wordCount,
            "syllables" => $syllableCount,
            "sentenceCount" => $sentenceCount,
            "paragraphCount" => $paragraphCount,
            "averageWordLength" => sprintf('%0.2f', $averageWordLength),
            "averageSentenceLength" => sprintf('%0.2f', $averageSentenceLength),
            "averageParagraphLength" => sprintf('%0.2f', $averageParagraphLength),
            "gunningIndex" => sprintf('%0.1f', $gunningIndex),
            "fleschScore" => sprintf('%0.1f', $fleschScore['score']),
            "fleschGrade" => $fleschScore['grade'],
            "fleschKincaidGrade" => sprintf('%0.1f', $fleschKincaidGrade),
            "smogLevel" => sprintf('%0.1f', $smogLevel),
            "colemanLiauGrade" => sprintf('%0.1f', $colemanLiau),
            "ari" => sprintf('%0.1f', $ari),
            "averageGrade" => sprintf('%0.1f', $averageGrade)
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
            $lowercaseWord = strtolower($word);
            $isExcluded = in_array($lowercaseWord, $this->excluded);
            $hasLength = strlen($word) > 1;
            
            if (!$isExcluded && $hasLength) {
                if (array_key_exists($lowercaseWord, $wordMap)) {
                    $wordMap[$lowercaseWord] += 1;
                }
                else {
                    $wordMap[$lowercaseWord] = 1;
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
            $word = rtrim($word, ' ,.\t\n\r!?#…;—:–)-/\'¿');
            $word = ltrim($word);
            $length = strlen($word);

            if ($length > 0) {
                $wordCount++;
                $totalCharacters += $length;
            }
        }

        return [
            'averageWordLength' => $wordCount > 0 ? $totalCharacters / $wordCount : 0,
            'characterCount' => $totalCharacters
        ];
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
        $syllable->getSource()->setPath(dirname($_SERVER['DOCUMENT_ROOT']) . '/writingbootsapp/resources/lang/syllables');
        $syllable->getCache()->setPath(dirname($_SERVER['DOCUMENT_ROOT']) . '/writingbootsapp/storage/framework/cache');
        $syllables = $syllable->countSyllablesText($text);
        $polysyllables = $syllable->countPolysyllablesText($text);
        return [
            'syllables' => $syllables,
            'polysyllables' => $polysyllables
        ];
    }

    public function getGunningIndex($averageSentenceLength, $polysyllables, $wordCount) {
        $percentagePolysyllables = 100 * ($polysyllables / $wordCount);
        $gunning = 0.4 * ($averageSentenceLength + $percentagePolysyllables);
        return $gunning;
    }

    public function getFleschScore($wordCount, $sentenceCount, $syllableCount) {
        $wordsToSentences = 1.015 * ($wordCount / $sentenceCount);
        $syllablesToWords = 84.6 * ($syllableCount / $wordCount);
        $flesch = 206.835 - $wordsToSentences - $syllablesToWords;

        $grade = "0";

        if ($flesch >= 90) {
            $grade = 5;
        }
        elseif ($flesch >= 80) {
            $grade = 6;
        }
        elseif ($flesch >= 70) {
            $grade = 7;
        }
        elseif ($flesch >= 65)
        {
            $grade = 8;
        }
        elseif ($flesch >= 60) {
            $grade = 9;
        }
        elseif ($flesch >= 57) {
            $grade = 10;
        }
        elseif ($flesch >= 54) {
            $grade = 11;
        }
        elseif ($flesch >= 50) {
            $grade = 12;
        }
        elseif ($flesch >= 40) {
            $grade = 13;
        }
        elseif ($flesch >= 30) {
            $grade = 14;
        }
        elseif ($flesch >= 15) {
            $grade = 15;
        }
        else {
            $grade = 16;
        }
        return [
            'score' => $flesch,
            'grade' => $grade
        ];
    }

    public function getFleschKincaid($wordCount, $sentenceCount, $syllableCount) {
        $wordsToSentences = 0.39 * ($wordCount / $sentenceCount);
        $syllablesToWords = 11.8 * ($syllableCount / $wordCount);
        $fleschKincaid = $wordsToSentences + $syllablesToWords - 15.59;

        return $fleschKincaid;
    }

    public function getSmog($polysyllables, $sentenceCount) {
        if ($sentenceCount >= 30) {
            $squareRoot = sqrt($polysyllables * (30 / $sentenceCount));
            $smog = 1.043 * $squareRoot + 3.1291;
        }
        else {
            $smog = 0;
        }

        return $smog;
    }

    public function getColemanLiau($characterCount, $sentenceCount, $wordCount) {
        $lettersToWords = 0.0588 * ($characterCount / $wordCount * 100);
        $sentencesToWords = 0.296 * ($sentenceCount / $wordCount * 100);
        $colemanLiauGrade = $lettersToWords - $sentencesToWords - 15.8;
        return $colemanLiauGrade;
    }

    public function getAri($characterCount, $wordCount, $sentenceCount) {
        $charactersToWords = 4.71 * ($characterCount / $wordCount);
        $wordsToSentences = 0.5 * ($wordCount / $sentenceCount);
        $ari = $charactersToWords + $wordsToSentences - 21.43;
        return $ari;
    }
}
