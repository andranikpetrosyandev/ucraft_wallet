<?php

namespace App\Services\Core\User;

class CreateUserParams
{


    private string $name;
    private string $email;
    private string $password;
    private string $googleId;
    private string $facebookId;

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $googleId
     * @param string $facebookId
     */
    public function __construct(string $name, string $email, string $password, string $googleId, string $facebookId)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->googleId = $googleId;
        $this->facebookId = $facebookId;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getGoogleId(): string
    {
        return $this->googleId;
    }
    /**
     * @return string
     */
    public function getFacebookId(): string
    {
        return $this->facebookId;
    }

}
