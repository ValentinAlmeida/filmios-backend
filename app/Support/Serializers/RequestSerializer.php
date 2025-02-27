<?php

namespace App\Support\Serializers;

use App\Entities\RequestEntity;

class RequestSerializer
{
    public static function parseEntity(RequestEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'profile' => $entity->getProfileEnum(),
            'status' => $entity->getStatusEnum(),
            'user_approver' => [
                'id' => $entity->getUserApprover()?->getIdentifier()->getValue(),
                'name' => $entity->getUserApprover()?->getName()
            ],
            'user_creator' => [
                'id' => $entity->getUserCreator()->getIdentifier()->getValue(),
                'name' => $entity->getUserCreator()->getName()
            ],
            'created_at' => $entity->getCreatedAt(),
            'observation' => $entity->getObservation(),
            'term' => $entity->getTerm()
        ];
    }
}
