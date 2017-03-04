<?php
namespace CoreBundle\Session\Interfaces;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface SessionPreferenceInterface
{
    /**
     * @return int
     */
    public function getLifeTime();
}