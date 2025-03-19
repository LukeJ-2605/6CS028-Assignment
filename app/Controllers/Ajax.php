<?php

namespace App\Controllers;

use App\Models\PokemonModel;

class Ajax extends BaseController
{
	public function get($slug = null)
	{
		$model = model(PokemonModel::class);
		$data = $model->getPokemon($slug);

		print(json_encode($data));
	}
	
}