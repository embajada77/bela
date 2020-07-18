<?php

/**
 * Da formato especil a una palabra o conjunto de palabras.
 *
 * @param  $value frase a abreviar
 * @return string
 */
function specialUcwords( string $value=''): string
{
    // Esto hay que manejarlo con expresiones regulares

    $value = str_replace(".", ". ", $value);      // Traduce: "G.M.V."    => "G. M. V."
    $value = str_replace(".  ", ". ", $value);      // Traduce: "G.  M. V." => "G. M. V."

    $value = str_replace(",", ", ", $value);      // Traduce: "Vogt,Gon"   => "Vogt, Gon"
    $value = str_replace(",  ", ", ", $value);      // Traduce: "Vogt,  Gon" => "Vogt, Gon"
    $value = str_replace(" ,", ",", $value);       // Traduce: "Vogt , Gon" => "Vogt, Gon"

    // ======================================
    $value = str_replace("(", "( ", $value);       // Traduce: 'Rotiseria "El Rodeo"' => 'Rotiseria " El Rodeo "'
    $value = str_replace("(  ", "( ", $value);     // Traduce: 'Rotiseria "  El Rodeo"' => 'Rotiseria " El Rodeo "'

    $value = str_replace("\"", "\" ", $value);     // Traduce: 'Rotiseria "El Rodeo"' => 'Rotiseria " El Rodeo "'
    $value = str_replace("\"  ", "\" ", $value);   // Traduce: 'Rotiseria "  El Rodeo"' => 'Rotiseria " El Rodeo "'

    $value = ucwords(mb_strtolower($value));

    $value = str_replace("\" ", "\"", $value);     // Traduce: 'Rotiseria " El Rodeo "' => 'Rotiseria "El Rodeo"'

    $value = str_replace("( ", "(", $value);       // Traduce: 'Rotiseria " El Rodeo "' => 'Rotiseria "El Rodeo"'
    // ======================================

    $value = str_replace( "Y ", "y ", $value);

    return $value;
}

/**
 * Concatena la primer palabra de una frase con las iniciales del resto de las palabras.
 *
 * @param  $value frase a abreviar
 * @return string
 */
function firstWordThenAbbr( string $value=''): string
{
    $my_string = '';

    $palabras = explode(' ',$value);

    $cantidad = count($palabras);
    for ($i=0; $i < $cantidad; $i++) { 
        if ($palabras[$i]!='') {
            if ($my_string!='') {
                if ( ( ! esConector($palabras[$i])) and !is_numeric($palabras[$i]) ) {
                    $primer_letra = substr($palabras[$i],0,1);

                    $my_string .= mb_strtoupper($primer_letra);
                    $my_string .= '.';
                } else {
                    $my_string .= ' ';
                    $my_string .= mb_strtolower($palabras[$i]);
                    $my_string .= ' ';
                }
            } else {
                if ( ! esConector($palabras[$i])) {
                    $my_string .= $palabras[$i];
                    if ($cantidad > 1) { $my_string .= ' '; }
                }
            }
        }
    }

    return trim($my_string);
}

function iniciales( string $value=''): string
{
    $my_string = '';

    $palabras = explode(' ',$value);

    $cantidad = count($palabras);

    for ($i=0; $i < $cantidad; $i++) { 
        if ($palabras[$i] != '') {
	        //if ($my_string != '') {
	            if (( ! esConector($palabras[$i])) && ( ! is_numeric($palabras[$i]))) {
	                $primer_letra = substr($palabras[$i],0,1);

	                $my_string .= mb_strtoupper($primer_letra);
	                $my_string .= '.';
	            } else {
	                $my_string .= ' ';
	                $my_string .= mb_strtolower($palabras[$i]);
	                $my_string .= ' ';
	            }
	        //} else {
	        //    if ( ! esConector($palabras[$i])) {
	        //        $my_string .= $palabras[$i];
	        //        if ($cantidad > 1) { $my_string .= ' '; }
	        //    }
	        //}
        }
    }

    return trim($my_string);
}

function esConector( string $palabra): string
{
	$es_conector = false;

	if ($palabra != "") { 

	    $collection = collect([
	        "a",
	        "y",
	        "&",
	        "de",
	        "en",
	        "el",
	        "ellos",
	        "ellas",
	        "la",
	        "las",
	        "lo",
	        "los",
	        "srl",
	    ]);

	    $es_conector = $collection->search(mb_strtolower($palabra));
	}

    return $es_conector;
}
