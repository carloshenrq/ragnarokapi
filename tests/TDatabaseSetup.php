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
 * This trait is for automate some tests that needs database connection.
 */
trait TDatabaseSetup
{
    public function setUp()
    {
        // Config file path
        $config = realpath(join(DIRECTORY_SEPARATOR, [
            __DIR__, '..', 'build', 'config.json'
        ]));

        // Fetches config data
        $text = file_get_contents($config);
        $this->config = json_decode($text);

        // Prepares database for connection
        $manager = new Illuminate\Database\Capsule\Manager();
        $manager->addConnection((array)$this->config->login->sql, 'login');
        $manager->addConnection((array)$this->config->char->sql, 'char');
        $manager->addConnection((array)$this->config->map->sql, 'map');
        $manager->setEventDispatcher(
            new Illuminate\Events\Dispatcher(
                new Illuminate\Container\Container()
            )
        );
        $manager->setAsGlobal();
        $manager->bootEloquent();

        RagnarokApiAutoload::register();
    }

    /**
     * The configuration file
     * @var object
     */
    public $config;
}
