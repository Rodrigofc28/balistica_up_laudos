<?php

namespace App\Models;

use App\Scopes\NomeScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Origem extends Model
{
    use SoftDeletes;

    protected $table = 'marcas'; //tabela marcas

    protected $fillable = ['nome', 'categoria','pais_origem','fabricacao']; //campos

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function arma()
    {
        return $this->belongsTo(Arma::class);
    }

    /**
     * Global scope utilizado para ordenar a busca pelo nome
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NomeScope());
    }

    /**
     * Local Scope utilizado para filtrar os Países de Origem
     * cadastrados.
     *
     * Busca todas as origens validas
     * e se a origem cadastrada tiver sido excluída, traz
     * também como resultado (para evitar erro ao editar)
     *
     * OBS: não traz todos os registros excluidos, apenas o que
     * foi excluído e estava em uso.
     *
     * @param $query
     * @param $used_origem
     * @return mixed
     */
    public function scopeOrigensWithTrashed($query, $used_origem)
    {
        return $query->whereRaw("pais_origem = '$used_origem->pais_origem' or deleted_at is null ")->get();
    }
}
