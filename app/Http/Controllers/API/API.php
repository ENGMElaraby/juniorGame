<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\LettersRepository;
use App\Repositories\QuestionsRepository;
use App\Repositories\SubLettersRepository;
use App\Repositories\WordsRepository;
use MElaraby\Emerald\HttpFoundation\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class API extends Controller
{

    public function __construct(private LettersRepository    $lettersRepository,
                                private SubLettersRepository $subLettersRepository,
                                private WordsRepository      $wordsRepository,
                                private QuestionsRepository  $questionsRepository)
    {

    }

    /**
     * @param string|null $letter
     * @return Response
     */
    public function getSubLetters(?string $letter = null): Response
    {
        return new Response(
            data: $this->subLettersRepository->getLetters($letter),
            message: 'success',
        );
    }

    /**
     * @return Response
     */
    public function getLetters(): Response
    {
        return new Response(
            data: $this->lettersRepository->getLetters(),
            message: 'success',
        );
    }

    /**
     * @param int|null $letter
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getQuestions(?int $letter = null): Response
    {
        return new Response(
            data: $this->questionsRepository->getQuestions($letter),
            message: 'success',
        );
    }

    /**
     * @param int|null $letter
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getWords(?int $letter = null): Response
    {
        return new Response(
            data: $this->wordsRepository->getWords($letter),
            message: 'success',
        );
    }

}
