<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 零件类型
 * @method static static Label()
 * @method static static Line()
 * @method static static MaleConnector()
 * @method static static FemaleConnector()
 * @method static static Fuse()
 * @method static static DustPlug()
 * @method static static InjectionModel()
 */
final class PartType extends Enum
{

    const Label = 1; //标签
    const Line = 2; //线
    const MaleConnector = 3; //公头
    const FemaleConnector = 4; //母头
    const Fuse = 5; //保险丝
    const DustPlug = 6; //防尘塞
    const InjectionModel = 7; //注塑件
}
