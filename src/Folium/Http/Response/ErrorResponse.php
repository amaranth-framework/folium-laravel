<?php

use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends Response
{
    public function __construct(
        $content = '', 
        int $status = Response::HTTP_INTERNAL_SERVER_ERROR, 
        array $headers = array()
    ) {
        $this->headers = new ResponseHeaderBag($headers);
        $this->setContent(json_encode({
            'error' => $content
        }));
        $this->setStatusCode($status);
        $this->setProtocolVersion('1.0');
    }
}