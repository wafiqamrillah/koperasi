<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'hris';

    protected $table = 'hr_employee';

    protected $hidden = [
        "address_id",
        "create_date",
        "coach_id",
        "resource_id",
        "color",
        "message_last_post",
        "image",
        "bank_account_id",
        "country_id",
        "parent_id",
        "otherid",
        "create_uid",
        "write_date",
        "sinid",
        "write_uid",
        "work_location_moved0",
        "image_medium",
        "ssnid",
        "image_small",
        "address_home_id",
        "passport_id",
        "notes",
        "manager",
        "medic_exam",
        "vehicle",
        "vehicle_distance",
        "tax_state",
        "pkp",
        "nonshift3",
        "feesecurity",
        "ec_woreda",
        "cash",
        "kerajinan",
        "ec_tel1",
        "kehadiran",
        "ec_tel2",
        "food",
        "work_location_moved1",
        "bahasa2",
        "t_bpjs_jkm",
        "amt",
        "bahasa1",
        "bahasa3",
        "gross_total",
        "security",
        "idcard",
        "field_study",
        "season_study",
        "d_lain",
        "transport",
        "ptkp_amt",
        "ec_name",
        "degree",
        "ec_country_id",
        "ec_address",
        "ec_relationship",
        "cos",
        "nobus",
        "pph",
        "tarif5",
        "pos_cost",
        "pokok",
        "jabatan",
        "period_from",
        "ec_kebele",
        "working_status_id",
        "ec_houseno",
        "line",
        "other",
        "ns",
        "gross_pph",
        "jamsostek",
        "catatan",
        "tinggi",
        "s_bpjs_e",
        "tambahan",
        "gross_pay",
        "evaluation_plan_id",
        "evaluation_date",
        "work_location_moved2",
        "work_location_moved3",
        "work_location_moved4",
        "work_location",
    ];
}
