<?php

namespace App\Adapters\Http\Middleware;

use App\Business\Interfaces\Interactors\Front\MemberAuthentication\MemberAuthenticationCheckInputPort;
use App\Business\Interfaces\Interactors\Front\MemberAuthentication\MemberAuthenticationCheckInteractor;
use App\Business\Interfaces\Interactors\Front\MemberAuthentication\MemberAuthenticationCheckOutputPort;
use App\Domain\Model\MemberAuthentication;
use App\Utilities\Log;
use Closure;
use Illuminate\Http\Request;
use ReLab\Commons\Wrappers\Data;

/**
 * Class FrontAuthenticate
 *
 * @package App\Adapters\Http\Middleware
 */
class FrontAuthenticate
{
    /**
     * @var  MemberAuthenticationCheckInteractor
     */
    private $interactor;

    /**
     * FrontAuthenticate constructor.
     *
     * @param MemberAuthenticationCheckInteractor $interactor
     */
    public function __construct(MemberAuthenticationCheckInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   //ログ出力
        Log::infoIn();

        /** @var MemberAuthentication $memberAuthentication */
        $memberAuthentication = MemberAuthentication::loadSession();

        // セッションに会員認証が存在しない場合はログイン画面へリダイレクトする
        if (!isset($memberAuthentication)) {
            //ログ出力
            Log::infoOut();
            return redirect(route("front.member.login"));
        }

        // INPUT作成
        $inputPort = new class($memberAuthentication) extends Data implements MemberAuthenticationCheckInputPort
        {
        };

        // OUTPUT作成
        $outputPort = new class() extends Data implements MemberAuthenticationCheckOutputPort
        {
        };

        try {
            // 認証を確認する
            $this->interactor->check($inputPort, $outputPort);
            \View::share('memberAuthentication', $outputPort->memberAuthentication);
        } catch (\Exception $e) {
            // ログ出力
            Log::warning($e->getMessage(), ['business_exception' => $e]);

            // 例外が発生した場合はログアウトへリダイレクトする
            return redirect(route("front.member.logout"));
        }

        //ログ出力
        Log::infoOut();
        return $next($request);
    }
}
