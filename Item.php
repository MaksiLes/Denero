<?php
declare(strict_types=1);

include "Connection.php";

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
    }

    /**
     * @param string $propertyName
     * @param $value
     */
    public function __set(string $propertyName, $value)
    {
        if (property_exists($this, $propertyName) && $propertyName != "id") {
            echo "Установка '$propertyName' в '$value'\n";
            $this->$propertyName = $value;
            $changed = true;
            var_dump($propertyName);
            var_dump($value);
        }
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
    }
}





