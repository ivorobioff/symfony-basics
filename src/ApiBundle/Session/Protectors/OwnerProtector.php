<?php
namespace ApiBundle\Session\Protectors;
use ApiBundle\Support\Protectors\AbstractOwnerProtector;
use CoreBundle\User\Services\UserService;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class OwnerProtector extends AbstractOwnerProtector
{
    /**
     * @param int $id
     * @return bool
     */
    protected function isOwner($id)
    {
        /**
         * @var UserService $userService
         */
        $userService = $this->container->get(UserService::class);

        return $userService->hasSession($this->session->getUser()->getId(), $id);
    }
}