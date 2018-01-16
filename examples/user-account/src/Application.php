<?php

namespace UserAccount;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application extends SymfonyApplication
{
    use ContainerAwareTrait;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->initContainer();

        $this->add($this->container->get('command.get'));
        $this->add($this->container->get('command.set'));
        $this->add($this->container->get('command.reset'));
    }

    private function initContainer()
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/DependencyInjection/'));
        $loader->load('services.yml');
        $this->setContainer($container);
    }
}
