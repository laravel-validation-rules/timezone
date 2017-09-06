<?php

/*
 * This file is part of https://github.com/laravel-validation-rules/timezone
 *
 *  (c) Scott Wilcox <scott@dor.ky>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 */

namespace Tests;

use App\Rules\Timezone;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use PHPUnit\Framework\TestCase;
use Illuminate\Validation\Factory as Validator;

final class TimezoneTest extends TestCase
{
    public function buildValidator($timezone)
    {
        $app = new Container();
        $app->singleton('app', 'Illuminate\Container\Container');
        $translator     = new Translator(new FileLoader(new Filesystem(), null), 'en');
        $validator      = (new Validator($translator))->make([ 'timezone' => $timezone ], [
            'timezone'  => [ 'required', new Timezone ],
        ]);

        return $validator;
    }

    /**
     * @test
     */
    public function testValidTimezonePasses()
    {
        $validator = $this->buildValidator("Europe/London");
        $this->assertTrue($validator->passes());
    }



    /**
     * @test
     */
    public function testInvalidTimezoneFails()
    {
        $validator = $this->buildValidator("Bob/Dole");
        $this->assertTrue($validator->fails());
    }
}
