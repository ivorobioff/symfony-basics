<?php
namespace ApiBundle\DependencyInjection;
use ApiBundle\Support\ActorProvider;
use CoreBundle\Session\Entities\Session;
use CoreBundle\Session\Services\SessionService;
use CoreBundle\Support\ActorProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ApiExtension extends Extension
{
	/**
	 * @param array $configs
	 * @param ContainerBuilder $container
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$container->register(ActorProviderInterface::class, ActorProvider::class)->setAutowired(true);

		$definition = new Definition(Session::class);

		$definition->setFactory([static::class, 'sessionFactory'])
			->addArgument(new Reference('service_container'));

		$container->setDefinition(Session::class, $definition);
	}

	/**
	 * @param ContainerInterface $container
	 * @return Session
	 */
	public static function sessionFactory(ContainerInterface $container)
	{
		/**
		 * @var Request $request
		 */
		$request = $container->get(Request::class);

		$token = $request->headers->get('Token');

		if (!$token){
			return new Session();
		}

		/**
		 * @var SessionService $sessionService
		 */
		$sessionService = $container->get(SessionService::class);

		return ($sessionService->getNotExpiredByToken($token) ?? new Session());
	}
}