<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class BaseModel extends Model
{
    use SoftDeletes;
    
    /**
     * For Caching all Queries.
     */
    // use CacheQueryBuilder;
    
    /**
     *  The attributes that should be mutated to dates.
     *
     *  @var array
     */
    protected $dates = ['deleted_at'];

    # =============================================================================================
        /**
         *  Return an array, made from all the items in "$items", whose keys and values
         *  are made from the source attributes "$key" and "$value" respectively.
         *
         *  @param  array $items : the source
         *  @param  string $key : the name of an attribute from the source
         *  @param  string $value : the name of an attribute from the source
         *  
         *  @return array
         *
         *  @example 
         *      Suppose $key == 'an_attribute', then you should be able to access 
         *          
         *          $items->an_attribute
         *
         *      So, both "$key" and "$value" are not attributes from the source "$items", 
         *      just the name of them.
         */
        protected static function getListFields($items,$key,$value)
        {
            $select_fields = array();

            foreach ( $items as $item ) {

                $my_key     = $item->$key;
                $my_value   = $item->$value;

                $select_fields[$my_key] = $my_value;
            }

            return $select_fields;
        }
    # =============================================================================================

    # === REPOSITORIO =============================================================================
        /**
         *  If you are able to delete this object from the databese.
         *
         *  @example $some_object->can_drop_this
         *
         *  @return boolean, able or not.
         */
        public function getCanDropThisAttribute()
        {
            return false;
        }

        /**
         *  This method allows you to delete the object from the database.
         *
         *  @param $mensaje_error :: exception error message. 
         *  @param $force :: if you want to force the erase, in spite of the fact that it has relationships. 
         *
         *  @example $some_object->dropThis($msg)
         *
         *  @return boolean :: if it was possible to complete the operation or not.
         */
        public function dropThis( & $mensaje_error, bool $force = false)
        {
            return DB::transaction( function() use ( & $mensaje_error, $force) {

                if ($force OR $this->can_drop_this) {

                    $resuelto = $this->dropRelationships($mensaje_error,$force);

                    # Esta sentencia nos sirve para liberar al objeto de todas sus relaciones,
                    # por lo cual ayuda a no alcanzar un limite de memoria 
                    # (sobre todo cuando se esta borrando desde una instancia superior).
                    $this->refresh();

                    if ($resuelto) {
                        $this->forceDelete();
                    } else {
                        DB::rollback();
                    }
                } else {
                    $resuelto = false;
                    $mensaje_error = 'No es posible eliminar el item [' .$this->table. ',' .$this->id. ']. Contacte con su administrador.';
                }

                return $resuelto;
            });
        }

        /**
         *  This method allows you to delete the object from the database.
         *
         *  You should rewrite this method for all the classes that extend of this one.
         *
         *  @param $mensaje_error :: exception error message. 
         *  @param $force :: if you want to force the erase, in spite of the fact that it has relationships. 
         *
         *  @example $some_object->dropRelationships($msg)
         *
         *  @return boolean :: if it was possible to complete the operation or not.
         */
        protected function dropRelationships( & $mensaje_error, bool $force = false)
        {
            return true;
        }

        /**
         *  This method allows you to delete the object from the database but without concerning of the operatio result.
         *
         *  @param $mensaje_error :: exception error message. 
         *  @param $force :: if you want to force the erase, in spite of the fact that it has relationships. 
         *
         *  @example $some_object->dropRelationships($msg)
         *
         *  @return boolean :: if it was possible to complete the operation or not.
         */
        public function tryToDropThis( bool $force = false)
        {
            $mensaje_error = '';

            return $this->dropThis($mensaje_error,$force);
        }
    # =============================================================================================
}