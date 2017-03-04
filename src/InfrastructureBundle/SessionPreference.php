<?php
namespace InfrastructureBundle;
use CoreBundle\Session\Interfaces\SessionPreferenceInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SessionPreference implements SessionPreferenceInterface
{
    /**
     * @return int
     */
    public function getLifeTime()
    {
        return 1440;
    }
}