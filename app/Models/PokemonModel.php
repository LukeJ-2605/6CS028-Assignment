<?php

namespace App\Models;

use CodeIgniter\Model;

class PokemonModel extends Model
{
    protected $table = 'pokemon';
	
	protected $primaryKey = 'card_id';
	protected $useAutoIncrement = false;
	
	protected $allowedFields = ['card_name', 'slug', 'card_type', 'card_set', 'image_url'];

	public function getPokemon($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
	public function generateCardId()
    {
        do {
            $randomId = 'PKM-' . rand(10000, 99999); // Example: PKM-12345
            $exists = $this->where('card_id', $randomId)->first(); // Check if ID exists
        } while ($exists);

        return $randomId;
    }
	public function searchPokemon($keyword)
	{
    return $this->like('card_name', $keyword)
                ->orLike('card_type', $keyword)
                ->findAll();
	}
	public function getSuggestions($query)
	{
    if (!$query) {
        return [];
    }

    return $this->where('card_name LIKE', "%$query%")
                ->findAll();
	}


}