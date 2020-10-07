<?php
    /**
     * Created by PhpStorm.
     * User: ofryak
     * Date: 13.07.18
     * Time: 20:59
     */

    namespace Application\Factory;

    use Application\Model\SpaTableModel;
    use Interop\Container\ContainerInterface;
    use Laminas\ServiceManager\Factory\FactoryInterface;


    /**
     * Class DbFactory
     *
     * Фабрика для класса \Application\Model\SpaTableModel
     *
     * @package Application\Factory
     */
    class DbFactory implements FactoryInterface
    {
        /**
         * @param \Interop\Container\ContainerInterface $container
         * @param string                                $requestedName
         * @param array|null                            $options
         *
         * @return \Application\Model\SpaTableModel
         */
        public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
        {
            return new SpaTableModel($container->get('doctrine.entitymanager.orm_default'));
        }
    }