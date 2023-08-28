<?php

declare(strict_types=1);

namespace KPhoen\RulerZBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use KPhoen\RulerZBundle\DependencyInjection\Compiler;

class KPhoenRulerZBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new Compiler\TargetsPass());
        $container->addCompilerPass(new Compiler\OperatorsPass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        $class = $this->getContainerExtensionClass();

        return new $class();
    }
}
