<?php

namespace Mdb\PhpSpecRunFQCNExtension;

use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;
use Mdb\PhpSpecRunFQCNExtension\Locator\FQCNLocator;

class Extension implements ExtensionInterface
{
    /**
     * {@inheritdoc}
     *
     * @link https://github.com/phpspec/phpspec/blob/36c1e97d59630888fd022a542b1650ae5eab1f18/src/PhpSpec/Console/ContainerAssembler.php#L338
     */
    public function load(ServiceContainer $container)
    {
        $container->addConfigurator(function (ServiceContainer $c) {
            $resourceManager = $c->get('locator.resource_manager');

            $suites = $c->getParam('suites', array('main' => ''));

            foreach ($suites as $name => $suite) {
                $suite = is_array($suite) ? $suite : array('namespace' => $suite);
                $defaults = array(
                    'namespace' => '',
                    'spec_prefix' => 'spec',
                    'src_path' => 'src',
                    'spec_path' => '.',
                    'psr4_prefix' => null,
                );

                $config = array_merge($defaults, $suite);

                $locator = new FQCNLocator(
                    $config['namespace'],
                    $config['spec_prefix'],
                    $config['src_path'],
                    $config['spec_path'],
                    null,
                    $config['psr4_prefix']
                );

                $resourceManager->registerLocator($locator);
            }
        });
    }
}
