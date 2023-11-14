<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Note;

final readonly class UpdateNote
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $id = $args['id'];
        $updatedTitle = $args['title'];
        $updatedText = $args['text'];

        $note = Note::findOrFail($id);
        $note->title = $updatedTitle;
        $note->text = $updatedText;
        $note->save();
    }
}
