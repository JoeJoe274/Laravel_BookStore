<?php

namespace BookStore\Foundations\Domain\Books\Repositories\Eloquent;

use BookStore\Foundations\Domain\Books\Repositories\BookRepositoryInterface;
use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BookStore\Foundations\Domain\Books\Book;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    protected $book;

    public function __construct(book $model)
    {
        parent::__construct($model);
    }

    protected function getConnectionByCondition(array $params)
    {
        $connection = $this->connection();

        if (isset($params['since']) && strlen($params['since']) > 0) {
            $connection = $connection->where('created_at', '>=', $params['since']);
        }

        if (isset($params['until']) && strlen($params['until']) > 0) {
            $connection = $connection->where('created_at', '<=', $params['until']);
        }

        if (isset($params['ISBN']) && strlen($params['ISBN']) > 0) {
            $connection = $connection->where('ISBN', '=', $params
            ['ISBN']);
        }

        if (isset($params['author']) && strlen($params['author']) > 0) {
            $connection = $connection->where('author', '=', $params['author']);
        }

        if (isset($params['title']) && strlen($params['title']) > 0) {
            $connection = $connection->where('title', 'like', '%'. $params['title']. '%');
        }

        return $connection;
    }

    public function getBooks(array $params)
    {
        return $this->getConnectionByCondition($params)
        ->orderBy('books.created_at', 'desc')
        ->whereNull('books.deleted_at')
        ->get();
    }

    public function getTotal(array $params)
    {
        return $this->getConnectionByCondition($params)
        ->count('books.id');
    }

    public function getBookById($id)
    {
        return $this->connection()
        ->find($id);
    }
}
