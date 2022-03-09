<?php

/**
 * Division entera entre dos numeros
 * @param $a
 * @param $b
 * @return $a div $b (el cociente, entero, de dividir a entre b)
 */
function div_entera( $a,$b )
{
    
    return ($a - $a % $b) / $b;
}

/**
 *  Porcentaje que representa un valor sobre un total dados.
 *  
 *  @param $total
 *  @param $valor
 *  
 *  @return int :: $valor * 100 / $total.
 */
function calcularPorcentaje($total,$valor,$acumulado = 0)
{
    $porcentaje = 0;

    if ($total > 0) {
        $porcentaje = $valor * 100 / $total;
    }
    
    $porcentaje = round($porcentaje,2);

    $porcentaje = controlarAcumulado($porcentaje,$acumulado);

    return $porcentaje;
}

function formatoMoneda($valor, $prefijo='$ ', $postfijo='.-', $decimales=2, $separador_decimal=",", $separador_mil=".")
{
    $monto_texto = '';

    $monto_texto .= $prefijo;
    $monto_texto .= number_format($valor,$decimales,$separador_decimal,$separador_mil);
    $monto_texto .= $postfijo;

    return $monto_texto;
}

function formatoPorcentaje($valor, $prefijo='', $postfijo=' %', $decimales=2, $separador_decimal=",", $separador_mil=".")
{
    $monto_texto = '';

    $monto_texto .= $prefijo;
    $monto_texto .= number_format($valor,$decimales,$separador_decimal,$separador_mil);
    $monto_texto .= $postfijo;

    return $monto_texto;
}

/**
 * Si es el caso de que estoy calculando el porcentaje que representan varios datos
 * y por redondeo la cuenta supera el 100%, es necesario restar el excedente al porcentaje.
 *
 *  Ejemplo: 
 *  Supongamos que tenemos los datos
 *      X = 4 ; Y = 1 ; Z = 1 ==> total = 6
 *
 *  Entonces, 
 *      Xp = 66.67 % ; Yp = 16.67 ; Zp = 16.67 ===> Xp + Yp + Zp = 100,01 %
 *
 *  Lo que hace la función es restarle el excedente (lo va a hacer siempre que se mande el acumulado)
 *      Zp = 16.67 - 0.01 = 16.66
 */
function controlarAcumulado($porcentaje,$acumulado)
{
    $excedente = ($acumulado + $porcentaje) - 100;
    if ($excedente > 0) {
        $porcentaje -= $excedente;
    }

    return $porcentaje;
}

function intoRange($value,$min,$max)
{
    if ($value > $max) { 
        $value = $max; 
    } elseif ($value < $min) {
        $value = $min; 
    }

    return $value;
}
