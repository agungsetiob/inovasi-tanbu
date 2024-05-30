<?php

namespace App\Exports;

use App\Models\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProposalsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Proposal::with(['bentuk', 'category', 'skpd', 'user', 'tematik', 'tahapan', 'inisiator'])->get();
    }

    /**
     * @var Proposal $proposal
     */
    public function map($proposal): array
    {
        return [
            $proposal->id,
            $proposal->nama,
            $proposal->rancang_bangun,
            $proposal->tujuan,
            $proposal->manfaat,
            $proposal->hasil,
            $proposal->ujicoba,
            $proposal->implementasi,
            $proposal->profil,
            $proposal->anggaran,
            $proposal->status,
            $proposal->bentuk->nama,
            $proposal->category->name,
            $proposal->skpd->nama,
            $proposal->user->name,
            $proposal->tematik->nama,
            $proposal->tahapan->nama,
            $proposal->inisiator->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Rancang Bangun',
            'Tujuan',
            'Manfaat',
            'Hasil',
            'Ujicoba',
            'Implementasi',
            'Profil',
            'Anggaran',
            'Status',
            'Bentuk',
            'Jenis',
            'SKPD',
            'User',
            'Tematik',
            'Tahapan',
            'Inisiator',
        ];
    }
}

