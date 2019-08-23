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

class LoginRegNumModelTest extends PHPUnit\Framework\TestCase
{
    use TDatabaseSetup;

    public function testLoginRegNum()
    {
        // Cria uma entrada no banco de dados
        Model\LoginRegNum::create([
            'account_id' => 1,
            'key' => '#RAGNAROKAPI',
            'index' => 0,
            'value' => 1000
        ]);

        $regNum = Model\LoginRegNum::first();

        $this->assertNotNull($regNum);
        $this->assertInstanceOf('Model\LoginRegNum', $regNum);
        $this->assertEquals(1, $regNum->account_id);
        $this->assertEquals('#RAGNAROKAPI', $regNum->key);
        $this->assertEquals(0, $regNum->index);
        $this->assertEquals(1000, $regNum->value);

        $login = $regNum->login;

        $this->assertNotNull($login);
        $this->assertInstanceOf('Model\Login', $login);

        // Most important fields at database
        $this->assertEquals(1, $login->account_id);
        $this->assertEquals('s1', $login->userid);
        $this->assertEquals('S', $login->sex);
        $this->assertEquals('athena@athena.com', $login->email);

        $regNum = null;
        $regNums = $login->regNumVars;
        $regNum = $regNums->first();

        $this->assertEquals(1, $regNums->count());
        $this->assertNotNull($regNum);
        $this->assertInstanceOf('Model\LoginRegNum', $regNum);
        $this->assertEquals(1, $regNum->account_id);
        $this->assertEquals('#RAGNAROKAPI', $regNum->key);
        $this->assertEquals(0, $regNum->index);
        $this->assertEquals(1000, $regNum->value);

        $regNum->value = 2000;
        $regNum->save();
        $regNum = null;

        $regNum = Model\LoginRegNum::first();

        $this->assertNotNull($regNum);
        $this->assertInstanceOf('Model\LoginRegNum', $regNum);
        $this->assertEquals(1, $regNum->account_id);
        $this->assertEquals('#RAGNAROKAPI', $regNum->key);
        $this->assertEquals(0, $regNum->index);
        $this->assertEquals(2000, $regNum->value);

        $regNum->delete();
    }
}
