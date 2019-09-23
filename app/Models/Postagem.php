<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postagem extends Model {

    use SoftDeletes;

    protected $table = 'postagem';

    protected $appends = ['preview_descricao'];

    protected $fillable = [
        'titulo', 'descricao', 'imagem', 'ativa', 'publish_at', 'user_inc', 'user_alt'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function userCriation() {
        return $this->belongsTo('App\Models\User', 'user_inc');
    }

    public function userPublication() {
        return $this->belongsTo('App\Models\User', 'user_alt');
    }

    public function getPreviewDescricaoAttribute() {
        return mb_strimwidth($this->getAttribute('descricao'), 0, 180, "...");
    }
}
