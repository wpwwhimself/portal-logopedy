<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Notifications\NewsletterSubscribedNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NewsletterController extends Controller
{
    public function form(string $mode = "subscribe"): View
    {
        return view("pages.newsletter.form", compact("mode"));
    }

    public function subscribe(Request $rq): RedirectResponse
    {
        $subscriber = NewsletterSubscriber::where("email", $rq->email)->first();

        if ($subscriber) {
            return redirect()->route("main")->with("success", "Podany adres email jest już zapisany");
        }

        NewsletterSubscriber::create([
            "email" => $rq->email,
            "user_id" => Auth::id(),
        ]);

        Notification::route("mail", $rq->email)
            ->notify(new NewsletterSubscribedNotification());

        return redirect()->route("main")->with("success", "Pomyślnie zapisano do newslettera");
    }

    public function unsubscribe(Request $rq): RedirectResponse
    {
        $subscriber = NewsletterSubscriber::where("email", $rq->email)->first();

        if (!$subscriber) {
            return redirect()->route("main")->with("error", "Nie ma takiego adresu w naszej bazie");
        }

        $subscriber->delete();

        return redirect()->route("main")->with("success", "Pomyślnie usunięto z newslettera");
    }
}
