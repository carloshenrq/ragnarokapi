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

class LoginModelTest extends PHPUnit\Framework\TestCase
{
    use TDatabaseSetup;

    /**
     * First test to find the server login at database
     */
    public function testFirstModel()
    {
        // Removes ban from database
        $this->setBanExpireDate(0, 0);

        // Find first login at database
        $login = Model\Login::first();

        // not null
        $this->assertNotNull($login);
        $this->assertInstanceOf('Model\Login', $login);

        // Most important fields at database
        $this->assertEquals(1, $login->account_id);
        $this->assertEquals('s1', $login->userid);
        $this->assertEquals('S', $login->sex);
        $this->assertEquals('athena@athena.com', $login->email);

        // This is can't be not null, won't work if not null
        $this->assertNull($login->unBanDate);
        $this->assertNull($login->expirationDate);
        $this->assertFalse($login->isBanned);
        $this->assertFalse($login->isExpired);
    }

    /**
     * Test unBanDate
     */
    public function testUnBanDate()
    {
        $this->setBanExpireDate(time() + 3600, 0);

        $login = Model\Login::first();

        $this->assertInstanceOf('DateTime', $login->unBanDate);
        $this->assertNull($login->expirationDate);
        $this->assertTrue($login->isBanned);
        $this->assertFalse($login->isExpired);
    }

    /**
     * Test expirationDate
     */
    public function testExpirationDate()
    {
        $this->setBanExpireDate(0, time() + 3600);

        $login = Model\Login::first();

        $this->assertNull($login->unBanDate);
        $this->assertInstanceOf('DateTime', $login->expirationDate);
        $this->assertFalse($login->isBanned);
        $this->assertTrue($login->isExpired);
    }

    /**
     * Defines properties for that account who should be tested.
     * 
     * @param int $unban
     * @param int $expiration
     */
    private function setBanExpireDate($unban, $expiration)
    {
        Model\Login::where([
            'account_id' => 1
        ])->update([
            'unban_time' => $unban,
            'expiration_time' => $expiration,
        ]);
    }
}
