<?php

namespace App;

use App\Casts\Document as DocumentCast;
use App\Casts\PersonName as PersonNameCast;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;

class Persona extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'apellido', 
        'nacimiento', 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at'
    ];
    
    protected $casts = [
        'nacimiento' => 'date',
        'full_document' => DocumentCast::class,
        'full_name' => PersonNameCast::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_document',
        'full_name',
        'nacionalidad',
        'edad',
    ];

    # === FOREING KEYS ============================================================================
        public function tipo_documento()
        {
            return $this->belongsTo('App\TipoDocumento','tipo_documento_id','id');
        }

        public function genero()
        {
            return $this->belongsTo('App\Genero','genero_id','id');
        }

        public function contactos()
        {
            return $this->hasMany('App\Contacto','persona_id','id');
        }

        public function contactos_domicilios()
        {
            return $this->hasMany('App\Contacto','persona_id','id')
                ->where('contactable_type',Domicilio::class);
        }

        public function contactos_telefonos()
        {
            return $this->hasMany('App\Contacto','persona_id','id')
                ->where('contactable_type',Telefono::class);
        }

        public function contactos_emails()
        {
            return $this->hasMany('App\Contacto','persona_id','id')
                ->where('contactable_type',Email::class);
        }

        public function contactos_webpages()
        {
            return $this->hasMany('App\Contacto','persona_id','id')
                ->where('contactable_type',WebPage::class);
        }
    # =============================================================================================

    # === MUTATORS ================================================================================
        public function setNombreAttribute($value) 
        {
            $this->attributes['nombre'] = trim($value);
        }
        
        public function setApellidoAttribute($value)
        {
            $this->attributes['apellido'] = trim($value);
        }
    # =============================================================================================

    # === ACCESSORS & VIRTUAL ATTRIBUTES ==========================================================
        # ================================= Nacimiento
            public function getEdadAttribute()
            {
	            return ($this->nacimiento) ? $this->nacimiento->age : 0;
            }

            public function getNacionalidadAttribute() 
            {
                return ($this->pais) ? $this->pais->nombre : '';
            }

            public function getPaisAttribute() 
            {
                return ($this->tipo_documento) ? $this->tipo_documento->pais : null;
            }

            public function getPaisIdAttribute() 
            {
                return ($this->tipo_documento) ? $this->tipo_documento->pais_id : null;
            }
        # =================================

        # ================================= Personería
            public function getPersonaJuridicaAttribute()
            {
                return ($this->genero_id == Genero::PERSONA_JURIDICA);
            }

            public function getPersonaFisicaAttribute()
            {
                return ($this->genero_id != Genero::PERSONA_JURIDICA);
            }
        # =================================

        # ================================= Contactos
            public function getDomiciliosAttribute()
            {
                return $this->contactos_domicilios->pluck('contactable')->flatten();
            }

            public function getTelefonosAttribute()
            {
                return $this->contactos_telefonos->pluck('contactable')->flatten();
            }

            public function getEmailsAttribute()
            {
                return $this->contactos_emails->pluck('contactable')->flatten();
            }

            public function getWebPagesAttribute()
            {
                return $this->contactos_webpages->pluck('contactable')->flatten();
            }
        # =================================
    # =============================================================================================

    # === QUERYS ==================================================================================
        public static function searchFor($token_filtrado='')
        {
            $token_filtrado = trim($token_filtrado);

            if ($token_filtrado != '') {

                $token_filtrado = mb_strtolower($token_filtrado);
                $token_filtrado = str_replace(","," ",$token_filtrado);
                $token_filtrado = str_replace("  "," ",$token_filtrado);
                $token_filtrado = trim($token_filtrado);
                $token_filtrado = str_replace(" ","%",$token_filtrado);

                $personas = Persona::with('tipo_documento.pais')
                    ->with('contactos.contactable')
                    ->where("documento",'=',$token_filtrado)
                    ->orWhere(DB::raw("LOWER(CONCAT_WS(' ',TRIM(nombre),TRIM(apellido)))"),'LIKE','%'.$token_filtrado.'%')
                    ->orWhere(DB::raw("LOWER(CONCAT_WS(' ',TRIM(apellido),TRIM(nombre)))"),'LIKE','%'.$token_filtrado.'%')
                    ->orderByRaw("CONCAT(apellido,', ',nombre) ASC")
                    ->get();
            } else {
                $personas = new Collection;
            }

            return $personas;
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        /**
         *  Operación para dar de alta una persona en la base de datos.
         *
         *  @param CreatePersonaRequest $request :: request validado con los atributos necesarios 
         *  para crear un item de la clase.
         *
         *  @return Persona :: el item de la clase que acabamos de crear, ya guardado en la base de datos.
         */
        public static function createPersona( & $mensaje_error, $request)
        {
            return DB::transaction( function() use ( & $mensaje_error, $request) {

                $persona = Persona::where('documento',$request->documento)
                    ->where('tipo_documento_id',$request->tipo_documento_id)
                    ->first();

                if (is_null($persona)) {

                    # Solo actualizo los datos si acabo de crear al loquito.
                    # Recordar que esta operación puede ser invocada desde muchos lados.

                    $persona = new Persona;
                        $persona->genero_id         = $request->genero_id;
                        $persona->documento         = $request->documento;
                        $persona->tipo_documento_id = $request->tipo_documento_id;
                    $persona->save();

                    $persona->updatePersona($request);
                }

                return $persona;
            });
        }

        public function updatePersona( & $mensaje_error, $request)
        {
            $resuelto = DB::transaction( function() use ( & $mensaje_error, $request) {

                $resuelto = $this->updateDocumento(
                    $mensaje_error,
                    TipoDocumento::find($request->tipo_documento_id),
                    $request->documento
                );

                if ($resuelto) {

                    $this->fill($request);
                    $this->genero_id = $request->genero_id;
                    $this->save();

                    $resuelto = ($resuelto && $this->updateContactableData($mensaje_error,$request->domicilios,Domicilio::class));
                    $resuelto = ($resuelto && $this->updateContactableData($mensaje_error,$request->telefonos,Telefono::class));
                    $resuelto = ($resuelto && $this->updateContactableData($mensaje_error,$request->emails,Email::class));
                    $resuelto = ($resuelto && $this->updateContactableData($mensaje_error,$request->webpages,WebPage::class));
                }

                if ( ! $resuelto) {
                    DB::rollback();
                }

                return $resuelto;
            });

            return $this;
        } 

        protected function updateDocumento( & $mensaje_error, TipoDocumento $tipo_documento, $numero)
        {
            $resuelto = 1;

            if (($numero != $this->documento) OR ($tipo_documento->id != $this->tipo_documento_id)) {
                
                # Esta cambiando el número y/o tipo de documento.
                
                $persona = Persona::where('documento',$numero)
                    ->where('tipo_documento_id',$tipo_documento->id)
                    ->where('id','!=',$this->id)
                    ->first();

                if (is_null($persona)) {

                    # Solo permitido si no esta utilizado.

                    $this->documento = $numero;
                    $this->tipo_documento_id = $tipo_documento->id;
                } else {

                    $resuelto = 0;
                    $mensaje_error = 'El tipo y número de documento esta asociado a otra persona.';
                }
            }

            return $resuelto;
        }

        protected function updateContactableData( & $mensaje_error, $request, $class)
        {
            $resuelto = DB::transaction( function() use ( & $mensaje_error, $request, $class) {

                $resuelto = true;

                $contactables_actuales = $this->contactos
                    ->where('contactable_type',$class)
                    ->pluck('contactable')->flatten()
                    ->pluck('id');

                $contactables_nuevos = new Collection;

                $principal = 1;

                foreach ($request as $data) {
                    if ( ! $resuelto) { break; }

                    $contactable = $class::firstOrCreateContactable($mensaje_error,$data,$this,$principal);

                    if ($contactable) {

                        $principal = 0;
                        
                        $contactables_nuevos->push($contactable->id);
                    } else {
                        $resuelto = 0;
                    }
                }

                if ($resuelto) {

                    $contactables_borrar = $contactables_actuales->diff($contactables_nuevos);

                    foreach ($contactables_borrar as $contactable_id) {
                        if ( ! $resuelto) { break; }
                        
                        $contacto_borrar = $this->contactos->filter(function ($item) use ($class,$contactable_id) {
                            return (($item->contactable_type == $class) && ($item->contactable_id == $contactable_id));
                        })->first();

                        if ($contacto_borrar) {
                            $resuelto = $contacto_borrar->dropThis($mensaje_error);
                        }
                    }
                }

                if ( ! $resuelto) {
                    DB::rollback();
                }

                return $resuelto;
            });
        }

        public function getCanDropThisAttribute()
        {
            return ($this->contactos->count() == 0);
        }

        protected function dropRelationships( & $mensaje_error, bool $force = false)
        {
            $resuelto = true;
            
            foreach ($this->contactos as $contacto) {
                if ( ! $resuelto) { break; }

                $resuelto = $contacto->dropThis($mensaje_error,$force);
            }

            return $resuelto;
        }
    # =============================================================================================
}

/*
// *********************
    Paciente:
        id
        alta
        baja
        detalles
        estado_id
        tipo_id
        persona_id
        usuario_creador_id

        EstadoPaciente
            nombre
            alias
            descripcion

        TipoPaciente
            nombre
            alias
            descripcion

    Salarios
        id
        desde
        hasta
        sueldo_dia
        sueldo_mes
        comision_turno
        comision_dia
        comision_mes
        asalariado_id
        asalariado_type

    Empleado (Asalariado)
        id
        alta
        baja
        Plus_Sueldo_Dia *
        Comision_Turno *
        Comision_Dia *
        estado_id
        tipo_id
        persona_id
        usuario_creador_id

        EstadoEmpleado
            nombre
            alias
            descripcion

        TipoEmpleado
            nombre
            alias
            descripcion

    Esteticas (Asalariado)
        id
        alta
        baja
        Plus_Sueldo_Dia *
        Comision_Turno *
        Comision_Dia *
        estado_id
        tipo_id
        persona_id
        usuario_creador_id

        EstadoEstetica
            nombre
            alias
            descripcion

        TipoEstetica
            nombre
            alias
            descripcion
// *********************
*/
