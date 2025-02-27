<?php

namespace App\Support\Serializers;

use App\Entities\RequestHistoryEntity;

class RequestHistorySerializer
{
    public static function parseEntity(RequestHistoryEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'status' => $entity->getStatusEnum(),
            'user_approver' => [
                'id' => $entity->getUserApprover()?->getIdentifier()->getValue(),
                'name' => $entity->getUserApprover()?->getName()
            ],
            'created_at' => $entity->getCreatedAt(),
            'observation' => $entity->getObservation(),
            'term' => $entity->getTerm(),
        ];
    }
}
