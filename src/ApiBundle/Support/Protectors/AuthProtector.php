<?php
namespace ApiBundle\Support\Protectors;

use CoreBundle\Session\Entities\Session;
use ImmediateSolutions\Support\Permissions\ProtectorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class AuthProtector implements ProtectorInterface
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->session = $container->get(Session::class);
    }

    /**
     * @return bool
     */
    public function grants()
    {
        return $this->session->getId() !== null;
    }
}