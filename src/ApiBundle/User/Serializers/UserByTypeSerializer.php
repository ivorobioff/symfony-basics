<?php
namespace ApiBundle\User\Serializers;

use ApiBundle\Client\Serializers\ClientSerializer;
use ApiBundle\Support\Serializer;
use CoreBundle\Client\Entities\Client;
use CoreBundle\User\Entities\User;
use RuntimeException;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class UserByTypeSerializer extends Serializer
{
    public function __invoke(User $user)
    {
        if ($user instanceof Client){
            return $this->delegate(ClientSerializer::class, $user);
        }

        throw new RuntimeException('Unable to find a serializer for the "'.get_class($user).'" type.');
    }
}