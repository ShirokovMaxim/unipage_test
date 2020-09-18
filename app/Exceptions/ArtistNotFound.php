<?php


namespace App\Exceptions;


use Exception;

class ArtistNotFound extends Exception
{
    public $errorCode;
    public $data;

    public function __construct($message = null, $errorCode = null, $data = null)
    {
        parent::__construct($message);

        if (!is_null($errorCode)) {
            $this->errorCode = $errorCode;
        }

        $this->data = $data;
    }
}
