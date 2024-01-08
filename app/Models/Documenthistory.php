<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documenthistory extends Model
{
    //use HasFactory;
    public function document(){
        return $this->belongsTo(Document::class);
    }

    public function documentdetails(){
        return $this->hasOne(Document::class,'id','document_id');
    }

}
