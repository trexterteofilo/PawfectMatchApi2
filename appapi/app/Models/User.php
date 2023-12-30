<?php
namespace App\Models;

use App\Notifications\MessageSent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
use App\Models\Pet;
use App\Models\Adoption;
use App\Models\Subscribers;
use App\Models\Chat;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = "users";
    protected $guarded = ['userID'];

    const USER_TOKEN = "userToken";
    protected $fillable = [
        'firstname',
        'lastname',
        'bio',
        'address',
        'age',
        'gender',
        'email',
        'password',
        'image',
        'accounttype',
        'role',
        'accountstatus',
        'device_id',
        'birthdate'


    ];
    protected $primaryKey = 'userID';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function pet()
    {
        return $this->hasMany(Pet::class, 'owner_id', 'userID');
    }
    public function adoption()
    {
        return $this->hasMany(Adoption::class, 'owner_id', 'adoptID');
    }
    public function petshooter()
    {
        return $this->hasMany(User::class, 'petshooter_id', 'id');
    }
    public function subscribers()
    {
        return $this->hasMany(Subscribers::class, 'id', 'user_id');
    }
    // public function petshooterApplication()
    // {
    //     return $this->hasMany(Petshooterapplication::class, 'petshooterAppID', 'user_id');
    // }

    // public static function getUsers($search_keyword)
    // {
    //     $users = DB::table('users');

    //     if ($search_keyword && !empty($search_keyword)) {
    //         $users->where(function ($q) use ($search_keyword) {
    //             $q->where('firstname', 'LIKE', '%' . $search_keyword . '%');
    //         });
    //     }
    //     return $users->paginate(10);

    // }



    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'created_by');
    }

    public function routeNotificationForOneSignal(): array
    {
        return ['tags' => ['key' => 'userId', 'relation' => '=', 'value' => (string) ($this->id)]];
    }

    public function sendNewMessageNotification(array $data): void
    {
        $this->notify(new MessageSent($data));
    }

}