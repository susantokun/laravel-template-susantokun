<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });

        if (env('EMAIL_TEMPLATE')) {
            ResetPassword::toMailUsing(function ($notifiable, $token) {
                $urlResetPassword = config('app.frontend_url')."/reset-password/$token?email={$notifiable->getEmailForPasswordReset()}";

                return (new MailMessage)
                    ->subject(Lang::get('Pemberitahuan Pengaturan Ulang Kata Sandi'))
                    ->greeting(Lang::get('Halo!'))
                    ->line(Lang::get('Anda menerima surel ini karena kami menerima permintan pengaturan ulang kata sandi untuk akun anda.'))
                    ->action(Lang::get('Atur Ulang Kata Sandi'), $urlResetPassword)
                    // ->line(Lang::get('Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                    ->line(Lang::get('Jika Anda tidak meminta pengaturan ulang kata sandi, Anda tidak perlu melakukan apapun.'));
            });

            VerifyEmail::toMailUsing(function ($notifiable) {
                $urlVerify = config('app.frontend_url')."/verify-email/" . $notifiable->getKey() . "/" . sha1($notifiable->getEmailForVerification());

                return (new MailMessage)
                    ->subject(Lang::get('Verifikasi Alamat Surel'))
                    ->greeting(Lang::get('Halo!'))
                    ->line(Lang::get('Silakan klik tombol di bawah untuk memverifikasi alamat surel Anda.'))
                    ->action(Lang::get('Verifikasi Alamat Surel'), $urlVerify)
                    ->line(Lang::get('Jika Anda tidak membuat akun, Anda tidak perlu melakukan apapun.'));
            });
        }
    }
}
