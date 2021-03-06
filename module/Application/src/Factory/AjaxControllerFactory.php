<?php
    /**
     * Created by PhpStorm.
     * User: ofryak
     * Date: 26.07.18
     * Time: 0:19
     */

    namespace Application\Factory;

    use Interop\Container\ContainerInterface;
    use Laminas\ServiceManager\Factory\FactoryInterface;

    /**
     * Class AjaxControllerFactory
     *
     * Фабрика контроллеров
     *
     * @package Application\Factory
     */
    class AjaxControllerFactory implements FactoryInterface
    {
        /**
         * @param \Interop\Container\ContainerInterface $container
         * @param string                                $requestedName
         * @param array|null                            $options
         *
         * @return object
         */
        public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
        {
            return new $requestedName($container->get(DbFactory::class));
        }
    }