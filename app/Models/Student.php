<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'nisn';
    protected $keyType = 'string';
    protected $fillable = [
    	'nisn',
    	'nis',
    	'student_name',
    	'class_id',
    	'address',
    	'phone_number',
    	'spp_id',
    	'user_id',
    ];

    protected $likeFilterFields = [
        'student_name',
        'address',
        'phone_number',
        'year',
    ];

    public function spp()
    {
    	return $this->belongsTo(Spp::class, 'spp_id', 'spp_id');
    }

    public function class()
    {
    	return $this->belongsTo(Classes::class, 'class_id', 'class_id');
    }

    public function scopeFilter($builder, $filters = [])
    {
        if(!$filters){
            return $builder;
        }
        $students = $this->getTable();
        $defaultTableFields = $this->fillable;

        foreach($filters as $field => $value){

            if(in_array($field, $defaultTableFields) || !$value){
                continue;
            }

            if(in_array($field, $this->likeFilterFields)){
                $builder->where($students.'.'.$field, 'LIKE', "%$value%");
            }else if(is_array($value)){
                $builder->whereIn($field, $value);
            }else{
                $builder->where($field, $value);
            }
        }
        return $builder;
    }
}
