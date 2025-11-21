<?php

namespace App\Repositories;

use App\Interfaces\StoreRepositoryInterface;
use App\Models\Store;


class StoreRepository implements StoreRepositoryInterface
{
     
    public function getAll(?string $search,  ?bool $isVerified, ?int $limit, bool $execute)
    {
        $query = Store::where(function ($query) use ($search, $isVerified) {
            if ($search) {
               $query->search($search);
            }

            if (!is_null($isVerified)){
                $query->where('is_verified', $isVerified);
            }
        });

        if($limit){
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search, ?bool $isVerified, ?int $rowsPerPage)
    {
        $query = $this->getAll(
            $search,
            $isVerified,
            null,
            false
        );

        return $query->paginate($rowsPerPage);
    }

}