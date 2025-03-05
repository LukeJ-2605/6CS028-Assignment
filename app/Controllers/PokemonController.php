<?php
namespace App\Controllers;

use App\Models\PokemonModel;
use CodeIgniter\Controller;

class PokemonController extends Controller
{
    public function index()
	{
    // Load the model
    $pokemonModel = new PokemonModel();

    // Define the API endpoint
    $url = 'https://api.pokemontcg.io/v2/cards'; // Pokémon TCG API endpoint

    // Use cURL to fetch data from the API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        log_message('error', 'cURL error: ' . curl_error($ch));
        return;
    }

    // Close cURL
    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Log the API response for debugging
    log_message('info', 'API Response: ' . print_r($data, true));

    // Check if the data is valid
    if (isset($data['data']) && is_array($data['data'])) {
        foreach ($data['data'] as $card) {
            // Prepare data for insertion
            $insertData = [
                'card_id' => $card['id'], // Ensure this key exists
                'card_name' => $card['name'],
                'slug' => strtolower(url_title($card['name'] . '-' . $card['id'])), // Create slug from name and ID
                'image_url' => $card['images']['small'] ?? null,
                'card_type' => isset($card['types']) ? implode(', ', $card['types']) : 'N/A',
                'card_set' => isset($card['set']['name']) ? $card['set']['name'] : 'N/A',
            ];

            // Log the insert data
            log_message('info', 'Insert Data: ' . print_r($insertData, true));

            // Insert or update logic here...
            $existingCard = $pokemonModel->where('card_id', $insertData['card_id'])->first();

            if ($existingCard) {
                // Optionally update the existing record
                $pokemonModel->update($existingCard['id'], $insertData);
                log_message('info', 'Updated card: ' . $card['name']);
            } else {
                // Insert into the database
                if (!$pokemonModel->insert($insertData)) {
                    log_message('error', 'Insert failed: ' . print_r($pokemonModel->errors(), true));
                } else {
                    log_message('info', 'Inserted card: ' . $card['name']);
                }
            }
        }
    } else {
        log_message('error', 'Invalid API response structure: ' . print_r($data, true));
    }

    // Pass the cards data to the view
    return view('pokemon/index', ['cards' => $data['data'] ?? []]);
	}
	 public function show($slug = null)
    {
        $model = new PokemonModel();

        // Fetch the card details using the slug
        $card = $model->where('slug', $slug)->first();

        // Check if the card exists
        if ($card === null) {
            throw new PageNotFoundException('Cannot find the Pokémon card: ' . $slug);
        }

        // Prepare data for the view
        $data['card'] = $card;
        $data['title'] = $card['card_name']; // Set the title based on the card name

        // Return the view with the header, card details, and footer
        return view('templates/header', $data)
            . view('pokemon/view') // This is the view for displaying the card details
            . view('templates/footer');
    }
}