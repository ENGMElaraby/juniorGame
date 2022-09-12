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
     * @param string|null $letterId
     * @return Response
     */
    public function getSubLetters(?string $letterId = null): Response
    {
        return new Response(
            data: $this->subLettersRepository->getLetters($letterId),
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
     * @param int|null $letterId
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getQuestions(?int $letterId = null): Response
    {
        return new Response(
            data: $this->questionsRepository->getQuestions($letterId),
            message: 'success',
        );
    }

    /**
     * @param int|null $letterId
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getWords(?int $letterId = null): Response
    {
        return new Response(
            data: $this->wordsRepository->getWords($letterId),
            message: 'success',
        );
    }

}
