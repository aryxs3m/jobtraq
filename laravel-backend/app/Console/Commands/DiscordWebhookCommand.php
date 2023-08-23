<?php

namespace App\Console\Commands;

use App\Services\Discord\DiscordAuthor;
use App\Services\Discord\DiscordEmbed;
use App\Services\Discord\DiscordField;
use App\Services\Discord\DiscordFooter;
use App\Services\Discord\DiscordImage;
use App\Services\Discord\DiscordProvider;
use App\Services\Discord\DiscordThumbnail;
use App\Services\Discord\DiscordVideo;
use App\Services\Discord\DiscordWebhook;
use Illuminate\Console\Command;

class DiscordWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:discord-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a test webhook';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $dc = DiscordWebhook::make()
            ->setUrl('https://discord.com/api/webhooks/1143966194529996892/PogvuzSh3nVcCxbkqxuwPoIXFy3fZ8MZvW-h-vm3SFMJy_AlRu4jNIoS3ukoVPOH-B01')
            ->setUsername('JobTraq test')
            ->setAvatarUrl('https://t4.ftcdn.net/jpg/00/97/58/97/360_F_97589769_t45CqXyzjz0KXwoBZT9PRaWGHRk5hQqQ.jpg')
            ->setContent('Ez egy teszt üzenet.')
            ->addEmbed(
                DiscordEmbed::make()
                    ->setTitle('Teszt embed')
                    ->setDescription('Teszt description')
                    ->setUrl('https://pvga.hu')
                    ->setColor('ffa500')
                    ->addField(
                        DiscordField::make()
                            ->setName('teszt')
                            ->setValue('teszt')
                            ->build()
                    )
                    ->setFooter(
                        DiscordFooter::make()
                            ->setText('Footer text')
                            ->setIconUrl('https://cdn-icons-png.flaticon.com/512/616/616430.png')
                            ->build()
                    )
                    ->setAuthor(
                        DiscordAuthor::make()
                            ->setName('JobTraq')
                            ->setUrl('https://jobtraq.hu')
                            ->setIconUrl('https://jobtraq.hu/assets/favicons/apple-icon-60x60.png')
                            ->build()
                    )
                    ->setImage(
                        DiscordImage::make()
                            ->setUrl('https://images.unsplash.com/photo-1544808208-727498b3df07?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')
                            ->build()
                    )
                    ->setThumbnail(
                        DiscordThumbnail::make()
                            ->setUrl('https://images.unsplash.com/photo-1544808208-727498b3df07?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')
                            ->build()
                    )
                    /*->setVideo(
                        DiscordVideo::make()
                            ->setUrl('http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4')
                            ->build()
                    )*/
                    ->setProvider(
                        DiscordProvider::make()
                            ->setName('JobTraq')
                            ->setUrl('https://jobtraq.hu')
                            ->build()
                    )
                    ->build()
            )
            ->addComponent(
            )
            ->send();

        // dd($dc);
    }
}
