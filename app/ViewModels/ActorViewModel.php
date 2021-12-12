<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;
    public function __construct($actor, $social, $credits)
    {
        $this->actor=$actor;
        $this->social=$social;
        $this->credits=$credits;
    }

    public function actor(){
        return collect($this->actor)
            ->merge([
                'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
                'age' => Carbon::parse($this->actor['birthday'])->age,
                'profile_path'=> ($this->actor['profile_path']) ? "https://image.tmdb.org/t/p/w500".$this->actor['profile_path']
                    : 'https://via.placeholder.com/300x450',

            ]);
    }
    public function social(){
        return collect($this->social)->merge([
            'twitter'=> $this->social['twitter_id']? 'https://twitter.com/'.$this->social['twitter_id']
                :null,
            'facebook'=> $this->social['facebook_id']? 'https://facebook.com/'.$this->social['facebook_id']
                :null,
            'instagram'=> $this->social['instagram_id']? 'https://instagram.com/'.$this->social['instagram_id']
                :null,
        ]);
    }
    public function knownForTitles(){
        $castTitles = collect($this->credits)->get('cast');


        return collect($castTitles)
            ->sortByDesc('popularity')->take(5)
            ->map(function ($movie){
                if(isset($movie['title'])){
                    $title = $movie['title'];
                } elseif (isset($movie['name'])){
                    $title=$movie['name'];
                } else {
                    $title='Untitled';
                }
                return collect($movie)->merge([
                    'poster_path'=> ($movie['poster_path']) ? "https://image.tmdb.org/t/p/w185".$movie['poster_path']
                        : 'https://via.placeholder.com/300x450',
                    'title'=> $title,
                    'linkToPage'=> $movie['media_type']=== 'movie' ? url('movies',$movie['id'])
                        : url('tv',$movie['id']),
                ]);
            });
    }

    public function credits(){
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)
            ->map(function ($movie){
                if(isset($movie['release_date'])){
                    $releaseDate = $movie['release_date'];
                } elseif (isset($movie['first_air_date'])){
                    $releaseDate=$movie['first_air_date'];
                } else {
                    $releaseDate='';
                }

                if(isset($movie['title'])){
                    $title = $movie['title'];
                }elseif (isset($movie['name'])){
                    $title=$movie['name'];
                }else{
                    $title='Untitled';
                }

                return collect($movie)->merge([
                    'release_date'=> $releaseDate,
                    'release_year'=>isset($releaseDate)?Carbon::parse($releaseDate)->format('Y'): 'Upcoming',
                    'title'=>$title,
                    'character'=>(isset($movie['character']) && $movie['character'] != "")?$movie['character']: "N/A",
                ]);
            })->sortByDesc('release_year');
    }
}
