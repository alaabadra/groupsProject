
<?php
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public function boot()
{
    Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
}
}