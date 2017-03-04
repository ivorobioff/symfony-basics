<?php
namespace ApiBundle\Client\Controllers;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use ApiBundle\Client\Processors\ClientsProcessor;
use ApiBundle\Client\Serializers\ClientSerializer;
use ApiBundle\Support\Controller;
use CoreBundle\Client\Services\ClientService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ClientsController extends Controller
{
    /**
     * @var ClientService
     */
    private $clientService;

    public function initialize()
    {
        $this->clientService = $this->container->get(ClientService::class);
    }

    /**
	 * @Route("/clients", name="create_client")
	 * @Method("POST")
	 *
     * @return Response
     */
    public function store()
    {
		/**
		 * @var ClientsProcessor $processor
		 */
		$processor = $this->getProcessor(ClientsProcessor::class);

        return $this->reply->single(
            $this->clientService->create($processor->createPayload()),
            $this->getSerializer(ClientSerializer::class)
        );
    }

    /**
	 * @Route("/clients/{clientId}", name="update_client", requirements={"clientId": "\d+"})
	 * @Method("PATCH")
	 *
     * @param int $clientId
     * @return Response
     */
    public function update($clientId)
    {
		/**
		 * @var ClientsProcessor $processor
		 */
		$processor = $this->getProcessor(ClientsProcessor::class);

        $this->clientService->update($clientId, $processor->createPayload());

        return $this->reply->blank();
    }

    /**
	 * @Route("/clients/{clientId}", name="show_client", requirements={"clientId": "\d+"})
	 * @Method("GET")
	 *
     * @param int $clientId
     * @return Response
     */
    public function show($clientId)
    {
        return $this->reply->single(
            $this->clientService->get($clientId),
            $this->getSerializer(ClientSerializer::class)
        );
    }

    /**
	 * @Route("/clients/{clientId}", name="delete_client", requirements={"clientId": "\d+"})
	 * @Method("DELETE")
	 *
     * @param int $clientId
     * @return Response
     */
    public function destroy($clientId)
    {
        $this->clientService->delete($clientId);

        return $this->reply->blank();
    }

    /**
     * @param int $clientId
     * @return bool
     */
    public function verify($clientId)
    {
        return $this->clientService->exists($clientId);
    }
}