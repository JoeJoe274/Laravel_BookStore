<?php

namespace BookStore\Foundations\Adapter\Storage;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;

/**
 * An adapter class for communicating to image cloud storage.
 * 
 * @author Yarzartun
 * @copyright (c) 2021 - Zote Innovation, All Right Reserved.
 */
class StorageAdapter implements StorageAdapterInterface 
{    
    /**
     * FileSystemAdapter
     *
     * @var mixed
     */
    protected $fileSystem;
    
    /**
     * StorageAdapter constructor.
     *
     * @param  mixed $fileSystem
     * @return void
     */
    public function __construct(FileSystemAdapter $fileSystem = null)
    {
        if ($fileSystem !== null) {
            $this->setAdapter($fileSystem);
        }
    }
        
    /**
     * Set an adapter.
     *
     * @param  mixed $fileSystem
     * @return void
     */
    public function setAdapter(FileSystemAdapter $fileSystem)
    {
        return $this->fileSystem = $fileSystem;
    }
    
    /**
     * Upload a file to S3 storage.
     *
     * @param  mixed $filePath
     * @param  mixed $file
     * @return void
     */
    public function save($filePath, UploadedFile $file)
    {
        $this->fileSystem->put($filePath, file_get_contents($file));
    }
    
    /**
     * Download the file from S3 storage.
     *
     * @param  mixed $filePath
     * @return void
     */
    public function get($filePath)
    {
        return $this->fileSystem->get($filePath);
    }
}