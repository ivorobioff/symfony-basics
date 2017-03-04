<?php
namespace InfrastructureBundle\DependencyInjection;

use CoreBundle\Client\Services\ClientService;
use CoreBundle\Document\Interfaces\DocumentPreferenceInterface;
use CoreBundle\Document\Interfaces\StorageInterface;
use CoreBundle\Document\Services\DocumentService;
use CoreBundle\Session\Interfaces\SessionPreferenceInterface;
use CoreBundle\Session\Services\SessionService;
use CoreBundle\User\Services\UserService;
use InfrastructureBundle\DocumentPreference;
use InfrastructureBundle\SessionPreference;
use InfrastructureBundle\Storage;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class InfrastructureExtension extends Extension
{
	private $coreServices = [
		ClientService::class,
		DocumentService::class,
		SessionService::class,
		UserService::class
	];

	/**
	 * @param array $configs
	 * @param ContainerBuilder $container
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		foreach ($this->coreServices as $service){
			$container->register($service, $service)->setAutowired(true);
		}

		$container->register(DocumentPreferenceInterface::class, DocumentPreference::class)
			->addArgument(['base_url' => '//', 'life_time' => 10]);

		$container->register(SessionPreferenceInterface::class, SessionPreference::class);

		$container->register(StorageInterface::class, Storage::class)
			->addArgument(['root' => '/']);
	}
}