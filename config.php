<?php

define('ANG_HOST', 'localhost');
define('ANG_DBNAME', 'u66745_porter');
define('ANG_DBUSER', 'root');
define('ANG_DBPASS', 'manhee33338');



// define('ANG_HOST', 'u66745.mysql.masterhost.ru');
// define('ANG_DBNAME', 'u66745_porter');
// define('ANG_DBUSER', 'u66745');
// define('ANG_DBPASS', 'PigU6n4_.G');



$path = $_SERVER['DOCUMENT_ROOT'] . '/';
define('ANG_ROOT', $path);
define('ANG_MAP', 'ANG_ROOT');
@define('ANG_HTTP', 'http://' . $_SERVER['SERVER_NAME'] . ':8078');
define('PRICE', 'all.csv');  //Inserting price to insert
define('VAL', 'val.csv'); //Прайс лист валовая прибыль по сотрудникам
define('VALMONTH', 'val2.csv'); //Прайс лист валовая прибыль по месяцам за год
define('WAREHOUSE', 'warehouse.csv');//Остатки на складе
define('CHECK', 'check.csv');
define('DOSTAVKA2', '8000');
define('DOSTAVKA', '6000');
define('DOSTAVKA_COST', '290');
define('WORK_FROM_DAYS', '09:00');//рабочие дни со скольки
define('WORK_TO_DAYS', '19:00');// рабочие дни до скольки
define('WORK_FROM_WEEKENDS', '9:00');//выходные дни со скольки
define('WORK_TO_WEEKENDS', '19:00');// выходные дни до скольки
define('PROFIT_NORM_EMPLOYEE', '150000');// Норма прибыли на одного сотрудника
define('TELEPHONE1', '8 (499) 348-99-53'); //Телефон основной на ангара 77
define('TELEPHONE_LINK', '+74993489953'); //тот же телеон для подстановки в теги ссылок
define('TELEPHONE_FREE', '8 (800) 200-99-53'); //Бесплатный телефон формат
define('TELEPHONE_FREE_LINK', '+78002009953'); //Бесплатный  телефон для ссылок
define('TELEPHONE_OLD', '8 (495) 646-99-53'); //Старый телефон
define('TELEPHONE_OLD_LINK', '+74956469953');
define('HH_TELEPHONE', '+7 (977) 615-37-62'); //Телефон хед хантера
define('HH_NAME', 'Владимир Викторович'); //Имя хед хантера
define('VACANCY_VIDEO', 'pMlL7DhvACY');
define('TELEPHONE_MB', '8 (926) 515-38-74');//Мобильный телефон инкогнито
define('TELEPHONE_MB_LINK', '+79265153874');//тег ссылки на моб телефон
define('HOW_MANY_DAYS', 10); // За последние сколько дней Считаем звонки и среднюю оценку менеджера
