<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Note;

final readonly class DeleteNote
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $id = $args['id'];
        $note = Note::findOrFail($id);
        if($note) {
            $note->delete();
        } 
    }
}
