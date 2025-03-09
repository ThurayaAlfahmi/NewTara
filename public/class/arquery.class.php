<?php

class ArQuery {
    private $fields = [];
    private $wordCondition = [];
    private $mode;

    public function setArrFields(array $arrConfig): bool {
        $this->fields = $arrConfig;
        return count($this->fields) > 0;
    }

    public function setStrFields(string $strConfig): bool {
        $this->fields = explode(",", $strConfig);
        return count($this->fields) > 0;
    }

    public function setMode(int $mode): bool {
        $this->mode = $mode;
        return isset($this->mode);
    }

    public function getMode(): int {
        return $this->mode;
    }

    public function getArrFields(): array {
        return $this->fields;
    }

    public function getStrFields(): string {
        return implode(",", $this->fields);
    }

    public function getWhereCondition(string $arg): string {
        $phrase = explode("\"", $arg);
        if (count($phrase) > 2) {
            $arg = "";
            for ($i = 0; $i < count($phrase); $i++) {
                if ($i % 2 === 0 && $phrase[$i] !== "") {
                    $arg .= $phrase[$i];
                } elseif ($i % 2 === 1 && $phrase[$i] !== "") {
                    $this->wordCondition[] = $this->getWordLike($phrase[$i]);
                }
            }
        }

        $words = explode(" ", $arg);

        foreach ($words as $word) {
            if ($word !== "") {
                $this->wordCondition[] = $this->getWordRegExp($word);
            }
        }

        if ($this->mode === 0) {
            $sql = "(" . implode(") OR (", $this->wordCondition) . ")";
        } elseif ($this->mode === 1) {
            $sql = "(" . implode(") AND (", $this->wordCondition) . ")";
        }

        return $sql;
    }

    private function getWordRegExp(string $arg): string {
        $arg = $this->lex($arg);
        return "" . implode(" REGEXP '$arg' OR ", $this->fields) . " REGEXP '$arg'";
    }

    private function getWordLike(string $arg): string {
        return "" . implode(" LIKE '$arg' OR ", $this->fields) . " LIKE '$arg'";
    }

    function lex($arg) {
        $patterns = array();
        $replacements = array();


        array_push($patterns, '/^ال/'); array_push($replacements,'(ال)?');

        array_push($patterns, '/(\S{3,})تين$/'); array_push($replacements, '\\1(تين|ة)?');
        array_push($patterns, '/(\S{3,})ين$/'); array_push($replacements, '\\1(ين)?');
        array_push($patterns, '/(\S{3,})ون$/'); array_push($replacements, '\\1(ون)?');
        array_push($patterns, '/(\S{3,})ان$/'); array_push($replacements, '\\1(ان)?');
        array_push($patterns, '/(\S{3,})تا$/'); array_push($replacements, '\\1(تا)?');
        array_push($patterns, '/(\S{3,})ا$/'); array_push($replacements, '\\1(ا)?');
        array_push($patterns, '/(\S{3,})(ة|ات)$/'); array_push($replacements, '\\1(ة|ات)?');


        array_push($patterns, '/(\S{3,})هما$/'); array_push($replacements, '\\1(هما)?');
        array_push($patterns, '/(\S{3,})كما$/'); array_push($replacements, '\\1(كما)?');
        array_push($patterns, '/(\S{3,})ني$/'); array_push($replacements, '\\1(ني)?');
        array_push($patterns, '/(\S{3,})كم$/'); array_push($replacements, '\\1(كم)?');
        array_push($patterns, '/(\S{3,})تم$/'); array_push($replacements, '\\1(تم)?');
        array_push($patterns, '/(\S{3,})كن$/'); array_push($replacements, '\\1(كن)?');
        array_push($patterns, '/(\S{3,})تن$/'); array_push($replacements, '\\1(تن)?');
        array_push($patterns, '/(\S{3,})نا$/'); array_push($replacements, '\\1(نا)?');
        array_push($patterns, '/(\S{3,})ها$/'); array_push($replacements, '\\1(ها)?');
        array_push($patterns, '/(\S{3,})هم$/'); array_push($replacements, '\\1(هم)?');
        array_push($patterns, '/(\S{3,})هن$/'); array_push($replacements, '\\1(هن)?');
        array_push($patterns, '/(\S{3,})وا$/'); array_push($replacements, '\\1(وا)?');
        array_push($patterns, '/(\S{3,})ية$/'); array_push($replacements, '\\1(ي|ية)?');
        array_push($patterns, '/(\S{3,})ن$/'); array_push($replacements, '\\1(ن)?');


        array_push($patterns, '/(ة|ه)$/'); array_push($replacements, '(ة|ه)');
        array_push($patterns, '/(ة|ت)$/'); array_push($replacements, '(ة|ت)');
        array_push($patterns, '/(ي|ى)$/'); array_push($replacements, '(ي|ى)');
        array_push($patterns, '/(ا|ى)$/'); array_push($replacements, '(ا|ى)');
        array_push($patterns, '/(ئ|ىء|ؤ|وء|ء)/'); array_push($replacements, '(ئ|ىء|ؤ|وء|ء)');


        array_push($patterns, '/ّ|َ|ً|ُ|ٌ|ِ|ٍ|ْ/'); array_push($replacements, '(ّ|َ|ً|ُ|ٌ|ِ|ٍ|ْ)?');
        array_push($patterns, '/ا|أ|إ|آ/'); array_push($replacements, '(ا|أ|إ|آ)');

        $arg = preg_replace($patterns, $replacements, $arg);

        return $arg;
    }
}
?>
