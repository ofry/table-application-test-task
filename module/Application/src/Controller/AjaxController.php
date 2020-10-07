<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Application\Model\SpaTableModel;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Laminas\Hydrator\ClassMethodsHydrator;

class AjaxController extends AbstractActionController
{
    /**
     * @var \Application\Model\TestTable
     */
    private $table;
    /**
     * @var \Laminas\Hydrator\ClassMethodsHydrator
     */
    private $hydrator;

    /**
     * AjaxController constructor.
     *
     * @param \Application\Model\SpaTableModel $table
     */
    public function __construct(SpaTableModel $table)
    {
        $this->table = $table;
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function indexAction()
    {
        return new JsonModel();
    }

    public function generateAction()
    {
        $this->table->newInit();
        /** @var array $entries */
        $entries = $this->table->getAllEntries();
        $result = array();
        foreach ($entries as $entry) {
            $result[] = $this->hydrator->extract($entry);
        }
        return new JsonModel(array('response' => $result));
    }

    public function loadAction()
    {
        /** @var array $entries */
        $entries = $this->table->getAllEntries();
        $result = array();
        foreach ($entries as $entry) {
            $result[] = $this->hydrator->extract($entry);
        }
        return new JsonModel(array('response' => $result));
    }
}
