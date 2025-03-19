<?php

namespace App\Controllers;

use App\Models\PokemonModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pokemon extends BaseController
{
    public function index()
    {
        $model = model(PokemonModel::class);

        $data = [
		'pokemon_list' => $model->getPokemon(),
		 'title'     => 'Pokemon Archive',
        ];

        return view('templates/header', $data)
            . view('pokemon/index')
            . view('templates/footer');
    }

   public function show(?string $slug = null)
    {
        $model = model(PokemonModel::class);

        $data['pokemon'] = $model->getPokemon($slug);

        if ($data['pokemon'] === null) {
            throw new PageNotFoundException('Cannot find the pokemon item: ' . $slug);
        }

        $data['title'] = $data['pokemon']['title'];

        return view('templates/header', $data)
            . view('pokemon/view')
            . view('templates/footer');
    }
	public function new()
	{
		helper('form');
		
		return view('templates/header', ['title' => 'Add a Card'])
			.view('pokemon/create')
			.view('templates/footer');
	}
	    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['name', 'type']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'name' => 'required|max_length[255]|min_length[3]',
            'type'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(PokemonModel::class);

        $model->save([
            'name' => $post['card_name'],
            'slug'  => url_title($post['card_name'], '-', true),
            'type'  => $post['card_type'],
        ]);

        return view('templates/header', ['title' => 'Add Card Information'])
            . view('pokemon/success')
            . view('templates/footer');
    }

}