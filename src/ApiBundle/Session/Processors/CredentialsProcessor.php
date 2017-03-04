<?php
namespace ApiBundle\Session\Processors;
use ApiBundle\Support\Processor;
use CoreBundle\User\Payloads\CredentialsPayload;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class CredentialsProcessor extends Processor
{
    protected function schema()
    {
        return [
            'username' => 'string',
            'password' => 'string'
        ];
    }

    /**
     * @return CredentialsPayload
     */
    public function createPayload()
    {
        $payload = new CredentialsPayload();

        $this->set($payload, 'username');
        $this->set($payload, 'password');

        return $payload;
    }
}