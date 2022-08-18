<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\LettersRepository;
use App\Repositories\SubLettersRepository;
use App\Repositories\WordsRepository;
use MElaraby\Emerald\HttpFoundation\Response;

class API extends Controller
{

    public function __construct(private LettersRepository    $lettersRepository,
                                private SubLettersRepository $subLettersRepository,
                                private WordsRepository      $wordsRepository)
    {

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
     * @param string|null $letter
     * @return Response
     */
    public function getWords(?int $letter = null): Response
    {
        return new Response(
            data: $this->wordsRepository->getWords($letter),
            message: 'success',
        );
    }
}
