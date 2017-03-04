<?php
namespace ApiBundle\Document\Serializers;
use ApiBundle\Support\Serializer;
use CoreBundle\Document\Entities\Document;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DocumentSerializer extends Serializer
{
    public function __invoke(Document $document)
    {
        return [
            'id' => $document->getId(),
            'token' => $document->getToken(),
            'format' => $document->getFormat(),
            'name' => $document->getName(),
            'url' => $this->url($document->getUri()),
            'size' => $document->getSize(),
            'uploadedAt' => $this->datetime($document->getUploadedAt())
        ];
    }
}