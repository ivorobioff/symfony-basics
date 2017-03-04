<?php
namespace ApiBundle\Session\Controllers;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Session\Processors\CredentialsProcessor;
use ApiBundle\Session\Serializers\SessionSerializer;
use ApiBundle\Support\Controller;
use CoreBundle\Session\Services\SessionService;
use CoreBundle\User\Services\UserService;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SessionsController extends Controller
{
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var UserService
     */
    private $userService;

    public function initialize()
    {
        $this->sessionService = $this->container->get(SessionService::class);
        $this->userService = $this->container->get(UserService::class);
    }

    /**
	 * @Route("/sessions", name="create_session")
	 * @Method("POST")
	 *
     * @return Response
     */
    public function store()
    {
		/**
		 * @var CredentialsProcessor $processor
		 */
		$processor = $this->getProcessor(CredentialsProcessor::class);

        $session = $this->sessionService->create($processor->createPayload());

        return $this->reply->single($session, $this->getSerializer(SessionSerializer::class));
    }

    /**
	 * @Route("/sessions/{sessionId}", name="refresh_session", requirements={"sessionId": "\d+"})
	 * @Method("POST")
	 *
     * @param $sessionId
     * @return Response
     */
    public function refresh($sessionId)
    {
        $session = $this->sessionService->refresh($sessionId);

        return $this->reply->single($session, $this->getSerializer(SessionSerializer::class));
    }

    /**
	 * @Route("/sessions/{sessionId}", name="show_session", requirements={"sessionId": "\d+"})
	 * @Method("GET")
	 *
     * @param int $sessionId
     * @return Response
     */
    public function show($sessionId)
    {
        $session = $this->sessionService->get($sessionId);

        return $this->reply->single($session, $this->getSerializer(SessionSerializer::class));
    }

    /**
	 * @Route("/sessions/{sessionId}", name="delete_session", requirements={"sessionId": "\d+"})
	 * @Method("DELETE")
	 *
     * @param int $sessionId
     * @return Response
     */
    public function destroy($sessionId)
    {
        $this->sessionService->delete($sessionId);

        return $this->reply->blank();
    }

    /**
     * @param int $sessionId
     * @return bool
     */
    public function verify($sessionId)
    {
        return $this->sessionService->exists($sessionId);
    }
}