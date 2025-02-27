<?php

namespace App\Infra\Helpers;

use App\Support\Pagination\Pagination;

class PaginationHelper
{
    public static function convertPagingArray(Pagination $pagination, $serializer)
    {
        $entity = array_map(fn ($entidade) => $serializer::parseEntity($entidade), $pagination->getEntity());

        return response()->json([
            'results' => $entity,
            'last_page' => $pagination->getLastPage(),
            'totalItems' => $pagination->getData(),
            'totalPage' => $pagination->getPerPage(),
        ]);
    }

    public static function convertPaginationCollection(Pagination $pagination, $serializer)
    {
        $entity = $pagination->getEntity()->map(fn ($entity) => $serializer::parseEntity($entity));

        return response()->json([
            'results' => $entity,
            'last_page' => $pagination->getLastPage(),
            'totalItems' => $pagination->getData(),
            'totalPage' => $pagination->getPerPage(),
        ]);
    }
}
