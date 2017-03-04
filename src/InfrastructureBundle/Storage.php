<?php
namespace InfrastructureBundle;

use CoreBundle\Document\Interfaces\FileInterface;
use CoreBundle\Document\Interfaces\StorageInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Storage implements StorageInterface
{
    /**
     * @var string
     */
    private $root;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->root = $config['root'];
    }

    /**
     * @param FileInterface $file
     * @param string $uri
     */
    public function move(FileInterface $file, $uri)
    {
        $path = $this->root.'/'.$uri;

        mkdir(dirname($path), 0755, true);

        move_uploaded_file($file->getLocation(), $path);
    }

    /**
     * @param string|array $uri
     */
    public function delete($uri)
    {
        if (!is_array($uri)){
            $uri = [$uri];
        }

        foreach ($uri as $path){
            unlink($this->root.'/'.$path);
        }
    }
}