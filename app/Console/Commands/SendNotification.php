<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "Sending notification\n";


        $auth = [
            'VAPID' => [
                'subject' => 'mailto:me@website.com', // can be a mailto: or your website address
                'publicKey' => 'BBZY7Q3KEtZArAAWMLi_qzWHbH4vAoqPpIXnRhmlUaw0PVs1Kt_2fgLhuaVI5i8MWASBKx3d6W6UoH2U3qChw9U',
                'privateKey' => 'CZtf_JUxmXkCKbzwaKedPPO9BFC99U2rk-GUYDbYAa8',
            ],
        ];

        $webPush = new WebPush($auth);

        $clientSub = json_decode('{"endpoint":"https://fcm.googleapis.com/fcm/send/e1I85lkKkpE:APA91bFnJf-phD7ifvMMQqaZNramqv0HdJbwBlKOQM6VE-U7tGGHHRGC4sUzLWK73ZiLv3Wi92u5ferYB1IDJlzxesqvlSMXP63S1xSUv3hZMOvU-h-GyktCf027S-HMGlSN00t77GMJ","expirationTime":null,"keys":{"p256dh":"BFPyEjFJxP4c8wAgob75a_5atB_tIpTBTO8Vd9DH0gYmtodrw6_1J9I8kzT5ukhWAPNtDOBX5L3XomgBh7DxjnA","auth":"tS33g8z2uazHvfnYwKAMkg"}}', true);
        $sub =  Subscription::create($clientSub);

        $webPush->queueNotification($sub, 'Hello');

        foreach ($webPush->flush() as $report) {
            $endpoint = $report->getRequest()->getUri()->__toString();

            if ($report->isSuccess()) {
                echo "[v] Message sent successfully for subscription {$endpoint}.";
            } else {
                echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
            }
        }

        echo "\n";
    }
}
