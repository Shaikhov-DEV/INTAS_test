<?php


class BaseModel
{
    protected static $connect; // Подключение к PDO

    /* Соединение с PDO */
    public function __construct()
    {
        // Путь к массиву данных подключения
        $array = $config = [
            'host' => 'mysql:host=localhost;dbname=delivery;charset=utf8',
            'login' => 'root',
            'password' => ''
        ];

        // Подключение к PDO, установка атрибутов и перехват исключений
        self::$connect = new PDO($array['host'], $array['login'], $array['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        if (!self::$connect) {
            die("Подключение к БД провалено");
        }
    }

    public static function new_courier(string $lastname, string $firstname, string $patronymic): bool
    {
        $sql = "INSERT INTO courier VALUES (null, '{$lastname}', '{$firstname}', '{$patronymic}')";
        if (self::$connect->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function new_city(string $city_name, string $city_travel_time): bool
    {
        $sql = "INSERT INTO city VALUES (null, '{$city_name}', '{$city_travel_time}')";

        if (self::$connect->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function new_schedule($city, $courier, $date_departure, $date_arrival): bool
    {
        $sql = "INSERT INTO schedule VALUES (null, '{$city}', '{$courier}', '{$date_departure}', '{$date_arrival}')";
        if (self::$connect->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function calc_date_arrival($city)
    {
        $sql = "SELECT city_travel_time FROM city WHERE city_name='{$city}'";
        $travel_time = self::$connect->query($sql);
        $result[] = $travel_time->fetch(\PDO::FETCH_NUM);
        return $result;
    }

    public static function get_city_id(string $name)
    {
        $sql = "SELECT city_id FROM city WHERE city_name = '{$name}'";
        $result = self::$connect->query($sql);
        if ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $res = $row['city_id'];
        } else {
            $res = 0;
        }
        return $res;
    }

    public static function get_courier_id(string $courier_name)
    {
        $sql = "SELECT courier_id FROM courier WHERE CONCAT(courier_lastname,' ',courier_firstname,' ',courier_patronymic) = '{$courier_name}'";

        $result = self::$connect->query($sql);
        if ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $res = $row['courier_id'];
        } else {
            $res = 0;
        }
        return $res;
    }

    public static function clean()
    {
        $sql = "DELETE FROM schedule";

        if (self::$connect->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function a_i()
    {
        $sql = "ALTER TABLE schedule AUTO_INCREMENT = 1";

        if (self::$connect->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_city(): array
    {
        $sql = "SELECT city_name FROM city";
        $result = self::$connect->query($sql);
        while ($row = $result->fetch(\PDO::FETCH_NUM)) {
            $array[] = $row[0];
        }
        return $array;
    }

    public static function get_courier($date_departure, $date_arrival): array
    {
        $sql = "SELECT courier.courier_lastname, courier.courier_firstname, courier.courier_patronymic 
                FROM courier 
                WHERE NOT EXISTS (
                SELECT null  FROM schedule 
                WHERE (schedule.schedule_courier_id = courier.courier_id AND 
                ((schedule.schedule_date_departure BETWEEN '{$date_departure}' and '{$date_arrival}') 
                OR (schedule.schedule_date_arrival BETWEEN '{$date_departure}' and '{$date_arrival}'))))";
        // запрос который возвращает ФИО свободных курьеров, ориентируюсь на заданую дату
        $result = self::$connect->query($sql);

        while ($row = $result->fetch(\PDO::FETCH_NUM)) {
            $array[] = $row[0] . ' ' . $row[1] . ' ' . $row[2];
        }
        return $array;
    }
    public static function get_courier_script($date_departure, $date_arrival): array
    {
        $sql = "SELECT courier_id 
                FROM courier 
                WHERE NOT EXISTS (
                SELECT null  FROM schedule 
                WHERE (schedule.schedule_courier_id = courier.courier_id AND 
                ((schedule.schedule_date_departure BETWEEN '{$date_departure}' and '{$date_arrival}') 
                OR (schedule.schedule_date_arrival BETWEEN '{$date_departure}' and '{$date_arrival}'))))";
        // запрос который возвращает ФИО свободных курьеров, ориентируюсь на заданую дату
        $result = self::$connect->query($sql);

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }

    public static function get_schedule_by_date($from_date, $to_date)
    {
            $sql = "SELECT city.city_name as city, schedule.schedule_date_departure as departure, 
		 		courier.courier_firstname as courier, schedule.schedule_date_arrival as arrival
				FROM schedule
				INNER JOIN courier ON schedule.schedule_courier_id = courier.courier_id
				INNER JOIN city  ON schedule.schedule_city_id  = city.city_id
				WHERE schedule.schedule_date_departure BETWEEN '{$from_date}' and '{$to_date}'";
            $result = self::$connect->query($sql);
            $array = [];
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $row;
            }
            return $array;
    }

    public static function insert_schedule($sql)
    {
        if (self::$connect->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_count_city()
    {
        $sql = "SELECT city_id, city_travel_time FROM city";
        $result = self::$connect->query($sql);
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }
}


