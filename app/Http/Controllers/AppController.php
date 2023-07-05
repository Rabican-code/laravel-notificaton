<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class AppController extends Controller
{
    public function saveToken(Request $request)
    {
        $post = new Token();
        $post->token = $request->token;
        $post->save();
    }

    public function show()
    {
        $data['tokens']  = Token::all();
        $data['abc'] = "mystring";
        return Inertia::render('Dashboard', $data);
    }
    public function send(Request $request)
    {
        $site_id = $request->input('siteId');
        $site_id_data = Token::where('site_id', $site_id)->get();


        $auth = [
            'VAPID' => [
                'subject' => 'mailto:me@website.com', // can be a mailto: or your website address
                'publicKey' => 'BBZY7Q3KEtZArAAWMLi_qzWHbH4vAoqPpIXnRhmlUaw0PVs1Kt_2fgLhuaVI5i8MWASBKx3d6W6UoH2U3qChw9U',
                'privateKey' => 'CZtf_JUxmXkCKbzwaKedPPO9BFC99U2rk-GUYDbYAa8',
            ],
        ];

        $webPush = new WebPush($auth);

        $title = $request->input('title');
        $desc = $request->input('desc');
        $data = array($title, $desc);
        $notification_data = implode(', ', $data);
        foreach ($site_id_data as $token) {
            $subtoken = json_decode($token->token, true);
            $sub =  Subscription::create($subtoken);
            $webPush->queueNotification($sub, $notification_data);
        }

        $sent = 0;
        $failed = 0;
        foreach ($webPush->flush() as $report) {
            $endpoint = $report->getRequest()->getUri()->__toString();

            if ($report->isSuccess()) {
                $sent++;
            } else {
                $failed++;
            }
        }

        return ["sent" => $sent, "failed" => $failed];
    }
}
