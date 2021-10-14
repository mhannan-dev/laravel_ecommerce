<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CmsPage extends Model
{
    use HasFactory;
    public function setTitleAttribute($value)
	{
		$this->attributes['title'] = $value;
		$this->attributes['slug'] = Str::slug($value);
	}
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'meta_title',
        'description',
        'meta_description',
        'status'
    ];
}
