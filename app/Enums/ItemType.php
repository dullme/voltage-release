<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 产品类型
 * @method static static Harness()
 * @method static static Extender()
 */
final class ItemType extends Enum
{

    const Harness = 1;
    const Extender = 2;
}
