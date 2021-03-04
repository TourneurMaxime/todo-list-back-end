<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Pour que cela fonctionne automatiquement
// Il faut que notre modèle étende la classe Illuminate\Database\Eloquent\Model
// Et suivre les conventions suivantes :
// - la table contenant les données doit être au pluriel. ex : categories
// - la table en question possède un champ id qui soit un autoincrément/clé primaire,
// - il faut que la classe porte le nom de la table mais en PascalCase et au singulier. ex Category pour la table categories
// - il faut également avoir 2 champs created_at et updated_at de type timestamp
class Category extends Model
{
    //
}
