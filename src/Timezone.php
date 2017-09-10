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

namespace LVR\Timezone;

use DateTimeZone;
use Illuminate\Contracts\Validation\Rule;

class Timezone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, DateTimeZone::listIdentifiers());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The timezone does not exist.';
    }
}
