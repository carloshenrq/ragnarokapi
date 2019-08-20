<?php
/**
 *  RagnarokAPI, RESTful api for Hercules Emulator
 *  Copyright (C) 2019 carloshernq
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Model;

use \DateTime;

class Login extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Gets the information that says this account is banned.
     * 
     * @return boolean
     */
    public function getIsExpiredAttribute()
    {
        return $this->expiration_time != 0
                && $this->expiration_time >= time();
    }

    /**
     * Gets the information that says this account is banned.
     * 
     * @return boolean
     */
    public function getIsBannedAttribute()
    {
        return $this->unban_time != 0
                && $this->unban_time >= time();
    }

    /**
     * Gets the expiration date for account. This convers the expiration_time to DateTime object
     * 
     * @return DateTime
     */
    public function getExpirationDateAttribute()
    {
        if ($this->expiration_time === 0)
            return null;

        return DateTime::createFromFormat('U', $this->expiration_time);
    }

    /**
     * Gets the unban date for account. This converts the unban_time to DateTime object
     * 
     * @return DateTime
     */
    public function getUnBanDateAttribute()
    {
        if ($this->unban_time === 0)
            return null;

        return DateTime::createFromFormat('U', $this->unban_time);
    }

    /**
     * Illuminate\Database\Eloquent\Model::$timestamps
     */
    public $timestamps = false;

    /**
     * Illuminate\Database\Eloquent\Model::$appends
     */
    protected $appends = ['unBanDate', 'isBanned', 'expirationDate', 'isExpired'];

    /**
     * @see Illuminate\Database\Eloquent\Model::$dates
     */
    protected $dates = [
        'lastlogin',
        'birthdate',
    ];

    /**
     * @see Illuminate\Database\Eloquent\Model::$casts
     */
    protected $casts = [
        'group_id' => 'integer',
        'state' => 'integer',
        'unban_time' => 'integer',
        'expiration_time' => 'integer',
        'logincount' => 'integer',
        'character_slots' => 'integer',
        'pincode_change' => 'integer',
    ];

    /**
     * @see Illuminate\Database\Eloquent\Model::$primaryKey
     */
    protected $primaryKey = 'account_id';

    /**
     * @see Illuminate\Database\Eloquent\Model::$table
     */
    protected $table = 'login';

    /**
     * @see Illuminate\Database\Eloquent\Model::$connection
     */
    protected $connection = 'login';
}
