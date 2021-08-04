<?php

namespace App\Rules;

use App\Models\Perfil;
use Illuminate\Contracts\Validation\Rule;

class PerfilExists implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value>0 && Perfil::find($value)!=null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'É necessário um perfil válido';
    }
}
