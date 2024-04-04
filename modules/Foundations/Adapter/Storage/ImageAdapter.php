<?php

namespace BookStore\Foundations\Adapter\Storage;

use Illuminate\Support\Facades\Storage;

/**
 * An adapter class for communicating to image cloud storage.
 * 
 * @author Yarzartun
 * @copyright (c) 2021 - Zote Innovation, All Right Reserved.
 */
class ImageAdapter extends StorageAdapter implements ImageAdapterInterface
{
    public function __construct()
    {
        // if (strcmp(config('filesystems.default'), 'testing') == 0) {
        //     $fileSystem = Storage::disk('testing');     //when testing file system change to 'testing'.
        // } else {
            $fileSystem = Storage::disk('s3');
        // }

        parent::__construct($fileSystem);
    }
}