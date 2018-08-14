<?php

namespace App\Services;

use Syllable;

class TextService
{
    private $text;
    private $title = null;
    private $words = [];
    private $wordCount = 0;

    private $spaces = ["\t", "\n", "\r", " "];

    // Word lists for exclusion
    // Function words
    protected $articles = ["a", "an", "the", "some"];

    protected $conjunctions = [
        "after", "although", "and", "as", "because", "before", "but", "for", "if",
        "nor", "once", "or", "since", "so", "than", "though", "till", "until",
        "when", "whenever", "where", "wherever", "while", "why", "yet"
    ];

    protected $demonstratives = ["that", "these", "this", "those"];
    
    protected $interjections = [
        "ah", "course", "hey", "oh", "no", "thanks", "yeah", "yes"
    ];

    protected $interrogatives = [
        "any", "certain", "either", "neither", "whatever", "whatsoever", "which",
        "whichever", "such"
    ];

    protected $modals = [
        "can", "could", "may", "might", "must", "shall", "should", "will", "would"
    ];

    protected $possessives = [
        "hers", "his", "its", "mine", "my", "our", "ours",  "own", "their",
        "theirs", "whose","your", "yours"
    ];

    protected $prepositions = [
        "about", "against", "after", "around", "at", "as", "behind", "beside",
        "down", "for", "from", "in", "into", "of", "off", "on", "onto", "over",
        "through", "to", "under", "until", "upon", "with", "without" 
    ];

    protected $pronouns = [
        "anyone", "he", "her", "herself", "him", "himself", "i", "it", "me", "she",
        "someone", "something", "them", "they", "us", "we", "what", "who",
        "whoever", "you"
    ];

    protected $quantifiers = [
        "all", "bit", "both", "couple", "each", "enough", "every", "everyone",
        "everything", "everywhere", "few", "fewer", "least", "less", "little",
        "lot", "lots", "many", "more", "most", "much", "pair", "plenty", "several"  
    ];

    // Content words
    protected $adverbs = [
        "again",  "ago", "almost", "already", "always", "away", "by", "certainly",
        "especially", "even", "ever", "far", "fully", "here", "how", "however",
        "inside", "just", "maybe", "near", "nearly", "never", "not", "now", "out",
        "possibly", "quite", "rather",  "really", "right", "so", "somewhat",
        "still", "then", "there", "too", "up", "very", "well", "whether"
    ];

    protected $adjectives = [
        "another", "bad", "big", "different", "first", "good", "great", "hard",
        "last", "late", "later", "latest", "long", "longer", "longest", "next",
        "old", "only", "other", "same", "short", "shorter", "shortest", "small",
        "soft", "whole", "worst", "young"
    ];

    protected $numbers = [
        // "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "zero", "one", "two", "three", "four", "five", "six", "seven", "eight",
        "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen",
        "sixteen", "seventeen", "eighteen", "nineteen", "twenty",
        "thirty", "fourty", "fifty", "sixty", "seventy", "eighty", "ninety",
        "hundred", "thousand", "million", "billion", "trillion",
        "first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth",
        "ninth", "tenth", "once", "twice", "half", "double", "triple", "quadruple",
        "times", "equals", "subtract", "multiply", "divide", "number", "numbers"
    ];

    // Nouns
    protected $abstractNouns = [
        "answer", "answers", "art", "business", "businesses", "case", "cases",
        "change", "changes", "education", "fact", "facts", "force", "forces",
        "game", "games", "government", "governments", "health", "history",
        "information", "issue", "issues", "job", "jobs", "kind", "kinds",
        "law", "laws", "level", "levels", "life", "lives", "lot", "lots",
        "name", "names", "point", "points", "power", "powers",
        "problem", "problems", "program", "programs", "question", "questions",
        "research", "reason", "reasons", "result", "results", "rest",
        "right", "rights", "service", "services", "sort", "sorts",
        "stories", "story", "system", "systems", "war", "way", "ways",
        "word", "words"
    ];

    protected $bodyNouns = [
        "arm", "arms", "back", "backs", "body", "bodies", "brow", "calf", "calves",
        "cheek", "cheeks", "chest", "chin", "ear", "ears", "eye", "eyes",
        "face", "faces", "feet", "fingers", "forehead", "foot", "hair", "head",
        "heel", "heels", "hip", "hips", "knee", "knees", "leg", "legs",
        "lip", "lips", "mouth", "neck", "palm", "palms", "shin", "shins",
        "shoulder", "shoulders", "stomach", "thigh", "thighs", "toe", "toes",
        "torso", "waist", "wrist", "wrists"
    ];

    protected $peopleNouns = [
        "boy", "boys", "child", "children", "community", "communities",
        "company", "companies", "daughter", "daughters", "families", "family",
        "father", "fathers", "friend", "friends", "girl", "girls",
        "group", "groups", "guy", "guys", "kid", "kids", "man", "member", "members",
        "men", "mother", "mothers", "mr", "mrs", "ms", "others",
        "parent", "parents", "party", "person", "people", "sir", "son", "sons",
        "student", "students", "teacher", "teachers", "team", "teams",
        "woman", "women"
    ];

    protected $placeObjectNouns = [
        "air", "area", "areas", "bed", "beds", "book", "books", "car", "cars",
        "cities", "city", "door", "doors", "earth", "end", "ends", "fire",
        "floor", "floors", "home", "homes", "house", "houses", "line", "lines", 
        "metal", "money", "object", "objects", "part", "parts", "place", "places",
        "room", "rooms", "school", "schools", "side", "sides", "state", "states",
        "stuff", "thing", "things", "water", "world"
    ];

