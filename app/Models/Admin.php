<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 14:23
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

/**
 * Class Admin
 * @package App\Models
 * @property $username
 * @property $email
 * @property $password
 * @property $fullname
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 */
class Admin extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    /**
     * @var string
     */
    protected $table = 'admins';

    /**
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'fullname',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    public function create()
    {

    }

    public function createSuperAdmin()
    {
        $this->username = 'muzaffardjan';
        $this->email = 'muzaffardjan@karaev.uz';
        $this->password = Hash::make('password', ['cost' => 12]);
        $this->fullname = 'Muzaffardjan Karaev';
        $this->created_at = time();
        $this->updated_at = time();

        parent::save();
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
