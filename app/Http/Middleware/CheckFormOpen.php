<?php

namespace App\Http\Middleware;

use App\Models\FormSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFormOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = FormSetting::first();

        $now = now();

        if ($settings &&
            ($settings->form_status === 'closed' ||
            ($settings->form_open_at && $settings->form_open_at > $now) ||
            ($settings->form_close_at && $settings->form_close_at < $now))) {
                $msg_type = 'close';
                return redirect(route('application.msg',['msg_type' => $msg_type]));
        }

        return $next($request);
    }


}
