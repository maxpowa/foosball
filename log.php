<?php

require_once('players.php');

function compareLog($a, $b)
{
    $x = $a[0];
    $y = $b[0];
    return ($x == $y) ? 0 : (($x < $y) ? 1 : -1);
}

function gameLog()
{
    $count = (int)(isset($_REQUEST['count']) ? $_REQUEST['count'] : 100);

    $games = file_get_contents('games.log');
    $games = explode("\n", $games);

    $result = array();
    foreach ($games as $game) {
        if (empty($game)) {
            continue;
        }
        $game = explode("\t", $game);
        if (count(explode(",", $game[3])) == 1) {
            continue;
        }
        $result[] = array($game[0], $game[1], $game[2], $game[3]);
    }

    if (count($result) > $count) {
        $result = array_slice($result, -$count);
    }
    usort($result, 'compareLog');

    return $result;
}
