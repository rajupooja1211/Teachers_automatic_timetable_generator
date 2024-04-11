<?php

namespace App\Services;

use App\Models\Sms;

class SmsService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\Timeslot
     */
    protected $model = Sms::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;
}