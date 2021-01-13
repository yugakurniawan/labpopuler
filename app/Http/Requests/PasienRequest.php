<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'noreg'         =>  ['required','string','max:50','unique:tb_pasien,noreg'],
            'nama'          =>  ['required','string','max:50'],
            'kelamin'       =>  ['required','string','max:15'],
            'tmp_lahir'     =>  ['nullable','string','max:40'],
            'tgl_lhr'       =>  ['required','date','before:now'],
            'alamat'        =>  ['nullable','string','max:60'],
            'kelurahan'     =>  ['nullable','string','max:30'],
            'kota'          =>  ['nullable','string','max:4'],
            'negara'        =>  ['nullable','string','max:4'],
            'agama'         =>  ['nullable','string','max:4'],
            'darah'         =>  ['nullable','string','max:4'],
            'ibu'           =>  ['nullable','string','max:50'],
            'tlp'           =>  ['nullable','numeric','max:15'],
            'hp'            =>  ['nullable','numeric','max:15'],
            'pendidikan'    =>  ['nullable','string','max:4'],
            'perusahaan'    =>  ['nullable','string','max:4'],
            'pekerjaan'     =>  ['nullable','string','max:4'],
            'fhoto'         =>  ['nullable','image','max:2048'],
            'pin'           =>  ['nullable','string','max:50'],
            'npk'           =>  ['nullable','string','max:50'],
            'bagian'        =>  ['nullable','string','max:50'],
            'no_jamsostek'  =>  ['nullable','string','max:25'],
            'jabatan'       =>  ['nullable','string','max:50'],
            'dept'          =>  ['nullable','string','max:50'],
            'no_askes'      =>  ['required','string','max:50'],
            'title_id'      =>  ['required','string','max:4'],
            'pangkat'       =>  ['nullable','string','max:50'],
            'kesatuan'      =>  ['nullable','string','max:50'],
            'masakerja'     =>  ['nullable','string','max:50'],
            'nrp'           =>  ['nullable','string','max:50'],
            'paket'         =>  ['nullable','string','max:6'],
            'keydata'       =>  ['nullable','string','max:50'],
            'reg_old'       =>  ['nullable','string','max:20'],
            'lokasi'        =>  ['nullable','string','max:50'],
            'no_rm'         =>  ['nullable','string','max:50'],
        ];

        if (request()->isMethod('patch')) {
            $rules['noreg'] = ['required','string','max:50', Rule::unique('tb_pasien','noreg')->ignore($this->pasien)];
        }

        return $rules;
    }

    public function message()
    {
        return [
            'tmp_lahir.required'    => 'tempat lahir wajib diisi.',
            'tmp_lahir.max'         => 'tempat lahir mungkin tidak lebih besar dari 40 karakter.',
            'tgl_lhr.required'      => 'tanggal lahir wajib diisi.',
            'tgl_lhr.before'        => 'tanggal harus berupa tanggal sebelumnya hari ini.',
            'title_id.required'     => 'title wajib diisi.',
            'tlp.digits_between'    => 'nomor telepon harus antara 5 dan 13 digit.',
            'hp.digits_between'     => 'nomor hp harus antara 5 dan 13 digit.',
            'fhoto.image'           => 'foto profil harus berupa gambar.',
            'fhoto.max'             => 'foto profil mungkin tidak lebih besar dari 2048 kilobytes.',
            'no_jamsostek.max'      => 'nomor jamsostek mungkin tidak lebih besar dari 25 karakter.',
            'no_askes.max'          => 'nomor askes mungkin tidak lebih besar dari 25 karakter.',
        ];
    }
}
