<?php

namespace App\Util\Quote\Status;

use App\Entity\Quote;
use App\Security\Roles\IUserRole;

class QuoteStatusLabel {
    public const STATUS_DRAFT = Quote::STATUS_DRAFT;
    public const STATUS_SENT = Quote::STATUS_SENT;
    public const STATUS_ACCEPTED = Quote::STATUS_ACCEPTED;
    public const STATUS_REFUSED = Quote::STATUS_REFUSED;

    private int $status;

    public function __construct(int $status) {
        $this->status = $status;
    }

    public function get(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT => 'Brouillon',
            self::STATUS_SENT => 'Envoyé',
            self::STATUS_ACCEPTED => 'Accepté',
            self::STATUS_REFUSED => 'Refusé',
            default => '',
        };
    }

    public static function all(): array
    {
        return [
            (new self(self::STATUS_DRAFT))->get() => self::STATUS_DRAFT,
            (new self(self::STATUS_SENT))->get() => self::STATUS_SENT,
            (new self(self::STATUS_ACCEPTED))->get() => self::STATUS_ACCEPTED,
            (new self(self::STATUS_REFUSED))->get() => self::STATUS_REFUSED,
        ];
    }
}