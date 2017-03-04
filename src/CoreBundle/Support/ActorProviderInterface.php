<?php
namespace CoreBundle\Support;
use CoreBundle\User\Entities\User;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface ActorProviderInterface
{
    /**
     * @return User
     */
    public function getActor();
}