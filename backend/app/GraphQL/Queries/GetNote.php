<?php declare(strict_types=1);

namespace App\GraphQL\Queries;
use App\Models\Note;

final readonly class GetNote
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $noteId = $args['id'];
        $note = Note::findOrFail($noteId);

        return $note;
    }
}
