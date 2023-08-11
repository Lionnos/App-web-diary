<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class TCity extends Model {
    protected $table = 'tcity';
    protected $primaryKey = 'idCity';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
}
?>