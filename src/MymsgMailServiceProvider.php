<?php
namespace ItPoet\MymsgLaravelMail;
use Illuminate\Mail\MailServiceProvider;
use ItPoet\MymsgLaravelMail\MymsgTransport;
use Swift_Mailer;

class MymsgMailServiceProvider extends MailServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
          __DIR__.'/../config/mymsgmail.php' => config_path('mymsgmail.php'),
        ]);
    }

    /**
     * Register the Swift Mailer instance.
     *
     * @return void
     */
    public function registerSwiftMailer()
    {
        if ($this->app['config']['mail.driver'] == 'mymsgmail') {
            $this->registerMymsgSwiftMailer();
        } else {
            parent::registerSwiftMailer();
        }
    }

    /**
     * Register the Mymsg Swift Mailer instance.
     *
     * @return void
     */
    protected function registerMymsgSwiftMailer()
    {
        $this->registerSwiftTransport();
        $this->app->singleton('swift.mailer', function ($app) {
            return new Swift_Mailer(
              new MymsgTransport($app)
            );
        });
    }
}