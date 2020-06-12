<?php

function validarIntervaloDeTiempo($fecha_ini,$fecha_fin)
{
    $valida = 0; 

    $date1 = strtotime($fecha_ini);
    $date2 = strtotime($fecha_fin);

    //dd($fecha_ini,$fecha_fin,$fecha_fin < $fecha_ini);

    if ($fecha_fin >= $fecha_ini) {
        $valida = 1;
    }

    return $valida;
}

function TiempoEntreFechasTexto($fecha_ini,$fecha_fin,$aproximar=0)
{
    $datetime1 = date_create($fecha_ini);
    $datetime2 = date_create($fecha_fin);
    $intervalo = date_diff($datetime1, $datetime2);

    $restan_anios   = '';
    $restan_meses   = '';
    $restan_dias    = '';
    $cadenas = 0;

    $tiempo_restante = '';

    if ( $intervalo->y > 0 ) { 
        $cadenas += 1;
        $restan_anios = $intervalo->y . ' año'; 
        if ( $intervalo->y > 1 ) { $restan_anios .= 's';  }
    }
    if ( $intervalo->m > 0 ) { 
        $cadenas += 1;
        $restan_meses = $intervalo->m . ' mes'; 
        if ( $intervalo->m > 1 ) { $restan_meses .= 'es';  }
    }
    if ( $intervalo->d > 0 ) { 
        $cadenas += 1;
        $restan_dias = $intervalo->d . ' día'; 
        if ( $intervalo->d > 1 ) { $restan_dias .= 's';  }
    }

    if ($aproximar) {
        if ($restan_anios!='') {
            $tiempo_restante .= $restan_anios;
        } elseif ($restan_meses!='') {
            $tiempo_restante .= $restan_meses;
        } else {
            $tiempo_restante .= $restan_dias;
        }
    } else {
        if ($cadenas < 3) {
            $tiempo_restante .= $restan_anios;

            if (($tiempo_restante != '') && ($restan_meses != '')) { $tiempo_restante .= ', '; }
            $tiempo_restante .= $restan_meses;

            if (($tiempo_restante != '') && ($restan_dias != '')) { $tiempo_restante .= ', '; }
            $tiempo_restante .= $restan_dias;
        } else {
            $tiempo_restante .= $restan_anios .', '. $restan_meses .' y '. $restan_dias;
        } 
    }

    return $tiempo_restante;
}
# ==================================

/**
 * Calcula la edad a partir de la fecha de nacimiento
 *
 * @param  $fecha en formato: 'dd/mm/aaaa'
 * @return entero $edad
 */
function calcular_edad($fecha)
{
    if (is_null($fecha) OR ($fecha== '')) { return 0; }

    list( $dia,$mes,$ano ) = explode("/",$fecha);

    $dia_actual = date("d");
    $mes_actual = date("m");
    $ano_actual = date("Y");

    $ano_diferencia = $ano_actual - $ano;
    
    switch ($mes) {
        case ($mes < $mes_actual):
            # ya cumpli años
            break;

        case ($mes == $mes_actual):
            switch ($dia) {
                case ($dia < $dia_actual):
                    # ya cumpli años
                    break;

                case ($dia == $dia_actual):
                    # ya cumpli años
                    break;

                case ($dia > $dia_actual):
                    $ano_diferencia--;
                    break;
            }
            break;

        case ($mes > $mes_actual):
            $ano_diferencia--;
            break;
    }
    
    return $ano_diferencia;
}

/**
 * Convierte la fecha del formato MYSQL al formato Latino
 *
 * @param $fecha en formato: 'aaaa-mm-dd'
 * @return $fecha_latino en formato: 'dd-mm-aaaa'
 */
function date_mysql_to_latino($fecha)
{
    list( $ano,$mes,$dia ) = explode("-",$fecha);
    
    $sep = '/';

    $fecha_latino = $dia . $sep . $mes . $sep .$ano;

    return $fecha_latino;
}

