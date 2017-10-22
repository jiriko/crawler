<?php

namespace App;

use App\Events\RegisteredFromLandingPage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    /**
     * Register from the landing page
     * when a user adds a website
     *
     * @param $email
     * @param $url
     * @param $query
     *
     */
    public static function registerFromLandingPage($request)
    {
        $password = str_random(10);
        $user = self::create([
            'email' => $request['email'],
            'password' => $password
        ]);

        $user->registerWebsite($request['url'], $request['query']);

        event(new RegisteredFromLandingPage($user, $password));
    }

    public function registerWebsite($url, $query)
    {
        return $this->websites()->create([
            'url' => $url,
            'query' => $query
        ]);
    }
}
