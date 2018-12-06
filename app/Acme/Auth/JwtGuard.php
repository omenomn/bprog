<?php

namespace App\Acme\Auth;

use Illuminate\Auth\TokenGuard;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Storage;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Keychain; 
use Cookie;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Auth\GuardHelpers;

class JwtGuard implements Guard
{
    use GuardHelpers;

    public function login(AuthenticatableContract $user, $remember = false)
    {
        $disk = Storage::disk('openssl_key_pair');
        $signer = new Sha256();

        $privateKey = new Key($disk->get('private.key'));

        $token = (new Builder())
            ->setIssuer("user:{$user->id}")
            ->setIssuedAt(time())
            ->setExpiration(time() + 3600)           
            ->set('id', $user->id)
            ->set('name', $user->name)
            ->sign($signer, $privateKey)
            ->getToken();

        $this->setUser($user);

        return (string) $token;
    }

    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (!is_null($this->user)) {
            return $this->user;
        }

        $authorization = request()->header('Authorization');
        $token = null;

        if (preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
            $token = $matches[1];
        }

        try {
            $token = (new Parser())->parse($token);
        } catch (\Exception $e) {
            $token = null;
        }

        if (!$token)
            return null;

        $signer = new Sha256();
        $keychain = new Keychain();
        $disk = Storage::disk('openssl_key_pair');
        $pubKeyUrl = 'file://' . storage_path('openssl_key_pair/public.key');
        $pubKey = $keychain->getPublicKey($pubKeyUrl);

        $verified = $token->verify($signer, $keychain->getPublicKey($pubKeyUrl));

        $exp = $token->getClaim('exp');
        $now = Carbon::now()->timestamp;

        if ($now > $exp)
            return null;

        $id = $token->getClaim('id');
        $user = User::find($id);

        return $user;
    }  

    protected function hasValidCredentials($user, $credentials)
    {
        return ! is_null($user) && $this->provider->validateCredentials($user, $credentials) && $user->confirmed;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        if (empty($credentials[$this->inputKey])) {
            return false;
        }

        $credentials = [$this->storageKey => $credentials[$this->inputKey]];

        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }

        return false;
    }
}