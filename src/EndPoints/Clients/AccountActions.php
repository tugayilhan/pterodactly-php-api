<?php

namespace Tugayilhan\Pterodactyl\EndPoints\Clients;
use Tugayilhan\Pterodactyl\EndPoints\Actions;
class AccountClientsActions extends Actions
{
        public function accountDetails()
        {
            return $this->requestJson('GET', '/api/client/account');
        }
        public function twoFactor()
        {
            return $this->requestJson('GET', '/api/client/account/two-factor');
        }

        public function twoFactorEnable()
        {
            return $this->requestJson('Post', '/api/client/account/two-factor');
        }

        public function twoFactorDisable()
        {
            return $this->requestJson('DELETE', '/api/client/account/two-factor');
        }
        public function updateEmail(string $email, string $password)
        {
            $data = [
                'email' => $email,
                'password' => $password
            ];

            return $this->requestJson('PUT', '/api/client/account/email', $data);
        }
        public function updatePassword(string $currentPassowrd, string $newPassword, string $confirmPassword)
        {

            $data = [
                'current_password' => $currentPassowrd,
                'password' => $newPassword,
                'password_confirmation' => $confirmPassword
            ];

            return $this->requestJson('PUT', '/api/client/account/password', $data);
        }

        public function apiKeys()
        {
            return $this->requestJson('GET', '/api/client/account/api-keys');
        }

        public function createApiKey(string $description, array $allowed_ips)
        {

            $data = [
                'description' => $description,
                'allowed_ips' => $allowed_ips
            ];

            return $this->requestJson('POST', '/api/client/account/api-keys', $data);
        }
        public function deleteApiKey(string $identifier)
        {
            return $this->requestJson('DELETE', '/api/client/account/api-keys/'.$identifier);
        }


}

