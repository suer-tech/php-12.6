<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];
//Функция получения ФИО в виде строки;
function getFullname($user){
    foreach ($user as $fullname => $name) {
        if ($fullname == 'fullname') {
            return $name;
        }
    }
}
//Функция Разбивки ФИО на составляющие;
function getPartsFromFullname($name){
    $namevalue = [];
    $separator = ' ';
    $tok = strtok($name, $separator);
    while($tok) {
        $namevalue[] = $tok;
        $tok = strtok($separator);
    }
    $namekey = [
        'surname' => 'surname',
        'name' => 'name',
        'patronomyc' => 'patronomyc',
    ];
    $namecombine = array_combine($namekey, $namevalue);
    return $namecombine;
}

//Функция объединения ФИО в одну строку;
function getFullnameFromParts($surname, $name, $patronomyc){
    return ($surname . ' ' . $name . ' ' . $patronomyc);
}

//Функция Скоращения ФИО;
function getShortName($fullname){
    $name_array = getPartsFromFullname($fullname);
    foreach($name_array as $key => $item_name){
        if ($key == 'surname'){
            $surname = $item_name[0];
            
        }
        if ($key == 'name'){
            $name = $item_name;
        }
        unset($name_array[3]);
        $short_name = $name . ' ' . $surname . '' . '.';
        return $short_name;
    }
}

//Функция Определения пола по ФИО;
function getGenderFromName($fullname){
    $i = 0;
    $name_array = getPartsFromFullname($fullname);
    foreach ($name_array as $key => $item_name) {
        if ($key == 'surname') {
            $fem_surname = 'ова';
            $pos_fem_surname = mb_strripos($item_name, $fem_surname, mb_strlen($item_name)-3);
            if ($pos_fem_surname){
                $i = -1;
            }
            $m_surname = 'в';
            $pos_m_surname = mb_strripos($item_name, $m_surname, mb_strlen($item_name)-1);
            if ($pos_m_surname){
                $i = 1;
            }
        }
        
        if ($key == 'name') {
            $fem_name = 'а';
            $pos_fem_name = mb_strripos($item_name, $fem_name, mb_strlen($item_name)-1);
            if ($pos_fem_name){
                $i = $i - 1;
            }
            $m_name = 'й'||'н';
            $pos_m_name = mb_strripos($item_name, $m_name, mb_strlen($item_name)-1);
            if ($pos_m_name){
                $i = $i + 1;
            }
        }
        
        if ($key == 'patronomyc') {
            $fem_patronomyc = 'вна';
            $pos_fem_patronomyc = mb_strripos($item_name, $fem_patronomyc, mb_strlen($item_name)-3);
            if ($pos_fem_patronomyc){
                $i = $i - 1;
            }
            $m_patronomyc = 'ич';
            $pos_m_patronomyc = mb_strripos($item_name, $m_patronomyc, mb_strlen($item_name)-2);
            if ($pos_m_patronomyc){
                $i = $i + 1;
            }
        }
    }
    if ($i < 0){
        return -1;
    }
    if ($i > 0){
        return 1;
    }
    if ($i == 0){
        return 0;
    }
}
echo(getGenderFromName(getFullname($example_persons_array[10])));
?>
</body>
</html>