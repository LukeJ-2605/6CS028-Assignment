<?php
namespace App\Controllers;
use App\Models\PokemonModel;

class Ajax extends BaseController
{
    public function get($slug = null)
    {
        $model = model(PokemonModel::class);
        $data = $model->getPokemon($slug);
        
        // Use the response object to set JSON headers and return data
        return $this->response->setJSON($data);
    }
	
}