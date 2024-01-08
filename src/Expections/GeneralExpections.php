<?php

namespace Tugayilhan\Pterodactyl\Exceptions;

class GeneralExpections extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}