<?php

namespace App\Modules\PollsAndQuizzes\Database\Seeds;

use App\EnvX\Database\AutoSeed;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use Illuminate\Support\Str;

class PollAndQuizSeeder extends AutoSeed
{
    public function run(): void
    {
        $this
            ->using(__DIR__ . '/../data/polls_and_quizzes.csv')
            ->updateOrCreate(PollAndQuiz::class, 'name')
            ->then(static function (PollAndQuiz $pollQuiz, array $rowData): void {
                $question = $pollQuiz->questions()->updateOrCreate(['title' => $rowData['question']]);

                collect($rowData)
                    ->filter(static function (string $value, string $key): bool {
                        return Str::contains($key, 'answer_');
                    })
                    ->each(static function (string $value, string $key) use ($question, $rowData): void {
                        $question->answers()->updateOrCreate([
                            'value' => $value
                        ], [
                            'correct' => (Str::afterLast($key, '_') === $rowData['correct_answer'])
                        ]);
                    });
            });
    }

}
