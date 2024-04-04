<?php

namespace BookStore\Api\Books\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Foundations\Adapter\Storage\ImageAdapterInterface;
use BookStore\Foundations\Domain\Books\Repositories\Eloquent\BookRepository;
use BookStore\Api\Books\Resources\BookResource;
use BookStore\Foundations\Domain\Books\Book;
use Exception;

class BookService extends BaseController
{
    protected $bookRepository;

    protected $imageAdapter;

    public function __construct(
        BookRepository $bookRepository,
        ImageAdapterInterface $imageAdapter
    ){
        $this->bookRepository = $bookRepository;
        $this->imageAdapter = $imageAdapter;
    }

    public function getBooks (array $params) {

        // return 'ser';

        $books = $this->bookRepository->getBooks($params);

        if ($books->isNotEmpty()) {

            $books = BookResource::collection($books);
            $total = $this->bookRepository->getTotal($params);

            return $this->sendResponse ($books, 'Retrieve Books Successfully!', $total);

        } else {

            $books = [];

            return $this->sendResponse ($books, 'There is no Data for Books!');

        }
    }

    public function getBookById($id) {
        $book = $this->bookRepository->getBookById($id);

        if (!empty($book)) {

            $book = new BookResource($book);

            return $this->sendResponse ($book, 'Retrieve Books Successfully by ID!');

        } else {

            return $this->sendError ($book, 'There is no record to retrieve!');
        }
    }

    public function createBook(array $params) {

        $id = $this->bookRepository->insertGetId($params);

        return $this->sendResponse($id, 'Book created Successfully!', 0, 201);
    }

    public function updateBook(array $params, $id) {

        $book = $this->bookRepository->getBookById($id);

        if(empty($book)) {

            return $this->sendError('No Data', 'There is no record to Update!.', 404);
        }
        // } else {

        //     $book = $this->bookRepository->update($id, $params);

        //     $book = $this->bookRepository->getBookById($id);
        //     $book = new BookResource($book);

        //     return $this->sendResponse($book, 'Book updated Successfully!', 201);
        // }

        $this->bookRepository->update($id, $params);

        $results = $this->bookRepository->getBookById($id);
        $results = new BookResource($results);

        return $this->sendResponse($results, 'Book updated Successfully!', 201);
    }

    public function deleteBook($id) {
        $book = $this->bookRepository->getBookById($id);

        if(!empty($book)) {

            $book = $this->bookRepository->delete($id);

            return $this->sendResponse($book, 'Book deleted Successfully!', 200);

        } else {

            return $this->sendError($book, 'There is No Data!', 404);

        }
    }

    public function uploadPicture(array $params, $id) {

        $book = $this->bookRepository->getBookById($id);

        if(empty($book)) {

            return $this->sendResponse($book, 'There is NO Data!', 404);
        }

        $image         =   $params['file'];
        $imageFileName =   time() . '.' .
        $image->getClientOriginalExtension();
        $uploadFile    =   env('S3_PREFIX') . DIRECTORY_SEPARATOR .
        Book::S3_IMAGE_DIRECTORY .
        DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $imageFileName;

        try {

            $this->imageAdapter->save($uploadFile, $image);

            $updateData = array(
                'cover_url'  =>  $imageFileName
            );

            $uploaded = $this->bookRepository->update($id, $updateData);

            return $this->sendResponse($uploaded, 'Image upload Seccessfully!');

        } catch (\Exception $e) {
            throw new Exception($e);
        }

    }
}
