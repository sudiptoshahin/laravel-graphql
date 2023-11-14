<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Note;

final readonly class LatestNote
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver

        //  complex queries
        return Note::all()->last();
    }
}
