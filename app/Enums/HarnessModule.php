<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * 组件
 * @method static static Jm()
 * @method static static F4()
 * @method static static F6()
 */
final class HarnessModule extends Enum implements LocalizedEnum
{

    const Jm = 1; //JM
    const F4 = 2; //F4
    const F6 = 3; //F6
}
