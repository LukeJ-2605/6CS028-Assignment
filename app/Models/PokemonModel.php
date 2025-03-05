<?php
namespace App\Models;

use CodeIgniter\Model;

class PokemonModel extends Model
{
    protected $table = 'pokemon';
    protected $primaryKey = 'id';
    protected $allowedFields = ['card_id', 'card_name', 'slug', 'image_url', 'card_type', 'card_set'];
	
	public function getCardBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}
?>