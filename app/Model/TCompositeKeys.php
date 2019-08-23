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

use \Illuminate\Database\Eloquent\Builder;

trait TCompositeKeys
{
    /**
     * Illuminate\Database\Eloquent\Model::getIncrementing()
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * @see Illuminate\Database\Eloquent\Model::setKeysForSaveQuery()
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys))
            return parent::setKeysForSaveQuery($query);

        foreach ($keys as $keyName)
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));

        return $query;
    }

    /**
     * @see Illuminate\Database\Eloquent\Model::getKeyForSaveQuery()
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName))
            $keyName = $this->getKeyName();

        if (isset($this->original[$keyName]))
            return $this->original[$keyName];

        return $this->getAttribute($keyName);
    }

    /**
     * @see Illuminate\Database\Eloquent\Model::find()
     */
    public static function find($ids, $columns = ['*'])
    {
        $me = new self;
        $query = $me->newQuery();
        foreach ($me->getKeyName() as $key)
            $query->where($key, '=', $ids[$key]);

        return $query->first($columns);
    }
}
