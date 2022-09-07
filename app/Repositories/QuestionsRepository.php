<?php

namespace App\Repositories;

use App\Models\QuestionAnswer;
use App\Models\Questions;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Helpers\FilesHelper;
use MElaraby\Emerald\Repositories\RepositoryCrud;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class QuestionsRepository extends RepositoryCrud
{
    use FilesHelper;

    /**
     * QuestionsRepository constructor.
     * @param Questions $model
     */
    #[Pure]
    public function __construct(Questions $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $data['image'] = $this->fileUpload($data['image'], 'words');
        if (isset($data['voice']) && !is_null($data['voice'])) {
            $data['voice'] = $this->fileUpload($data['voice'], 'voices');
        }
        $model = $this->model::create($data);
        if (isset($data['answers'])) {
            foreach ($data['answers'] as $answer) {
                $this->createQuestion($answer, $model);
            }
        }

        return $model;
    }

    /**
     * @param mixed $answer
     * @param mixed $model
     * @return mixed
     */
    private function createQuestion(mixed $answer, mixed $model): mixed
    {
        $correct = 0;
        if (isset($answer['correct'])) {
            $correct = 1;
        }
        QuestionAnswer::create([
            'question_id' => $model->id,
            'title' => $answer['title'] ?? null,
            'image' => $this->fileUpload($answer['image'], 'words'),
            'voice' => isset($answer['voice']) ? $this->fileUpload($answer['voice'], 'voices') : null,
            'correct' => $correct,
        ]);
        return $answer;
    }

    /**
     * @param array $data
     * @param int|Model $id
     */
    public function update(array $data, $id): mixed
    {
        if (isset($data['image']) && !is_null($data['image'])) {
            $data['image'] = $this->fileUpload($data['image'], 'words');
        }

        if (isset($data['image']) && is_null($data['image'])) {
            unset($data['image']);
        }

        if (isset($data['voice']) && !is_null($data['voice'])) {
            $data['voice'] = $this->fileUpload($data['voice'], 'words');
        }

        if (isset($data['voice']) && is_null($data['voice'])) {
            unset($data['voice']);
        }
        $model = parent::update($data, $id);
        if (isset($data['answers'])) {
            foreach ($data['answers'] as $answer) {
                if (isset($answer['id']) && !is_null($answer['id'])) {
                    $theAnswer = QuestionAnswer::find($answer['id']);
                    $correct = $theAnswer->correct;
                    if (isset($answer['correct'])) {
                        $correct = 1;
                    }
                    $theAnswer->update([
                        'title' => $answer['title'] ?? null,
                        'image' => (isset($answer['image']) && !is_null($answer['image'])) ? $this->fileUpload($answer['image'], 'images') : $theAnswer->image,
                        'voice' => (isset($answer['voice']) && !is_null($answer['voice'])) ? $this->fileUpload($answer['voice'], 'voices') : $theAnswer->voice,
                        'correct' => $correct,
                    ]);
                    continue;
                }
                $this->createQuestion($answer, $model);
            }
        }
        return $model;
    }

    /**
     * @param int|null $letter
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getQuestionss(?int $letter = null): mixed
    {
        if ($letter) {
            $this->where('letter_id', $letter);
        }
        return $this->index();
    }

    /**
     * @param bool $pagination
     * @param int $perPage
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(bool $pagination = false, int $perPage = 6): mixed
    {
        $this->newQuery()->eagerLoad()->setClauses();

        $model = $this->query;

        if ($pagination) {
            return $model->paginate($perPage);
        }
        if (request()->has('letter_id')) {
            $model->where('letter_id', request()->get('letter_id'));
        }
        return $model->get(['*']);
    }

    /**
     * @param int|null $letter
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getQuestions(?int $letter = null): mixed
    {
        if ($letter) {
            $this->where('letter_id', $letter);
        }
        return $this->with('answers')->index();
    }
}
