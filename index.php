<?php
/**
 *
 * +Вхідна точка програми - index.php
 * +Можна використовувати сервер з попередніх уроків по LEMP
 * -Тут потрібно ініціалізувати початковий двовимірний ($Array[$n][$n]) масив випадковими числами.
 * -Відсортувати згенерований масив всіма потрібними способами.
 * -Вивести на сторінку результати. На верстці та стилях можна сильно не зосереджуватись.
 * -Записати результати в файл. Можна один файл для всіх, можна в окремі файли.
 * -Генерацією початкового масиву і окремі види сортування повинні бути реалізовані окремими сутностями.
 * -Розділити сутності по окремих файлах, які будуть підключатись через Composer Autoloader.
 * -Подумати як використати ексепшини в коді.
 * -В результаті - при кожному вході з браузера на http://server_domain_or_IP/index.php має згенеруватись
 *     новий початковий масив, відсортуватись всіма способами і вивестись на сторінку, паралельно записавши
 *     ці результати в файл(и).
 */

require_once realpath("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$application = new \App\App();
$application->run();
