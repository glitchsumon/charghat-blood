<?php

namespace App\Services\Verification;

use App\Models\EmailVerificationCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class EmailCodeService
{
    public function issue(string $email): string
    {
        $code = (string) random_int(100000, 999999);

        EmailVerificationCode::query()->create([
            'email' => $email,
            'code_hash' => Hash::make($code),
            'expires_at' => Carbon::now()->addMinutes(10),
            'attempts' => 0,
        ]);

        return $code;
    }

    public function verify(string $email, string $code): bool
    {
        $record = EmailVerificationCode::query()
            ->where('email', $email)
            ->where('expires_at', '>', now())
            ->latest('id')
            ->first();

        if (! $record) {
            return false;
        }

        $record->increment('attempts');

        if ($record->attempts > 5) {
            return false;
        }

        return Hash::check($code, $record->code_hash);
    }
}
