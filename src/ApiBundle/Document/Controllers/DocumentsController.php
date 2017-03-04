<?php
namespace ApiBundle\Document\Controllers;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Document\Processors\DocumentsProcessor;
use ApiBundle\Document\Serializers\DocumentSerializer;
use ApiBundle\Support\Controller;
use CoreBundle\Document\Services\DocumentService;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DocumentsController extends Controller
{
    /**
     * @var DocumentService
     */
    private $documentService;

    public function initialize()
    {
        $this->documentService = $this->container->get(DocumentService::class);
    }

    /**
	 * @Route("/documents", name="store_document")
	 * @Method("POST")
	 *
     * @return Response
     */
    public function store()
    {
		/**
		 * @var DocumentsProcessor $processor
		 */
		$processor = $this->getProcessor(DocumentsProcessor::class);

        $document = $this->documentService->create($processor->getFile());

        return $this->reply->single($document, $this->getSerializer(DocumentSerializer::class));
    }
}