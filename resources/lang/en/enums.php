<?php

use App\Enums\PartType;
use App\Enums\HarnessModule;

return [

    PartType::class => [
        PartType::Label           => 'Label',    //标签
        PartType::PVWire          => 'PV wire', //线
        PartType::MVCable         => 'MV cable',   //线
        PartType::MaleConnector   => 'Male connector',   //公头
        PartType::FemaleConnector => 'Female connector',   //母头
        PartType::FuseGTE30       => 'Fuse ≥ 30A',    //保险丝
        PartType::FuseLt30        => 'Fuse < 30A',    //保险丝
        PartType::DustCap         => 'Dust cap',   //防尘塞
        PartType::Molding         => 'Molding',    //注塑件
    ],

    HarnessModule::class => [
        HarnessModule::Jm => 'JM',
        HarnessModule::F4 => 'F4',
        HarnessModule::F6 => 'F6',
    ],
];

