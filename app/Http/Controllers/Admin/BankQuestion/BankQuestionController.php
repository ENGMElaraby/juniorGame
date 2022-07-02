<?php

namespace App\Http\Controllers\Admin\BankQuestion;

use App\Http\Requests\Admin\BankQuestion\StoreRequest;
use App\Http\Requests\Admin\BankQuestion\UpdateRequest;
use App\Models\Settings;
use App\Repositories\BankQuestionRepository;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;
use MElaraby\Emerald\HttpFoundation\Response;

class BankQuestionController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $updateRequest = UpdateRequest::class;
    protected ?string $route = 'admin.bank.question.';
    protected ?string $view = 'admin.modules.bank.';

    /**
     * BankQuestionController constructor.
     * @param BankQuestionRepository $repository
     */
    #[Pure]
    public function __construct(BankQuestionRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return string
     */
    public function storeView(): string
    {
        if (request()->has('sentence')) {
            return $this->view . 'store_sentence';
        }
        return $this->view . 'store';
    }

    /**
     * @return string
     */
    public function storeRedirect(): string
    {
        return url()->previous();
    }

    /**
     * @return string
     */
    public function updateRedirect(): string
    {
        return url()->previous();
    }

    /**
     * @return string
     */
    public function deleteRedirect(): string
    {
        return url()->previous();
    }

    /**
     * @return Response
     */
    public function settingsIndex(): Response
    {
        return new Response(
            data: Settings::all(),
            view: $this->view . 'settings'
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function settingsUpdate(Request $request): Response
    {
        foreach ($request->except('_token') as $key => $value) {
            if ($setting = Settings::where('key', $key)->first()) {
                $setting->update(['value' => $value]);
                continue;
            }
            Settings::create([
                'key' => $key,
                'value' => $value
            ]);
        }
        return new Response(
            redirect: route('admin.bank.settings.index'),
            alert: $this->updateAlert('success', 'تم التعديل')
        );
    }
}
