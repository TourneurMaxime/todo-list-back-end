<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// cf commentaires dans Category pour les conventions de nommage
class Task extends Model
{

    public function category(){
        // l'un ou l'autre fonctionne :
        //return $this->belongsTo('App\Models\Category');
        return  $this->belongsTo(Category::class);
    }

}
