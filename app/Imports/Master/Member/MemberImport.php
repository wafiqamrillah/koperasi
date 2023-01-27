<?php

namespace App\Imports\Master\Member;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Models
use App\Models\Master\Member\Member;

// Request
use App\Http\Requests\Master\Member\StoreMemberRequest;

class MemberImport implements ToModel, WithStartRow, WithHeadingRow, WithColumnFormatting
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Member([
            'name' => $row['name'] ?? $row['nama'] ?? $row['nama_karyawan'] ?? $row[1] ?? null,
            'id_card_number' => $row['id_card_number'] ?? $row['nomor_ktp'] ?? $row['nik_ktp'] ?? $row[4] ?? null,
            'birth_place' => $row['birth_place'] ?? $row['tempat_lahir'] ?? $row[5] ?? null,
            'birth_date' => $row['birth_date'] ?? $row['tanggal_lahir'] ?? $row[6] ?? null,
            'address' => $row['address'] ?? $row['alamat'] ?? $row['alamat_rumah'] ?? $row[10],
            'is_married' => $row['is_married'] ?? (isset($row['status_perkawinan']) ? in_array($row['status_perkawinan'], ['Kawin', 'kawin']) : false),
            'phone_number' => $row['phone_number'] ?? $row['nomor_handphone'] ?? $row['no_hp'] ?? $row[12] ?? null,
            'account_number' => $row['account_number'] ?? $row['nomor_rekening'] ?? $row[13] ?? null,
            'is_active' => true,
        ]);
    }

    public function rules(): array
    {
        return (new StoreMemberRequest)->rules();
    }

    public function headingRow(): int
    {
        return 1;
    }
    
    public function startRow(): int
    {
        return 2;
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
