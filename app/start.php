<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MowersController\Infrastructure\Application\Application;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../config'));
$loader->load('services.yml');
$container->compile();
($container->get(Application::class))->run();