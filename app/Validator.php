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

/**
 * Simple validation routines.
 */
class Validator
{
    /**
     * Verify if date passed is valid.
     * 
     * @param string $date To be checked.
     * 
     * @return boolean Should be 'true' if valid. Otherwise, false.
     */
    public static function checkDate($date)
    {
        if (!preg_match('/^([0-9]{4})\-(0[1-9]|1[0-2])\-(0[1-9]|[1-2][0-9]|3[0-1])/i', $date))
            return false;

        $dtTest = new DateTime($date);
        return ($dtTest->format('Y-m-d') === $date);
    }

    /**
     * Verify if passed email is valid.
     * 
     * @param string $email
     * 
     * @return boolean Should be 'true' if valid. Otherwise, false.
     */
    public static function checkMail($email)
    {
        if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            return false;

        $domain = substr($email, strpos($email, '@') + 1);
        return (@checkdnsrr($domain) === true);
    }
}
