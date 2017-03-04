<?php
namespace ApiBundle\Session\Serializers;
use ApiBundle\Support\Serializer;
use ApiBundle\User\Serializers\UserByTypeSerializer;
use CoreBundle\Session\Entities\Session;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SessionSerializer extends Serializer
{
    /**
     * @param Session $session
     * @return array
     */
    public function __invoke(Session $session)
    {
        return [
            'id' => $session->getId(),
            'token' => $session->getToken(),
            'user' => $this->delegate(UserByTypeSerializer::class, $session->getUser()),
            'createdAt' => $this->datetime($session->getCreatedAt()),
            'expiresAt' => $this->datetime($session->getExpiresAt())
        ];
    }
}