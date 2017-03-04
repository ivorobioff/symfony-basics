<?php
namespace InfrastructureBundle;

use CoreBundle\Document\Interfaces\DocumentPreferenceInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DocumentPreference implements DocumentPreferenceInterface
{
	/**
	 * @var array
	 */
	private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @return int
     */
    public function getLifeTime()
    {
        return array_get($this->config, 'life_type', 10);
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return array_get($this->config, 'base_url', '//');
    }
}