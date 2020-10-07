<?php

namespace Application\Model;

use Doctrine\ORM\EntityManager;

/**
 * Class SpaTableModel
 * @package Application\Model
 */
class SpaTableModel
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $db;

    /**
     * SpaTableModel constructor.
     * @param EntityManager $db
     */
    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    /**
     * Инициализирует таблицу заново.
     *
     * @return void
     */
    public function newInit() : void
    {
        $this->clear();
        $this->fill();
    }

    /**
     *  Очищает таблицу
     *
     * @return void
     */
    private function clear() : void
    {
        $entries = $this->getAllEntries();
        foreach ($entries as $entry) {
            $this->db->remove($entry);
        }
    }

    /**
     *  Заполняет таблицу случайными данными
     *
     * @return void
     */
    private function fill() : void
    {
        try {
            /** @var int $quantity Количество генерируемых записей */
            $quantity = random_int(1, 200);

            /** @var int $count Счетчик */
            for ($count = 0; $count < $quantity; $count++) {

                /** @var Entity\SpaTable $entry Создаваемая запись */
                $entry = new Entity\SpaTable();
                $entry->setName(bin2hex(random_bytes(10)));
                $entry->setDate(date_create_from_format('U', random_int(0, 2147483647)));
                $entry->setQuantity(random_int(0, 2047));
                $entry->setDistance(random_int(0, 16384));
                $this->db->persist($entry);
                $this->db->flush();
            }
        }
        catch (\Throwable $e) {
            throw new RuntimeException('Наверное, на данном компьютере нет генератора
                 случайных чисел');
        }
    }

    /**
     * @return array
     */
    public function getAllEntries()
    {
        /** @var string[] $values Параметр для отбора */
        $entries = $this->db->getRepository(Entity\SpaTable::class)
            ->findAll();
        return $entries;
    }
}