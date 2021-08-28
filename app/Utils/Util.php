<?php
namespace App\Utils;


class Util
{
    const REGEX_CPF_CNPJ = "/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/";
    const REGEX_PHONE = "/([1-9]{2})(?:[2-8]|9[1-9])[0-9]{3}[0-9]{4}$/";
    const REGEX_DATE = "/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/";
    const REGEX_CEP = "/^[0-9]{5}-[0-9]{3}$/";
}