/**
 * Convierte la fecha del formato MYSQL al formato Yankee
 *
 * @param $fecha en formato: 'aaaa-mm-dd'
 * @return $fecha_yankee en formato: 'mm-dd-aaaa'
 */
function date_mysql_to_yankee($fecha)
{
    list( $ano,$mes,$dia ) = explode("-",$fecha);
    
    $sep = '/';

    $fecha_yankee = $mes . $sep . $dia . $sep .$ano;

    return $fecha_yankee;
}

/**
 * Convierte la fecha del formato latino al formato MYSQL
 *
 * @param $fecha en formato: 'dd-mm-aaaa'
 * @return $fecha_mysql en formato: 'aaaa-mm-dd'
 */
function date_latino_to_mysql($fecha)
{
    $fecha_mysql = NULL;

    if ( $fecha!='' || $fecha!=NULL ) {

        list( $dia,$mes,$ano ) = explode("/",$fecha);
        $fecha_mysql = $ano .'-'. $mes .'-'. $dia;
    }



    return $fecha_mysql;
}

/**
 * Convierte la fecha del formato yankee al formato MYSQL
 * @param $fecha en formato: 'mm-dd-aaaa'
 * @return $fecha_mysql en formato: 'aaaa-mm-dd'
 */
function date_yankee_to_mysql($fecha)
{
    $fecha_mysql = NULL;

    if ( $fecha!='' || $fecha!=NULL ) {

        list( $mes,$dia,$ano ) = explode("-",$fecha);

        $fecha_mysql = $ano .'-'. $mes .'-'. $dia;
    }

    return $fecha_mysql;
}

/**
 * Extrae eñ año de una fecha
 *
 * @param $fecha en formato: 'dd/mm/aaaa'
 * @return $ano en formato: 'aaaa'
 */
function anio_fecha_latino($fecha)
{
    $ano = NULL;

    if ( $fecha!='' || $fecha!=NULL ) {
        list( $dia,$mes,$ano ) = explode("/",$fecha);
    }

    return $ano;
}

/**
 * Convierte la fecha del formato yankee al formato MYSQL
 *
 * @param $fecha en formato: 'mm-dd-aaaa'
 * @return $fecha_mysql en formato: 'aaaa-mm-dd'
 */
function filtrar_fecha($fecha)
{
    $fecha_mysql = NULL;

    if ( $fecha!='' || $fecha!=NULL ) {

        list( $dia,$mes,$ano ) = explode("/",$fecha);

        $fecha_mysql = $ano .'-'. $mes .'-'. $dia;
    }

    return $fecha_mysql;
}

/**
 * Devuelve el nombre del dia de la semana
 *
 * @return el nombre del dia a partir de una fecha dada
 */
protected function nombre_dia_semana($fecha) 
{
    if (strpos($fecha, '/') !== FALSE){
       $fecha = tr_replace('/','-',$fecha);
    }

    $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');
    $aindex = (int) date('w', strtotime($fecha));
    $aindex--;

    return $dias[$aindex];
}

/**
 * 
 * fuente: snipplr.com/view/8708/
 *
 * @return un string con la fecha en formato: "dia_semana, DD de MM de AAAA"
 */
function fecha_texto($fecha,$abbr=0)
{
    $fecha = strtotime($fecha);
    $ano = date('Y',$fecha);
    $mes = date('n',$fecha);
    $dia = date('d',$fecha);
    $diasemana = date('w',$fecha);

    $diassemanaN = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
    $mesesN = array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    if ($abbr) {
        $diassemanaN = array("Dom.","Lun.","Mar.","Mié.","Jue.","Vie.","Sáb."); 
        $mesesN = array(1=>"Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Ago.","Sep.","Oct.","Nov.","Dic.");
    }

    return $diassemanaN[$diasemana] . ", " . $dia . " de ". $mesesN[$mes] ." de " . $ano;
}

/**
 * Devuelve el nombre del mes
 *
 * @return el nombre del mes a partir de una fecha dada
 */
function mes_texto($mes)
{
    $mesesN = array(
        1 => "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"
    );
    
    return( $mesesN[$mes] );
}
