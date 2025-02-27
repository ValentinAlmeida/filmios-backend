<?php

namespace App\Observers;

use App\Models\RequestHistoryModel;
use App\Models\RequestModel;

class RequestObserver
{
    /**
     * Handle the RequestModel "created" event.
     */
    public function created(RequestModel $requestModel): void
    {
        RequestHistoryModel::create([
            RequestHistoryModel::STATUS_KEY => $requestModel->status_establishment_key,
            RequestHistoryModel::USER_APPROVER_ID => $requestModel->user_approver_id,
            RequestHistoryModel::OBSERVATION => $requestModel->observation,
            RequestHistoryModel::REQUEST_ID => $requestModel->id,
            RequestHistoryModel::TERM => $requestModel->term,
        ]);
    }

    /**
     * Handle the RequestModel "updated" event.
     */
    public function updated(RequestModel $requestModel): void
    {
        RequestHistoryModel::create([
            RequestHistoryModel::STATUS_KEY => $requestModel->status_establishment_key,
            RequestHistoryModel::USER_APPROVER_ID => $requestModel->user_approver_id,
            RequestHistoryModel::OBSERVATION => $requestModel->observation,
            RequestHistoryModel::REQUEST_ID => $requestModel->id,
            RequestHistoryModel::TERM => $requestModel->term,
        ]);
    }
}
