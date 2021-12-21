<?php
declare(strict_types=1);

include "Connection.php";
include "UnknownPropertyException.php";

final class Item
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $status;
    /**
     * @var bool
     */
    private bool $changed = false;

    /**
     * Item constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;

        $this->init();
    }

    private function init()
    {
//        $conn = Connection::getInstance();
//
//        $getData = $conn->prepare('SELECT name, status FROM objects where id = ?');
//        $getData->execute([$this->id]);
//        $item = $getData->fetch();
//        if ($item !== false) {
//            $this->name = $item['name'];
//            $this->status = $item['status'];
//        }
        $this->name = "some name";
        $this->status = 1;
    }

    /**
     * @param string $propertyName
     * @return mixed
     */
    public function __get(string $propertyName)
    {
        if (property_exists($this, $propertyName)) {
            //возвращает значение свойства
            return $this->$propertyName;
        }

        throw new UnknownPropertyException("unknown property $propertyName");
    }

    /**
     * @param string $propertyName
     * @param $value
     * @throws UnknownPropertyException
     */
    public function __set(string $propertyName, $value)
    {
        if (property_exists($this, $propertyName) && $propertyName != "id") {
            var_dump("Установка '$propertyName' в '$value'\n");
            $this->$propertyName = $value;
            $this->changed = true;
            var_dump($propertyName);
            var_dump($value);
            return;
        }

        throw new UnknownPropertyException("unknown property $propertyName");
    }

    public function save()
    {
        $conn = Connection::getInstance();
        $query = '
            INSERT INTO objects (id, name, status)
            VALUES (:id, :name, :status) ON DUPLICATE KEY UPDATE name = :name, status = :status;
        ';
        $getData = $conn->prepare($query);
        $result = $getData->execute(['id' => $this->id, 'name' => $this->name, 'status' => $this->status]);
        var_dump($result);
        $this->changed = false;
    }
}



