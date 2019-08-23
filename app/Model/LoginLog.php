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

class LoginLog extends \Illuminate\Database\Eloquent\Model
{
    use \Model\TCompositeKeys;

    /**
     * The user login that log belongs.
     * 
     * @return Model\Login
     */
    public function login()
    {
        return $this->belongsTo('Model\Login', 'user', 'userid');
    }

    /**
     * @see Illuminate\Database\Eloquent\Model::$casts
     */
    protected $dates = [
        'time'
    ];

    /**
     * @see Illuminate\Database\Eloquent\Model::$casts
     */
    protected $casts = [
        'rcode' => 'integer'
    ];

    /**
     * Illuminate\Database\Eloquent\Model::$timestamps
     */
    public $timestamps = false;

    /**
     * @see Illuminate\Database\Eloquent\Model::$primaryKey
     */
    protected $primaryKey = 'user';

    /**
     * @see Illuminate\Database\Eloquent\Model::$incrementing
     */
    public $incrementing = false;

    /**
     * @see Illuminate\Database\Eloquent\Model::$table
     */
    protected $table = 'loginlog';

    /**
     * @see Illuminate\Database\Eloquent\Model::$connection
     */
    protected $connection = 'logs';

    /**
     * @see Illuminate\Database\Eloquent\Model::$fillable
     */
    protected $fillable = [
        'time', 'ip', 'user', 'rcode', 'log'
    ];
}
