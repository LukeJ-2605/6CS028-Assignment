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

        $data = [
		'pokemon' => $model->getPokemon($slug),
		'title'   => 'Pokemon Info',
		];

        if ($data['pokemon'] === null) {
            throw new PageNotFoundException('Cannot find the pokemon item: ' . $slug);
        }

        $data['card_name'] = $data['pokemon']['card_name'];
		

        return view('templates/header', $data)
            . view('pokemon/view')
            . view('templates/footer');
    }
	public function new()
	{
		helper('form');
		
		return view('templates/header', ['title' => 'Add Card Information'])
			.view('pokemon/create')
			.view('templates/footer');
	}
	    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['card_name', 'card_type', 'card_image','card_set']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'card_name' => 'required|max_length[255]|min_length[3]',
            'card_type'  => 'required|max_length[5000]|min_length[3]',
			'card_image' => 'required|max_length[10000]|min_length[3]',
			'card_set' => 'required|max_length[5000]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(PokemonModel::class);
		
		$newCardId = $model->generateCardId();

        $model->insert([
			'card_id' => $newCardId,
            'card_name' => $post['card_name'],
            'slug'  => url_title($post['card_name'], '-', true),
            'card_type'  => $post['card_type'],
			'image_url' => $post['card_image'],
			'card_set' => $post['card_set'],
        ]);

        return view('templates/header', ['title' => 'Add Card Information'])
            . view('pokemon/success')
            . view('templates/footer');
    }
	public function search()
{
    $query = $this->request->getGet('query');
    
    if (empty($query)) {
        return redirect()->to(base_url('pokemon'));
    }
    
    $model = model(PokemonModel::class);
    $data = [
        'title' => 'Search Results for: ' . $query,
        'pokemon_list' => $model->searchPokemon($query),
        'search_term' => $query
    ];
    
    return view('templates/header', $data)
        . view('pokemon/index', $data)
        . view('templates/footer');
}
	
}