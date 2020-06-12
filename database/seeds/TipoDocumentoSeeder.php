<?php

use App\Genero;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    const ARGENTINA = 1;
    const BOLIVIA = 27;
    const BRASIL = 32;
    const CHILE = 46;
    const COLOMBIA = 50;
    const ECUADOR = 67;
    const PARAGUAY = 175;
    const PERU = 176;
    const URUGUAY = 241;
    const VENEZUELA = 246;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cargando tipos de documentos.');

        $this->tiposDocumentosArgentina(TipoDocumentoSeeder::ARGENTINA);
        $this->tiposDocumentosBrasil(TipoDocumentoSeeder::BRASIL);
        $this->tiposDocumentosChile(TipoDocumentoSeeder::CHILE);
        $this->tiposDocumentosParaguay(TipoDocumentoSeeder::PARAGUAY);
    }

    protected function tiposDocumentosArgentina($pais_id)
    {
        DB::table('tipos_documentos')->insert(array(
            array ( 
                "id"            => 1,
                "nombre"        => "Documento nacional de identidad",
                "alias"         => "DNI",
                "descripcion"   => "",
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => NULL
            ),
            array ( 
                "id"            => 2,
                "nombre"        => "Libreta de enrolamiento",
                "alias"         => "LE",
                "descripcion"   => "",
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => 1
            ),
            array ( 
                "id"            => 3,
                "nombre"        => "Libreta cívica",
                "alias"         => "LC",
                "descripcion"   => "",
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => 2
            ),
            array ( 
                "id"            => 4,
                "nombre"        => "Pasaporte",
                "alias"         => "PAS",
                "descripcion"   => "",
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => NULL
            ),
            array ( 
                "id"            => 5,
                "nombre"        => "Clave única de identificación tributaria", 
                "alias"         => "CUIT",
                "descripcion"   => "El CUIT es la Clave Única de Identificación Tributaria que le otorga la AFIP (Administración Federal de Ingresos Públicos) a todas las personas físicas, empresas u entidades de diversa índole, que realizan alguna actividad económica. El CUIT está compuesto por 11 dígitos, de los cuales el número del primer bloque identifica que tipo de persona es (física –hombre o mujer- o jurídica), siendo 20 para los hombre, 27 para las mujeres y 30 para las empresas; el segundo bloque corresponde al número de DNI de la persona física o un número de sociedad asignado por la AFIP en el caso de una empresa; y finalmente un número verificador, entre 0 y 9.", 
                "pais_id"       => $pais_id,
                "personeria"    => NULL,
                "genero_id"     => NULL
            ),
            array ( 
                "id"            => 6,
                "nombre"        => "Codigo único de identificación laboral", 
                "alias"         => "CUIL",
                "descripcion"   => "El CUIL es el Código Único de Identificación Laboral que le otorga el ANSES (Administración Nacional de Seguridad Social) a todo trabajador en el inicio de su actividad laboral en relación de dependencia que pertenezca al Sistema Integrado de Jubilaciones y Pensiones, y a toda otra persona que pida alguna prestación en la Seguridad Social. El CUIL es un número de 11 dígitos en total, que se compone de la siguiente manera: un número de dos cifras iniciales, que en el caso de los hombres es 20, en las mujeres 27 y también el 23 para hombres y mujeres con idéntico número de Libreta Cívica o Libreta de Enrolamiento; el número de DNI de la persona; y un último número entre 0 y 9, que cumple la función de dígito verificador. Los tres bloques se dividen con guiones, ejemplo: 20-00000000-3. Puedes aprender a sacar el CUIL en este enlace.", 
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => NULL
            )
        ));
    }

    protected function tiposDocumentosBrasil($pais_id)
    {
        DB::table('tipos_documentos')->insert(array(
            array ( 
                "id"            => 9,
                "nombre"        => "Cadastro de pessoas físicas", 
                "alias"         => "CPF",
                "descripcion"   => "El \"Registro de Personas Físicas\" es la identificación del registro de contribuyentes individual brasileño, un número atribuido por el Ingreso Federal de Brasil a brasileños y extranjeros residentes que pagan impuestos o participan, directa o indirectamente, en actividades que proporcionan ingresos para cualquiera de las docenas de diferentes tipos de impuestos existentes en Brasil.", 
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => NULL
            ),
            array ( 
                "id"            => 10,
                "nombre"        => "Cadastro nacional da pessoa jurídica", 
                "alias"         => "CNPJ",
                "descripcion"   => "El \"Registro Nacional de Entidades Jurídicas\" es un número de identificación emitido a las empresas brasileñas por la Secretaría de Ingresos Federales de Brasil.", 
                "pais_id"       => $pais_id,
                "personeria"    => 'jurídica',
                "personeria"    => Genero::PERSONERIA_JURIDICA,
                "genero_id"     => NULL
            )
        ));
    }

    protected function tiposDocumentosChile($pais_id)
    {
        DB::table('tipos_documentos')->insert(array(
            array ( 
                "id"            => 8,
                "nombre"        => "Rol único tributario", 
                "alias"         => "RUT",
                "descripcion"   => "El Rol Único Nacional, conocido también por el acrónimo RUN, es el número identificatorio único e irrepetible que posee todo chileno, residente o no en Chile, y todo extranjero que permanezca, temporal o definitivamente, con una visa distinta a la visa de turista en dicho país. Las personas jurídicas cuentan con un número identificatorio similar, el Rol Único Tributario (RUT), el cual es asignado por el Servicio de Impuestos Internos (SII) a solicitud del interesado. El RUN es también el RUT de las personas físicas.", 
                "pais_id"       => $pais_id,
                "personeria"    => NULL,
                "genero_id"     => NULL
            )
        ));
    }

    protected function tiposDocumentosParaguay($pais_id)
    {
        DB::table('tipos_documentos')->insert(array(
            array ( 
                "id"            => 7,
                "nombre"        => "Cédula de identidad civil", 
                "alias"         => "CIC/CI",
                "descripcion"   => "Número identificatorio de todo paraguayo.", 
                "pais_id"       => $pais_id,
                "personeria"    => Genero::PERSONERIA_FISICA,
                "genero_id"     => NULL
            ),
        ));
    }
}
