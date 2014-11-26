<?php

error_reporting(E_ALL); // указываем какие типы ошибок хотим выводить
ini_set('display_errors', '1'); // указываем что хотим видеть ошибки на экране

function arr_get($array, $key, $default = NULL) {
    return isset($array[$key]) ? $array[$key] : $default;
}

function mysql_connect() {
    $conntect = mysql_connect("localhost", "username", "password"); // здесь заменяешь username и password на свои
    mysql_select_db("database", $conntect); // здесь вказываешь название базы данных
}

function login() {
    $id = (int)arr_get($_GET, 'id', 0); // получаем параметр ?id=12345, если такого параметра нет то выставится 0
    if ($id) { // проверяем пришел ли параметр ?id=12345
        mysql_connect(); // Подключаемся к серверу MySQL и указываем базу данных
        mysql_query("INSERT INTO table (field1, field2, field3) VALUES ('value1', 'value2', 'value3')");
    }
}

$is_auth = arr_get($_GET, 'token') == sha1('твой сеерктный ключ'); // здесь проверяешь на свой секретный ключ
$action = arr_get($_GET, 'action'); // здесь получаешь параметр ?action=login

$functions = array('login'); // здесь ты указываешь какие функции можно передавать и вызывать в параметре ?action=login

if ($is_auth && in_array($action, $functions) !== FALSE) call_user_func($action); // если проверка проходит то вызывается функция переданная в параметре ?action=login -> будет вызвана функция login();
