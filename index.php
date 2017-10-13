<?php
include "Progression.php";
/**
 * Created by PhpStorm.
 * User: misha
 * Date: 13.10.17
 * Time: 11:20
 */

$sequence = getSequence($argv);
$progression = Progression::detectProgressionType($sequence);
echo (($progression !== false) ? 'this is progression' : 'this is not progression') . PHP_EOL;

/**
 * @param $argv
 * @return array
 */
function getSequence($argv)
{
    if (is_array($argv) && count($argv) >= 2) {
        return explode(',',$argv[1] );
    }
    return [];
}