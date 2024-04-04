<?php

namespace BookStore\Foundations\Domain\Books\Repositories;

interface BookRepositoryInterface
{
    public function getBooks(array $params);

    public function getTotal(array $params);

    public function getBookById($id);
}
