<?php
/**
 * 默认的精度为小数点后两位
 * @param $number
 * @param int $scale
 * @return \Moontoast\Math\BigNumber
 */
function bigNumber($number, $scale = 2)
{
    return new \Moontoast\Math\BigNumber($number, $scale);
}

function getStringLength($solarPanelWidth, $specificationQuantity)
{
    return ceil($solarPanelWidth * $specificationQuantity * STRING_LENGTH_BUFFER);
}

function ceilDecimal($number, $ceil = 3){
    $str = '';
    for ($i = 1; $i <= $ceil; $i++) {
        $str .= 0;
    }
    $str = intval('1' . $str);

    return ceil($number * $str) / $str;
}
