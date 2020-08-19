<?php

namespace CalendlyApi\Auth;


/**
 * Class XTokenAuth
 * @package CalendlyApi\Auth
 */
class XTokenAuth implements AuthInterface
{
    private $token;

    public function __construct(string $token)
    {
        $this->setToken($token);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    private function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-TOKEN' => $this->getToken(),
        ];
    }
}