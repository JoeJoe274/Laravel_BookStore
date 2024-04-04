<?php

namespace BookStore\Foundations\Adapter\Storage;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;

/**
 * An interface for S3Adapter.
 * 
 * @author Yarzartun
 * @copyright (c) 2021 - Zote Innovation, All Right Reserved.
 */
interface StorageAdapterInterface
{
    /**
     * Set an adapter.
     * 
     * @param FilesystemAdapter $filesystem
     * @return FilesystemAdapter
     */
    public function setAdapter(FilesystemAdapter $filesystem);

    /**
     * Upload a file to S3 storage.
     * 
     * @param $filePath
     * @param UploadedFile $file
     * @return bool
     */
    public function save($filePath, UploadedFile $file);

    /**
     * Download the file from S3 storage.
     * 
     * @param $filePath
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get($filePath);
}