    protected $timeNouns = [
        "day", "days", "hour", "hours", "minute", "minutes", "moment", "moments",
        "month", "months", "morning", "mornings", "night", "nights",
        "time", "times", "week", "weeks", "year", "years"
    ];

    // Verbs
    protected $mostCommonVerbs = [
        "ask", "asking", "asks", "asked",
        "be", "being", "is", "am", "are", "were", "been", "was",
        "become", "becoming", "becomes", "became",
        "begin", "beginning", "begins", "began", "begun",
        "bring", "bringing", "brings", "brought",
        "call", "calling", "calls", "called",
        "come", "coming", "comes", "came",
        "do", "does", "doing", "did",
        "feel", "feeling", "feels", "felt",
        "find", "finding", "finds", "found",
        "get", "getting", "gets", "got", "gotten",
        "give", "giving", "gives", "gave", "given",
        "go", "going", "goes","went", "gone",
        "have", "has", "having", "had",
        "hold", "holding", "holds", "held",
        "keep", "keeping", "keeps", "kept",
        "know", "knowing", "knows", "knew",
        "leave", "leaving", "leaves", "left",
        "let", "letting", "lets",
        "like", "liking", "likes", "liked",
        "live", "living", "lives", "lived",
        "look", "looking", "looks", "looked",
        "make", "making", "makes", "made",
        "mean", "meaning", "means", "meant",
        "need", "needing", "needs", "needed",
        "put", "putting", "puts",
        "say", "saying", "says", "said",
        "seem", "seeming", "seems", "seemed",
        "take", "taking", "takes", "took", "taken",
        "tell", "telling", "tells", "told",
        "think", "thinking", "thinks", "thought",
        "try", "trying", "tries", "tried",
        "use", "using", "uses", "used",
        "want", "wanting", "wants", "wanted"
    ];

    protected $commonVerbs = [
        "allow", "allowing", "allows", "allowed",
        "believe", "believing", "belives", "believed",
        "change", "changing", "changes", "changed",
        "continue", "continuing", "continues", "continued",
        "create", "creating", "creates", "created",
        "drink", "drinking", "drinks", "drank", "drunk",
        "follow", "following", "follows", "followed",
        "happen", "happening", "happens", "happened",
        "hear", "hearing", "hears", "heard",
        "help", "helping", "helps", "helped",
        "include", "including", "includes", "included",
        "lead", "leading", "leads", "led",
        "learn", "learning", "learns", "learned",
        "lose", "losing", "loses", "lost",
        "meet", "meeting", "meets", "met",
        "pay", "paying", "pays", "paid",
        "play", "playing", "plays", "played",
        "provide", "providing", "provides", "provided",
        "read", "reading", "reads",
        "realize", "realizing", "realizes", "realized",
        "return", "returning", "returns", "returned",
        "run", "running", "runs", "ran",
        "set", "setting", "sets",
        "show", "showing", "shows", "showed",
        "sit", "sitting", "sits", "sat",
        "speak", "speaking", "speaks", "spoke",
        "stand", "standing", "stands", "stood",
        "start", "starting", "starts", "started",
        "stop", "stopping", "stops", "stopped",
        "talk", "talking", "talks", "talked",
        "turn", "turning", "turns", "turned",
        "understand", "understanding", "understands", "understood",
        "watch", "watching", "watches", "watched",
        "write", "writing", "writes", "wrote", "written"
    ];

    protected $lessCommonVerbs = [
        "add", "adding", "adds", "added",
        "appear", "appearing", "appears", "appeared",
        "build", "building", "builds", "built",
        "buy", "buying", "buys", "bought",
        "consider", "considering", "considers", "considered",
        "cut", "cutting", "cuts",
        "deal", "dealing", "deals", "dealt",
        "decide", "deciding", "decides", "decided",
        "die", "dieing", "dies", "died",
        "eat", "eating", "eats", "ate",
        "expect", "expecting", "expects", "expected",
        "fall", "falling", "falls", "fell",
        "grow", "growing", "grows", "grew",
        "hate", "hating", "hates", "hated",
        "join", "joining", "joins", "joined",
        "kill", "killing", "kills", "killed",
        "love", "loving", "loves", "loved",
        "move", "moving", "moves", "moved",
        "open", "opening", "opens", "opened",
        "offer", "offering", "offers", "offered",
        "pass", "passing", "passes", "passed",
        "pull", "pulling", "pulls", "pulled",
        "raise", "raising", "raises", "raised",
        "reach", "reaching", "reaches", "reached",
        "remain", "remaining", "remains", "remained",
        "remember", "remembering", "remembers", "remembered",
        "reply", "replying", "replies", "replied",
        "report", "reporting", "reports", "reported",
        "require", "requiring", "requires", "required",
        "sell", "selling", "sells", "sold",
        "send", "sending", "sends", "sent",
        "serve", "serving", "serves", "served",
        "spend", "spending", "spends", "spent",
        "stay", "staying", "stays", "stayed",
        "suggest", "suggesting", "suggests", "suggested",
        "wait", "waiting", "waits", "waited",
        "walk", "walking", "walks", "walked",
        "win", "winning", "wins", "won"
    ];

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
            $excludedWords = $this->getExcludedWords();
            $isExcluded = in_array($lowercaseWord, $excludedWords);
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

    private function getExcludedWords() {
        return array_merge($this->spaces, $this->articles, $this->conjunctions, $this->demonstratives, $this->interjections, $this->interrogatives, $this->modals, $this->possessives, $this->prepositions, $this->pronouns, $this->quantifiers, $this->adverbs, $this->adjectives, $this->numbers, $this->abstractNouns, $this->placeObjectNouns, $this->peopleNouns, $this->timeNouns, $this->bodyNouns, $this->mostCommonVerbs, $this->commonVerbs, $this->lessCommonVerbs);
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
