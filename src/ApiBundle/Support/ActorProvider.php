<?php
namespace ApiBundle\Support;
use CoreBundle\Session\Entities\Session;
use CoreBundle\Support\ActorProviderInterface;
use CoreBundle\User\Entities\User;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ActorProvider implements ActorProviderInterface
{
    /**
     * @var Session $session
     */
    private $session;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return User
     */
    public function getActor()
    {
        return $this->session->getUser();
    }
}