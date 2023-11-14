<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Note;

final readonly class CreateNote
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $note = new Note();
        $note->title = $args['title'];
        $note->text = $args['text'];
        $note->author = intval($args['author']);
        $note->save(); // true
    }
}
