<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('error_reporting', E_ALL);
    session_start();
    require 'functions.php';
    require 'cities.php';
    if(!isset($_POST['submit'])) {
        $_SESSION['cities'] = $cityList;
    }
    $isWon = false;
?>
<!doctype html>

<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>«Города»</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="enterprise.png" type="image/x-icon">
</head>

<body>
<div class="container-fluid">
<div class="row mt-5">
            <div class="col">
                <?php
                
                    if(isset($_POST['submit'])) {
                        $city = $_POST['city'];
                        if (!isset($_SESSION['usedLetter'])) {
                            $index = array_search($city, $_SESSION['cities']);
                            $choosedCity = $_SESSION['cities'][$index];
                            echo 'Ваш город: '.$choosedCity;
                            echo '</br>Ищем город на букву: '.lastLetterCheck($city);
                            unset($_SESSION['cities'][$index]);
                            sort($_SESSION['cities']);
                            for ($i = 0; $i <= count($_SESSION['cities'])-1; $i++) {
                                if (lastLetterCheck($city) == firstLetter($_SESSION['cities'][$i])){
                                    $foundCity = $_SESSION['cities'][$i];
                                    $foundIndex = $i;
                                    break;
                                }
                            }
                            if (!empty($foundCity)){
                                echo '</br>Город программы: '.$foundCity;
                                if (lastLetter($foundCity) == 'Ъ' || lastLetter($foundCity) == 'Ь' || lastLetter($foundCity) == 'Ы'){
                                    $_SESSION['usedLetter'] = lastSecondLetter($foundCity);
                                }else {
                                    $_SESSION['usedLetter'] = lastLetter($foundCity);
                                }
                                echo '</br>Вам надо выбрать город на букву "'.$_SESSION['usedLetter'].'"';
                                unset($_SESSION['cities'][$foundIndex]);
                                sort($_SESSION['cities']);
                                for ($i = 0; $i <= count($_SESSION['cities'])-1; $i++) {
                                    $citiesArray[] = firstLetter($_SESSION['cities'][$i]);
                                }
                                if (array_search($_SESSION['usedLetter'], $citiesArray) === false){
                                    echo '</br> У вас не осталось города на букву "'.$_SESSION['usedLetter'].'"';
                                    echo '</br><h3>Вы проиграли!</h3>';
                                    $isWon = true;
                                }
                            }else {
                                $isWon = true;
                                echo '</br> Программа не знает города на букву "'.lastLetterCheck($city).'"';
                                echo '</br><h3>Вы победили!</h3>';
                            }
                        }
                        else {
                            if ($_SESSION['usedLetter'] == firstLetter($city)) {
                                $index = array_search($city, $_SESSION['cities']);
                                $choosedCity = $_SESSION['cities'][$index];
                                echo 'Ваш город: '.$choosedCity;
                                echo '</br>Ищем город на букву: '.lastLetterCheck($city);
                                unset($_SESSION['cities'][$index]);
                                sort($_SESSION['cities']);
                                for ($i = 0; $i <= count($_SESSION['cities'])-1; $i++) {
                                    if (lastLetterCheck($city) == firstLetter($_SESSION['cities'][$i])){
                                        $foundCity = $_SESSION['cities'][$i];
                                        $foundIndex = $i;
                                        break;
                                    }
                                }
                                if (!empty($foundCity)){
                                    echo '</br>Город программы: '.$foundCity;
                                    if (lastLetter($foundCity) == 'Ъ' || lastLetter($foundCity) == 'Ь' || lastLetter($foundCity) == 'Ы'){
                                        $_SESSION['usedLetter'] = lastSecondLetter($foundCity);
                                    }else {
                                        $_SESSION['usedLetter'] = lastLetter($foundCity);
                                    }
                                    echo '</br>Вам надо выбрать город на букву "'.$_SESSION['usedLetter'].'"';
                                    unset($_SESSION['cities'][$foundIndex]);
                                    sort($_SESSION['cities']);
                                    for ($i = 0; $i <= count($_SESSION['cities'])-1; $i++) {
                                        $citiesArray[] = firstLetter($_SESSION['cities'][$i]);
                                    }
                                    if (array_search($_SESSION['usedLetter'], $citiesArray) === false){
                                        echo '</br> У вас не осталось города на букву "'.$_SESSION['usedLetter'].'"';
                                        echo '</br><h3>Вы проиграли!</h3>';
                                        $isWon = true;
                                    }
                                }else {
                                    $isWon = true;
                                    echo '</br> Программа не знает города на букву "'.lastLetterCheck($city).'"';
                                    echo '</br><h3>Вы победили!</h3>';
                                }
                            }
                            else {
                                echo 'Неправильно выбран город.</br>Вам надо выбрать город на букву "'.$_SESSION['usedLetter'].'"';
                            }
                        }
                
                    }
                ?>
            </div>

        <div class="col">
        <form action="" method="POST">
                    <div class="form-group">
                    <label for="cityHolder">Выберите город:</label>
                    <select class="form-control" name="city" <?php if ($isWon == true){echo 'disabled';} ?>>
                        <?php
                            echoCityValue($_SESSION['cities']);
                        ?>
                    </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success mt-2" <?php if ($isWon == true){echo 'disabled';} ?>>Играть</button>
                </form>
                <form action="destroy.php" method="POST">
                <button type="submit" class="btn btn-danger mt-2">Начать заново</button>
                </form>
        </div>
        </div>


    </div>
        <div class="row mt-5 ml-3">
            <h5>Список городов, доступных игроку и программе:</h5>
        </div>

        <div class="row mt-1 ml-3">
        <?php
            echoCityList();
        ?>
        </div>
</body>
</html>