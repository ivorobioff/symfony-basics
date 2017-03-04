<?php
namespace ApiBundle\Client\Serializers;
use ApiBundle\User\Serializers\UserSerializer;
use CoreBundle\Client\Entities\Client;
use CoreBundle\User\Entities\User;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ClientSerializer extends UserSerializer
{
    /**
     * @param Client|User $client
     * @return array
     */
    public function __invoke(User $client)
    {
        $data = parent::__invoke($client);

        $data['firstName'] = $client->getFirstName();
        $data['lastName'] = $client->getLastName();
        $data['email'] = $client->getEmail();
        $data['type'] = 'client';

        return $data;
    }
}