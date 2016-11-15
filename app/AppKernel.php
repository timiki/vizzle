<?php

use Vizzle\VizzleBundle\VizzleKernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollectionBuilder;

class AppKernel extends VizzleKernel
{
    /**
     * Constructor.
     *
     * @param string $environment The environment
     * @param bool   $debug       Whether to enable debugging or not
     */
    public function __construct($environment, $debug = true)
    {
        // By default use UTC timezone.
        date_default_timezone_set('UTC');

        parent::__construct($environment, $debug);
    }

    /**
     * Register application bundle.
     *
     * @return array
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Sensio\Bundle\DistributionBundle\SensioDistributionBundle(),
            new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Timiki\Bundle\RpcServerBundle\RpcServerBundle(),
            new Vizzle\VizzleBundle\VizzleBundle(),
            new Vizzle\TaskBundle\VizzleTaskBundle(),
            new Vizzle\ServiceBundle\VizzleServiceBundle(),
            new Vizzle\WebBundle\VizzleWebBundle(),
            new AppBundle\AppBundle(),
        ];

        // Is need symfony debug and profiler
        //
        // if ($this->isDebug()) {
        //     $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        //     $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        // }

        return $bundles;
    }

    /**
     * Configuration application route.
     *
     * @param RouteCollectionBuilder $routes
     */
    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->mount('/', $routes->import(__DIR__ . '/config/routing.yml'));

        // Is need symfony debug and profiler
        //
        // if ($this->isDebug()) {
        //     $routes->mount('/_wdt', $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml'));
        //     $routes->mount('/_profiler', $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml'));
        // }
    }

    /**
     * Configuration application container.
     *
     * @param ContainerBuilder $container
     * @param LoaderInterface  $loader
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yml');
        $loader->load(__DIR__ . '/config/services.yml');
    }

    /**
     * Get roo dir path.
     *
     * @return string
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * Get path for cache store.
     *
     * @return string
     */
    public function getCacheDir()
    {
        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    /**
     * Get path for logs store.
     *
     * @return string
     */
    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/logs';
    }

    /**
     * Get path for vars store.
     *
     * @return string
     */
    public function getVarDir()
    {
        return $this->rootDir . '/cache/' . $this->environment;
    }
}
