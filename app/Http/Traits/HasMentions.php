<?php

namespace App\Http\Traits;

use App\Models\User;
trait HasMentions
{
    public function mentionedUsers()
    {
        return $this->morphToMany(User::class, 'mentionable');
    }

    public function parseMentions()
    {
        preg_match_all("/@([\w\.]+)/", $this->content, $matches);
        $mentions = [];

        foreach (array_unique($matches[1]) as $mention) {
            $user = User::whereUsername($mention)->first();

            if ($user) {
                array_push($mentions, $user->id);
            }
        }

        $this->mentionedUsers()->sync($mentions);
    }
}