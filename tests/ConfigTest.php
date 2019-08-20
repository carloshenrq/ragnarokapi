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

require_once 'vendor/autoload.php';
require_once 'tests/TDatabaseSetup.php';

class ConfigTest extends PHPUnit\Framework\TestCase
{
    use TDatabaseSetup;

    /**
     * Tests the login server sql connection
     */
    public function testLoginSQLConnection()
    {
        $login = Illuminate\Database\Capsule\Manager::connection('login');
        $pdo = $login->getPdo();
        $this->assertInstanceOf('Doctrine\DBAL\Driver\PDOConnection', $pdo);
    }

    /**
     * Tests the login server sql connection
     */
    public function testCharSQLConnection()
    {
        $char = Illuminate\Database\Capsule\Manager::connection('char');
        $pdo = $char->getPdo();
        $this->assertInstanceOf('Doctrine\DBAL\Driver\PDOConnection', $pdo);
    }

    /**
     * Tests the login server sql connection
     */
    public function testMapSQLConnection()
    {
        $map = Illuminate\Database\Capsule\Manager::connection('map');
        $pdo = $map->getPdo();
        $this->assertInstanceOf('Doctrine\DBAL\Driver\PDOConnection', $pdo);
    }
}
