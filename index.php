<?php
require_once 'BaseModel.php';
$db = new BaseModel();
$city = BaseModel::get_city();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Тестовой задание INTAS</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="heading-primary">Тестовое задание PHP - INTAS</h1>
    <div class="accordion">
        <dl>
            <dt>
                <!-- 1 Вкладка-->
                <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                   class="accordion-title accordionTitle js-accordionTrigger">Тестовое задание</a>
            </dt>
            <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
                <div>
                <br>
                <h3>Создать расписание поездок курьеров в регионы(код должен быть написан без использования
                    фреймворка!)</h3>
                <h5>Описание:</h5>
                <p>Из Москвы в регионы отправляются с центрального склада курьеры с товаром. Время в пути известно.
                    Количество поездок в регион не ограничено.</p>
                <h4>Задание:</h4>
                <ol>
                    <li>Рабочая форма для внесения данных в расписание с полями:
                        <ul>
                            <li>Регион</li>
                            <li>Дата выезда из Москвы</li>
                            <li>ФИО курьера</li>
                            <li>Информационное поле: Дата прибытия в регион (рассчитывается на основе данных по региону)
                                Требования к форме:<br>
                                <ol>
                                    <li>Одновременно курьер может быть только в одной поездке в регион.</li>
                                    <li>Длительность поездки (туда/обратно) задается в таблице БД регионов.</li>
                                </ol>
                            </li>
                        </ul>
                    </li>
                    <li>Заполнить данные по поездкам за три месяца (скрипт заполнения прислать с остальными скриптами
                        веб-приложения)
                    </li>
                    <li>Форма вывода поездок курьеров в регионы с фильтрацией по дате.</li>
                </ol>
                <h4>Требования к веб-приложению:</h4>
                <ol>
                    <li>Веб-сервер: Apache или Nginx</li>
                    <li>Язык: PHP версии 7.0 или выше</li>
                    <li>БД: MSSQL или MySQL</li>
                    <li>Фронт: Ajax-запросы в форме внесения поездки в регион</li>
                    <li>Docker по желаниюQL</li>
                </ol>
                <h4>Информация:</h4>
                <h5>Регионы:</h5>
                <ol>
                    <li>Санкт-Петербург</li>
                    <li>Уфа</li>
                    <li>Нижний Новгород</li>
                    <li>Владимир</li>
                    <li>Кострома</li>
                    <li>Екатеринбург</li>
                    <li>Ковров</li>
                    <li>Воронеж</li>
                    <li>Самара</li>
                    <li>Астрахань</li>
                </ol>
                <h5>Длительность нахождения в пути: любое число дней<br>
                    Курьеры: Произвольно не менее 10 человек</h5><br>
                <h4>Прислать:</h4>
                <ol>
                    <li>Полностью веб-приложение (скрипты PHP, JS, docker(если есть) и т.д.)</li>
                    <li>
                        БД (MSSQL или MySQL) – 3 таблицы:
                        <ul>
                            <li>Таблица с курьерами</li>
                            <li>Таблица с регионами</li>
                            <li>Таблица расписания поездок в регионы</li>
                        </ul>
                    </li>
                    <li>Если веб-приложение развернуто с использованием специфичных настроек сервера Apache или Nginx,
                        то прислать конфиг веб-сервера и php.
                    </li>
                </ol>
               </div>

            </dd>

            <!-- 2 Вкладка-->
            <dt>
                <a href="#accordion2" aria-expanded="false" aria-controls="accordion2"
                   class="accordion-title accordionTitle js-accordionTrigger">Добавить нового курьера</a>
            </dt>
            <dd class="accordion-content accordionItem is-collapsed" id="accordion2" aria-hidden="true">
                <div>
                    <br><h4>Регистрация Курьера</h4>
                    <form id='ajaxFormCourier' method="post" action=""><br>

                        <label for="lastname">Фамилия</label><br>
                        <input type="text" name="lastname" id="lastname" placeholder="Иванов" oninput="this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');"/><br>

                        <label for="firstname">Имя</label><br>
                        <input type="text" name="firstname" id="firstname" placeholder="Иван" oninput="this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');"/><br>

                        <label for="patronymic">Отчество</label><br>
                        <input type="text" name="patronymic" id="patronymic" placeholder="Иванович" oninput="this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');"/>

                        <input type="button" id="courierButton" value="Добавить курьера">
                    </form>
                    <br>
                    Поле вывода:
                    <div id="result_insert_courier"></div>
                </div>
            </dd>

            <!-- 3 Вкладка-->
            <dt>
                <a href="#accordion3" aria-expanded="false" aria-controls="accordion3"
                   class="accordion-title accordionTitle js-accordionTrigger">Заполните данные для новой доставки</a>
            </dt>
            <dd class="accordion-content accordionItem is-collapsed" id="accordion3" aria-hidden="true">
                <div>
                    <br><h4>Регистрация поездки</h4>
                    <form id='ajaxFormNewSchedule' class="" method="post" action=""><br>
                        <label for="city">Города</label><br>
                        <select name="city" id="city">
                            <?php
                            $count_city = count($city);
                            for ($i = 0; $i < $count_city; $i++) {
                                echo "<option>";
                                echo $city[$i];
                                echo "</option>";
                            }
                            ?>
                        </select><br>
                        <label for="date_departure">Дата выезда</label><br>
                        <input type="date" name="date_departure" id="date_departure"><br>

                        <label for="date_arrival">Дата приезда обратно в Москву</label><br>
                        <input type="text" name="date_arrival" id="date_arrival" readOnly="readonly"/>
                        <br>
                        <label for="courier">Назначенный курьер</label><br>
                        <select name="courier" id="courier"></select>
                        <input type="button" name='scheduleButton' id="scheduleButton"
                               value="Зарегистрировать поездку"/>
                        <input type="button" name='clearButton' id="clearButton"
                               value="Очистить БД с расписанием поездок"/>
                        <input type="button" name='insertButton' id="insertButton" value="Заполнить БД на 3 месяца"/>
                    </form>
                    <br>
                    Поле вывода:
                    <div id="result_insert_schedule"></div>
                </div>
            </dd>

            <!-- 4 Вкладка-->
            <dt>
                <a href="#accordion4" aria-expanded="false" aria-controls="accordion4"
                   class="accordion-title accordionTitle js-accordionTrigger">Добавить новый город
                    доставки</a>
            </dt>
            <dd class="accordion-content accordionItem is-collapsed" id="accordion4" aria-hidden="true">


                <div>
                    <br><h4>Регистрация нового города</h4>
                    <form id='ajaxFormCity' method="post" action="" class="register-form">

                        <label for="new_city">Название города</label><br>
                        <input type="text" name="new_city" id="new_city" placeholder="Хабировск" oninput="this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');"/><br>
                        <label for="travel_time">Длительность поездки - <span>15</span></label><br>
                        1<input type="range" name="travel_time" id="travel_time" min="1" max="30" value="15" steps="1">30
                        <input type="button" id="cityButton" value="Добавить город">

                    </form>
                    <br>
                    Поле вывода:
                    <div id="result_insert_city"></div>
                </div>

            </dd>

            <!-- 5 Вкладка-->
            <dt>
                <a href="#accordion5" aria-expanded="false" aria-controls="accordion5"
                   class="accordion-title accordionTitle js-accordionTrigger">
                    Посмотреть расписание доставок
                </a>
            </dt>
            <dd class="accordion-content accordionItem is-collapsed" id="accordion5" aria-hidden="true">
                <div>
                    <br><h4>Расписание за опредленную дату</h4>
                    <form id='ajaxFormSelect' class="" method="post" action=""><br>
                        <label for="from_date">Дата от:</label><br>
                        <input type="date" name="from_date" id="from_date" placeholder="Enter data"/><br>
                        <label for="to_date">Дата до:</label><br>
                        <input type="date" name="to_date" id="to_date" placeholder="Enter data"/>
                        <input type="button" name='selectDate' id="selectDate" value="Отправить">
                    </form>
                    <br>
                    Поле вывода:
                    <div id="result_schedule_by_date"></div>
                </div>
            </dd>
        </dl>

    </div>

    <!-- Подключение jQ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/new_city.js"></script>
    <script type="text/javascript" src="public/js/new_courier.js"></script>
    <script type="text/javascript" src="public/js/new_schedule.js"></script>
    <script type="text/javascript" src="public/js/get_schedule_by_date.js"></script>
    <script type="text/javascript" src="public/js/acc.js"></script>
    <script type="text/javascript" src="public/js/calc_date_arrival.js"></script>
    <script type="text/javascript" src="public/js/insert_script_schedule.js"></script>

</body>
</html>
