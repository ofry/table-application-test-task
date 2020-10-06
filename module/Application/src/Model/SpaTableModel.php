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
     * @return array
     */
    public function get()
    {
        /** @var string[] $values Параметр для отбора */
        $entries = $this->db->getRepository(Entity\SpaTable::class)
            ->findAll();
        return $entries;
    }
}