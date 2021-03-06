<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['published_at'];
    protected $fillable = ['title','slug','resume','body','category_id','published_at','image','view_count'];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);

    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = "";
        if(!is_null($this->image)){
            $directory = config('cms.image.directory');
            $imagePath = public_path() . "/{$directory}/" . $this->image;
            if(file_exists($imagePath)) $imageUrl = asset("img/". $this->image);
        }
        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageUrl = "";

        if(!is_null($this->image))
        {
            $directory = config('cms.image.directory');
            $extensao = substr(strrchr($this->image, '.'),1);
            $thumbnail = str_replace(".{$extensao}","_thumb.{$extensao}",$this->image);
            $imagePath = public_path() . "/{$directory}/" . $thumbnail;
            if(file_exists($imagePath)) $imageUrl = asset("{$directory}/". $thumbnail);
        }
        return $imageUrl;
    }

    public function getDateAttribute($value){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();

    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopePublished($query){
        return $query->where("published_at", "<=", Carbon::now());

    }

    public function dateFormated($showTimes = false){
        $format = "d/m/Y";
        if($showTimes) $format = $format . " H:i";
        return $this->created_at->format($format);
    }

    public function publicationLabel(){
        if( !$this->published_at){
            return '<span class="label label-warning">Esboço</span>';
        }
        elseif ($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Agendado</span>';
        }else{
            return '<span class="label label-success">Publicado</span>';
        }
    }

    public function setPublishedAtAttribute($value){
        $this->attributes['published_at'] = $value ?: NULL;
    }

    public function scopeSchedule($query){
        return $query->where("published_at",">", Carbon::now());
    }

    public function scopeDraft($query){
        return $query->whereNull("published_at");
    }

    public function scopeFilter($query,$pesquisa){
        if($pesquisa)
        {
            $query->where(function ($q)use($pesquisa){
                 $q->whereHas('author', function($qr) use ($pesquisa) {
                     $qr->where('name', 'LIKE', "%{$pesquisa}%");
                 });
                 $q->orWhereHas('category', function($qr) use ($pesquisa) {
                     $qr->where('title', 'LIKE', "%{$pesquisa}%");
                 });
                $q->orWhere('title','LIKE', "%{$pesquisa}%");
                $q->orWhere('resume','LIKE', "%{$pesquisa}%");
            });
        }
    }

    public function getTagsHtmlAttribute()
    {
          $anchor = [];
        foreach($this->tags as $tag){
            $anchor[] = '<a href="'.route('blog.tag',$tag->slug).'">'.$tag->name.'</a>';
        }
        return implode(", ", $anchor);
        
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
