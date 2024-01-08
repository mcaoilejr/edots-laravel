<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
   protected $fillable = ['documentcode','title','documenttype_id','submittedby','encodedby','forwardedto','status'];

   public function Documenthistory()
    {
      return $this->hasMany(Documenthistory::class,'document_id');
    }

    
}
