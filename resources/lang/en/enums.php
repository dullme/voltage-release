<?php

use App\Enums\PartType;
use App\Enums\HarnessModule;

return [

    PartType::class => [
        PartType::FuseGTE30 => 'Fuse ≥ 30A',
        PartType::FuseLt30  => 'Fuse < 30A',
        PartType::PVWire  => 'PV wire',
        PartType::MVCable  => 'MV cable',
    ],

    HarnessModule::class => [
        HarnessModule::Jm => 'JM',
    ],
];

