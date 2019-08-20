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
  * Autoload class for api classes.
  */
final class RagnarokApiAutoload
{
    /**
     * Register the autoload method.
     * 
     * @return void
     */
    public static function register()
    {
        spl_autoload_register([
            'RagnarokApiAutoload',
            'loader'
        ], true, false);
    }

    /**
     * Loads the requested class if it's found.
     * 
     * @param string $className Class name
     * 
     * @return void
     */
    public static function loader($className)
    {
        $classFile = join(DIRECTORY_SEPARATOR, [
            __DIR__,
            $className . '.php'
        ]);
        $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $classFile);

        if(file_exists($classFile))
            require_once $classFile;
    }
}
