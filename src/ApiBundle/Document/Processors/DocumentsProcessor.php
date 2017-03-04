<?php
namespace ApiBundle\Document\Processors;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ApiBundle\Document\Support\File;
use ApiBundle\Support\Processor;
use CoreBundle\Document\Interfaces\FileInterface;
use ImmediateSolutions\Support\Validation\Error;
use ImmediateSolutions\Support\Validation\ErrorsThrowableCollection;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class DocumentsProcessor extends Processor
{
    public function validate()
    {
        if (!$this->request->files->get('document') instanceof UploadedFile){
            ErrorsThrowableCollection::throwError(
                'document', new Error('exists', 'The file has not been uploaded'));
        }
    }

    /**
     * @return FileInterface
     */
    public function getFile()
    {
        return new File($this->request->files->get('document'));
    }
}