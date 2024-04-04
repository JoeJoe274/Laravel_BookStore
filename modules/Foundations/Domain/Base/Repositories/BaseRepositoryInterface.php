<?php

namespace BookStore\Foundations\Domain\Base\Repositories;

interface BaseRepositoryInterface
{
    public function insertGetId(array $params, $useModel = false);

    public function update($id, array $params);

    public function delete($id);
}
