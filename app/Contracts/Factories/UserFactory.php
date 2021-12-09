<?php
namespace App\Contracts\Factories;

use Illuminate\Http\Request;
use App\Entities\User;

interface UserFactory
{
    public function makeFromRequest(Request $request);

    public function makeFromAttributes(array $attributes);
}
