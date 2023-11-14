<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Note;

final readonly class AllNotes
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $notes = Note::all();
        
        return $notes->sortBy('created_at')->reverse();
    }
}
