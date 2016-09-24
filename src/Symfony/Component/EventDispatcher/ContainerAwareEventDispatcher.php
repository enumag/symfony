<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Lazily loads listeners from the dependency injection container.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Jordan Alliot <jordan.alliot@gmail.com>
 */
class ContainerAwareEventDispatcher extends LazyEventDispatcher
{
    /**
     * The container from where services are loaded.
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    /**
     * {@inheritdoc}
     */
    protected function lazyLoadListener($id)
    {
        return $this->container->get($id);
    }
}
