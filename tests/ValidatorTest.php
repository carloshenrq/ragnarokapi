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

class ValidatorTest extends PHPUnit\Framework\TestCase
{
    /*********
     * checkDate
     *********/
    public function testCheckDateInvalid()
    {
        $this->assertFalse(Validator::checkDate('2001-02-29'));
        $this->assertFalse(Validator::checkDate('1822-02-30'));
        $this->assertFalse(Validator::checkDate('2019-08-32'));
    }

    public function testCheckDateValid()
    {
        $this->assertTrue(Validator::checkDate('2000-01-01'));
        $this->assertTrue(Validator::checkDate('1822-09-07'));
        $this->assertTrue(Validator::checkDate('2019-08-20'));
    }

    /*********
     * checkMail
     *********/
    public function testCheckMailInvalid()
    {
        $this->assertFalse(Validator::checkMail(''));
        $this->assertFalse(Validator::checkMail('test@'));
        $this->assertFalse(Validator::checkMail('test@gmail'));
        $this->assertFalse(Validator::checkMail('a@a.com'));
    }

    public function testCheckMailValid()
    {
        $this->assertTrue(Validator::checkMail('test@gmail.com'));
    }

    public function setUp()
    {
        RagnarokApiAutoload::register();
    }
}
