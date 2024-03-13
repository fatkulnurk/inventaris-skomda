<?php

namespace App\Enums\Transactions;

use Filament\Support\Contracts\HasLabel;

enum TransactionBorrowedStatus: string implements HasLabel
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Menunggu Konfirmasi',
            self::ACCEPTED => 'Diterima',
            self::REJECTED => 'Ditolak',
        };
    }
}
