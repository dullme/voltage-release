<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 板子连接方式
 * @method static static SkipString()
 * @method static static InSeries()
 */
final class ConnectionMethod extends Enum
{

    const SkipString = 1;
    const InSeries = 2;
}
