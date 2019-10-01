<?php

function echoCityList() {
    for ($i = 0; $i <= count($_SESSION['cities'])-1; $i++) {
        echo '<div class="col-sm-2 mt-1" style="font-size: 0.8em;">';
        echo '• '.$_SESSION['cities'][$i].'</br>';
        echo '</div>';
    }
}

function echoCityValue($cities) {
    for ($i = 0; $i <= count($cities)-1; $i++) {
        echo "<option value=\"$cities[$i]\">$cities[$i]</option>";
    }
}

function lastLetter($word) {
    $letters = iconv_strlen($word,'UTF-8');
    $lastLetter = mb_strtoupper(mb_substr($word, $letters-1, $letters, 'utf-8'));
    return $lastLetter;
}

function lastSecondLetter($word) {
    $letters = iconv_strlen($word,'UTF-8');
    $lastLetter = mb_strtoupper(mb_substr($word, $letters-2, 1, 'utf-8'));
    return $lastLetter;
}

function firstLetter($word) {
    $firstLetter = mb_substr($word, 0, 1, 'utf-8');
    return $firstLetter;
}

function echoCities($cities) {
    for ($i = 0; $i <= count($cities)-1; $i++) {
        echo $cities[$i].'</br>';
    }
}

function lastLetterCheck($city) {
    if (lastLetter($city) == 'Ъ' || lastLetter($city) == 'Ь' || lastLetter($city) == 'Ы'){
        return $lastLetter = lastSecondLetter($city);
    }else {
        return $lastLetter = lastLetter($city);
    }
}

?>

