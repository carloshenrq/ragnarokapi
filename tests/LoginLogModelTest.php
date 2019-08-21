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

class LoginLogModelTest extends PHPUnit\Framework\TestCase
{
    use TDatabaseSetup;

    /**
     * Test the relation between loginlog and login
     */
    public function testLoginRelation()
    {
        // creates a fake register to simulate the test
        $loginLog = Model\LoginLog::create([
            'time' => new DateTime(),
            'ip' => '127.0.0.1',
            'user' => 's1',
            'rcode' => 0,
            'log' => 'Unit test'
        ])->refresh();

        $this->assertNotNull($loginLog);
        $this->assertInstanceOf('Model\LoginLog', $loginLog);
        $this->assertEquals('127.0.0.1', $loginLog->ip);
        $this->assertEquals('s1', $loginLog->user);
        $this->assertEquals(0, $loginLog->rcode);
        $this->assertEquals('Unit test', $loginLog->log);

        $login = $loginLog->login;

        $this->assertNotNull($login);
        $this->assertInstanceOf('Model\Login', $login);
        $this->assertEquals('s1', $login->userid);

        Model\LoginLog::all()->each(function($log) {
            $log->delete();
        });
    }
}