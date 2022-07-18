<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class CustomApiAuthProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        $query = $this->createModel()->newQuery();
        $query = $query->where([
            ['email', $credentials['email']],
            ['role_id', $credentials['role_id']]
        ]);
        return $query->first();
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param Authenticatable $authenticatable
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $authenticatable, array $credentials)
    {
        return $authenticatable;
    }
}
