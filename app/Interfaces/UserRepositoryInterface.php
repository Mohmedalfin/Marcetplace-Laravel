<?php

namespace App\Repositories;

interface UserRepositoryInterface{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );

    public function getAllPaginated(
        ?string $search,
        ?int $rowsPerPage
    );
}