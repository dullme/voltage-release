<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * 零件类型
 * @method static static Label()
 * @method static static PVWire()
 * @method static static MVCable()
 * @method static static MaleConnector()
 * @method static static FemaleConnector()
 * @method static static Fuse()
 * @method static static DustCap()
 * @method static static Molding()
 */
final class PartType extends Enum implements LocalizedEnum
{

    const Label = 1; //标签
    const PVWire = 2; //线
    const MVCable = 3; //线
    const MaleConnector = 4; //公头
    const FemaleConnector = 5; //母头
    const FuseGTE30 = 6; //保险丝
    const FuseLt30 = 7; //保险丝
    const DustCap = 8; //防尘塞
    const Molding = 9; //注塑件
}
