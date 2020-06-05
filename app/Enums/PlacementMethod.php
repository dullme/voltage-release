<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 太阳能板摆放方式
 * @method static static Portrait()
 * @method static static Landscape()
 */
final class PlacementMethod extends Enum
{
    const Portrait =   1;
    const Landscape =   2;
}
