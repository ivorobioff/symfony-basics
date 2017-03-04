<?php
namespace ApiBundle\User\Serializers;
use ApiBundle\Support\Serializer;
use CoreBundle\User\Entities\User;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserSerializer extends Serializer
{
    /**
     * @param User $user
     * @return array
     */
    public function __invoke(User $user)
    {
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'createdAt' => $this->datetime($user->getCreatedAt())
        ];
    }
}