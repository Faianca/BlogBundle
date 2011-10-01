<?php
/*
 *  @category   Blog Bundle
 *  @package    DIC
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 *  @About      Multiple Loaders with DelegatingLoader
 */

namespace Faianca\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 */
class FaiancaBlogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $locator = new FileLocator(__DIR__.'/../Resources/config');
        $resolver = new LoaderResolver(array(
            new XmlFileLoader($container, $locator),
            new YamlFileLoader($container, $locator)
        ));
        
        $loader = new DelegatingLoader($resolver);
        $loader->load('services.yml', 'yml');
        $loader->load('orm.xml', 'xml');
        $loader->load('form.xml', 'xml');
      
    }
}
