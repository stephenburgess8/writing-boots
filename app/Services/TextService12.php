<?php

namespace App\Services;

use Syllable;

class TextService
{
    private $text;
    private $title = null;
    private $words = [];
    private $wordCount = 0;

$spaces = ["\t", "\n", "\r", "\r\n", " "];
$articles = ["a", "an", "the", "some"];
$pronouns = ["i", "me", "you", "he", "him", "himself", "she", "her", "herself", "it", "we","us", "they", "them", "who", "whoever", "what", "something", "someone", "anyone"];
$demonstratives = ["this", "that", "these", "those"];
$possessives = ["my", "mine", "your", "yours", "his", "hers", "its", "our", "ours", "their", "theirs", "whose", "own"];
$interrogatives = ["which", "whichever", "what", "whatever", "whatsoever", "any", "either", "neither", "such", "certain"];
$quantifiers = ["much", "many", "little", "few", "fewer", "less", "least", "more", "most", "lot", "lots", "plenty", "several", "couple", "bit", "pair", "all", "both", "enough",  "each", "every", "everyone", "everywhere", "everything"];
$numbers = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth", "ninth", "tenth", "once", "twice", "half", "double", "triple", "quadruple", "hundred", "thousand", "million", "times", "equals", "subtract", "multiply", "divide", "number", "numbers"];
$adverbs = ["very", "too", "so", "here", "there", "quite", "almost", "certainly", "even", "then", "whether", "however", "still", "really", "out", "up", "somewhat", "rather", "fully", "especially", "ago", "ever", "never", "by", "just", "always", "not", "right", "now", "well", "how", "again", "away", "already", "yes", "no", "far", "nearly", "near", "maybe", "possibly"];
$adjectives = ["same", "other", "different", "only", "great", "good", "bad", "worst", "big", "small", "old", "young", "hard", "soft", "another", "long", "longer", "longest", "short", "shorter", "shortest", "first", "last", "late", "later", "latest", "next", "whole"];
$prepositions = ["in", "from", "with", "for", "to", "at", "on", "under", "upon", "until", "into", "down", "of", "as", "onto", "over", "through", "around", "about", "off", "after", "beside", "against", "without", "behind"];
$modals = ["can", "could", "may", "might", "shall", "should", "will", "would", "must"];
$commonNouns = ["word", "words", "thing", "things", "stuff", "room", "rooms", "floor", "night", "nights", "door", "bed", "beds", "question", "questions", "woman", "women", "man", "men", "boy", "boys", "girl", "girls", "sir", "mr", "mrs", "ms", "house", "houses", "days", "day", "back", "backs", "way", "ways", "answer", "person", "people", "rest", "side", "inside" ];
$bodyParts = ["shoulder", "shoulders", "eyes", "eye", "face", "faces", 'body', "bodies"];
$conjunctions = ["for", "and", "nor", "but" "or", "yet", "so", "after", "although", "as", "because", "before", "if", "once", "since" "than", "though", "till", "until", "when", "whenever", "where", "wherever", "while", "why"];

$other = ["oh", "hey", "course"];
$mostCommonVerbs = ["be", "being", "is", "am", "are", "were", "been", "was", "have", "has", "having", "had", "do", "does", "doing", "did", "say", "saying", "says", "said", "go", "going", "goes","went", "gone", "get", "getting", "gets", "got", "gotten", "make", "making", "makes", "made", "take", "taking", "takes", "took", "taken", "come", "coming", "comes", "came", "use", "using", "uses", "used", "know", "knowing", "knows", "knew", "think", "thinking", "thinks", "thought", "want", "wanting", "wants", "wanted", "look", "looking", "looks", "looked", "find", "finding", "finds", "found", "give", "giving", "gives", "gave", "given", "tell", "telling", "tells", "told", "keep", "keeping", "keeps", "kept", "call", "calling", "calls", "called", "try", "trying", "tries", "tried", "ask", "asking", "asks", "asked", "need", "needing", "needs", "needed", "feel", "feeling", "feels", "felt", "hold", "holding", "holds", "held", "become", "becoming", "becomes", "became", "live", "living", "lives", "lived", "leave", "leaving", "leaves", "left", "put", "putting", "puts", "like", "liking", "likes", "liked",  "mean", "meaning", "means", "meant", "let", "letting", "lets", "begin", "beginning", "begins", "began", "begun",  "seem", "seeming", "seems", "seemed", "bring", "bringing", "brings", "brought" ];
$commonVerbs = [ "realize", "realizing", "realizes", "realized", "help", "helping", "helps", "helped", "drink", "drinking", "drinks", "drank", "drunk", "talk", "talking", "talks", "talked", "turn", "turning", "turns", "turned", "return", "returning", "returns", "returned", "start", "starting", "starts", "started", "show", "showing", "shows", "showed", "hear", "hearing", "hears", "heard", "play", "playing", "plays", "played", "run", "running", "runs", "ran", "believe", "believing", "belives", "believed", "happen", "happening", "happens", "happened", "write", "writing", "writes", "wrote", "written", "provide", "providing", "provides", "provided", "sit", "sitting", "sits", "sat", "stand", "standing", "stands", "stood", "lose", "losing", "loses", "lost", "pay", "paying", "pays", "paid", "meet", "meeting", "meets", "met", "include", "including", "includes", "included", "continue", "continuing", "continues", "continued", "set", "setting", "sets", "learn", "learning", "learns", "learned", "change", "changing", "changes", "changed", "lead", "leading", "leads", "led", "understand", "understanding", "understands", "understood", "watch", "watching", "watches", "watched", "follow", "following", "follows", "followed", "stop", "stopping", "stops", "stopped", "create", "creating", "creates", "created", "speak", "speaking", "speaks", "spoke", "read", "reading", "reads", "allow", "allowing", "allows", "allowed"];
$lessCommonVerbs = [ "add", "adding", "adds", "added", "spend", "spending", "spends", "spent", "grow", "growing", "grows", "grew", "open", "opening", "opens", "opened", "walk", "walking", "walks", "walked", "win", "winning", "wins", "won", "offer", "offering", "offers", "offered", "remember", "remembering", "remembers", "remembered", "love", "loving", "loves", "loved", "hate", "hating", "hates", "hated", "consider", "considering", "considers", "considered", "appear", "appearing", "appears", "appeared", "buy", "buying", "buys", "bought", "wait", "waiting", "waits", "waited", "serve", "serving", "serves", "served", "die", "dieing", "dies", "died", "send", "sending", "sends", "sent", "build", "building", "builds", "built", "expect", "expecting", "expects", "expected", "stay", "staying", "stays", "stayed", "fall", "falling", "falls", "fell", "cut", "cutting", "cuts", "reach", "reaching", "reaches", "reached", "kill", "killing", "kills", "killed", "remain", "remaining", "remains", "remained", "suggest", "suggesting", "suggests", "suggested", "raise", "raising", "raises", "raised", "pass", "passing", "passes", "passed", "sell", "selling", "sells", "sold", "require", "requiring", "requires", "required", "report", "reporting", "reports", "reported", "decide", "deciding", "decides", "decided", "pull", "pulling", "pulls", "pulled", "reply", "replying", "replies", "replied", "eat", "eating", "eats", "ate", "move", "moving", "moves", "moved", "join", "joining", "joins", "joined", "deal", "dealing", "deals", "dealt"];
    

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
        $cleanedText = str_replace(["can’t", "can't"], "can not", $textString);
        $cleanedText = str_replace(["n’t", "n't"], " not", $cleanedText);
        $cleanedText = str_replace(["’ve", "'ve"], " have", $cleanedText);
        $cleanedText = str_replace(["’ll", "'ll"], " will", $cleanedText);
        $cleanedText = str_replace(["’d", "'d"], " had", $cleanedText);
        $cleanedText = str_replace(["\"", ';', ':', ',', '.', '?', '¿', '!', "#", "…", "’s", "'s", 
             "’", "“", "”", "[", "]", "<", ">", "(", ")"], '', $cleanedText);
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
            $word = rtrim($word, ' ,.\t\n\r!?#[]<>…;—:(–)-/\'¿');
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
