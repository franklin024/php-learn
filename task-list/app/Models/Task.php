<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "long_description",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}
