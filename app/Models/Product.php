<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['name', 'price', 'photo', 'sales_count', 'rating', 'user_id'];

    // Relasi dengan User (Toko)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}