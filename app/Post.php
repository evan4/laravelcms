<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'image',
    'published_at', 'category_id'];

    protected $dates = ['published_at', 'deleted_at'];

    public function getImageUrlAttribute($value)
    {
        $image_url = '';;

        if(! is_null($this->image) )
        {
            if(Storage::exists('/public//img/'. $this->image)){
                $image_path ='img/'. $this->image;

                $image_url = Storage::disk('local')->url($image_path);
            }
        }
        return $image_url;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $image_thumb_url = '';;

        if(! is_null($this->image) )
        {
            if(Storage::exists('/public//img/'. $this->image)){
                $extension = explode('.', $this->image);
                $image_path ='img/'. $extension[0].'_thumb.'.end($extension);

                $image_thumb_url = Storage::disk('local')->url($image_path);
            }
        }
        return $image_thumb_url;
    }

    public function setPublishedAttribute($value)
    {
        $this->atributes['published_at'] = $value ?: NULL;
    }

    public function getDateAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHtml(e($this->body)) : null;
    }

    public function getExcerptHtmlAttribute($value)
    {
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : null;
    }

    public function dateFormatted($showTimes = false)
    {
        $format = 'd/m/Y';
        if($showTimes){
            $format = $format.'H:i:s';
        }
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if(! $this->published_at){
            return '<span class="label label-warning">Draft</span>';
        }elseif($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Schedule</span>';
        }else{
            return '<span class="label label-success">Published</span>';
        }
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now() );
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc' );
    }

    public function scopeScheduled($query)
    {
        return $query->where('published_at', '>', Carbon::now() );
    }

    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeFilter($query, $term)
    {
        if($term){
            $query->where(function($q) use ($term) {
               /*  $q->whereHas('author', function($qr) use ($term) {
                    $qr->where('name', 'LIKE', "%{$term}%");
                });
                $q->orWhereHas('category', function($qr) use ($term) {
                    $qr->where('title', 'LIKE', "%{$term}%");
                }); */
                $q->orWhere('title', 'LIKE', "%{$term}%");
                $q->orWhere('excerpt', 'LIKE', "%{$term}%");
            });
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
