<?php

/**
 * Created by PhpStorm.
 * User: misha
 * Date: 13.10.17
 * Time: 9:08
 */
class Progression
{
    /**
     * @var array
     */
    private $sequence = [];

    /**
     * @param $sequence
     * @return string
     */
    public static function detectProgressionType($sequence)
    {
        $progression = new Progression($sequence);
        $progression->validateSequence();
        if ($progression->isGeometric()) {
            return 'progression is Geometric';
        } elseif ($progression->isArithmetic()) {
                return 'progression is Arithmetic';
            }
        return false;
    }

    /**
     * Progression constructor.
     * @param $sequence
     */
    public function __construct($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * @return bool
     */
    private function isArithmetic()
    {
        $sequence = $this->sequence;
        $delta = $sequence[1] - $sequence[0];
        for ($index = 0; $index < sizeof($sequence) - 1; $index++) {
            if (($sequence[$index + 1] - $sequence[$index]) != $delta) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    private function isGeometric()
    {
        $sequence = $this->sequence;
        if (sizeof($sequence) <= 1)
            return true;
        # Calculate ratio
        $ratio = $sequence[1] / $sequence[0];

        # Check the ratio of the remaining
        for ($i = 1; $i < sizeof($sequence); $i++) {
            if (($sequence[$i] / ($sequence[$i - 1])) != $ratio) {
                return false;
            }
        }
        return true;
    }

    /**
     * @throws Exception
     */
    private function validateSequence(){
        foreach ($this->sequence as &$value) {
            $value = trim($value);
            if (!is_numeric($value)) {
                throw new Exception('Sequence is not valid');
            }
        }
        if(!count($this->sequence))  throw new Exception('Sequence cannot be empty');
    }
}