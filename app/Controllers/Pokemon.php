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

    $data = $this->request->getPost(['card_name', 'card_type', 'image_url', 'card_set']);
    
    if (! $this->validateData($data, [
        'card_name' => 'required|max_length[255]|min_length[3]',
        'card_type'  => 'required|max_length[5000]|min_length[3]',
        'card_set' => 'required|max_length[5000]|min_length[3]',
        'image_url' => 'required|max_length[1000000]|min_length[3]', // Validate image upload
    ])) {
        return $this->new();
    }

    $post = $this->validator->getValidated();

    $model = model(PokemonModel::class);
    
    $newCardId = $model->generateCardId();

    // Attempt to insert the new card into the database
    if ($model->insert([
        'card_id' => $newCardId,
        'card_name' => $post['card_name'],
        'slug'  => url_title($post['card_name'], '-', true),
        'card_type'  => $post['card_type'],
        'image_url' => $post['image_url'], 
        'card_set' => $post['card_set'],
    ])) {
        // Insertion successful, redirect to success view
        return view('templates/header', ['title' => 'Add Card Information'])
            . view('pokemon/success')
            . view('templates/footer');
    } else {
        // Insertion failed, log the error
        log_message('error', 'Database insert error: ' . print_r($model->errors(), true));


        // Redirect back to the form with input and errors
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
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