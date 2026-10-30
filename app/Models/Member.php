<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Member extends Model
{
    use HasFactory;

    public const CARD_VALIDITY_YEARS = 3;

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'email',
        'no_hp',
        'alamat',
        'institusi',
        'jabatan',
        'foto',
        'ktp',
        'bukti_pembayaran',
        'status', // pending, approved, rejected
        'nomor_anggota',
        'tanggal_bergabung',
    ];

    protected $casts = [
        'tanggal_bergabung' => 'date',
    ];

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isActive(): bool
    {
        if (!$this->isApproved() || !$this->tanggal_bergabung) {
            return false;
        }

        return $this->getExpirationDate()->isFuture();
    }

    public function getExpirationDate(): ?\Illuminate\Support\Carbon
    {
        return $this->tanggal_bergabung
            ? Carbon::parse($this->tanggal_bergabung)->addYears(self::CARD_VALIDITY_YEARS)
            : null;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved')
            ->whereDate('tanggal_bergabung', '>', today()->subYears(self::CARD_VALIDITY_YEARS));
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'approved')
            ->whereDate('tanggal_bergabung', '<=', today()->subYears(self::CARD_VALIDITY_YEARS));
    }

    public function getMembershipStatusAttribute(): string
    {
        return $this->isActive() ? 'Aktif' : 'Expire';
    }

    public function renewMembership(?Carbon $renewalDate = null): void
    {
        $renewalDate ??= now();
        $memberNumber = (string) $this->nomor_anggota; 
        $sequence = substr($memberNumber, -5);

        if (!preg_match('/^\d{5}$/', $sequence)) {
            throw new \InvalidArgumentException('Nomor anggota harus memiliki 5 digit nomor urut.');
        }

        $this->update([
            'nomor_anggota'     => $renewalDate->format('Y') . $sequence,
            'tanggal_bergabung' => $renewalDate,
        ]);
    }

    public function generateMemberNumber(): string
    {
        // Format: YYYYXXXXX (Tahun 4 digit, Nomor urut 5 digit).
        $currentYear = date('Y');
        $prefix = $currentYear;

        // Cari nomor anggota terakhir pada tahun ini.
        $lastMember = self::where('nomor_anggota', 'LIKE', $prefix . '%')
            ->orderBy('nomor_anggota', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastMember) {
            $lastNumber = (int) substr($lastMember->nomor_anggota, -5);
            $nextNumber = $lastNumber + 1;
        }

        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}
