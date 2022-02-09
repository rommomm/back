<?php

namespace App\Http\Traits;

use App\Models\User;

trait HasMentions
{
    public function mentioned()
    {
        return $this->morphToMany(User::class, 'mentionable');
    }

    public function parsed()
    {
        $mentionUsers = [];
        preg_match_all("/\B@(\w+)/", $this->content, $mentionedUsers);

        foreach (array_unique($mentionedUsers[1]) as $mentionedUser) {
            $user = User::whereUsername($mentionedUser)->first();

            if ($user) {
                array_push($mentionUsers, $user->id);
            }
        }

        $this->mentioned()->sync($mentionUsers);
    }
}