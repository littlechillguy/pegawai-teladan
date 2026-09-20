<?php

namespace Database\Seeders;

use App\Models\Criterion;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            'Inovasi dan Kreativitas' => [
                'Seberapa sering pegawai memberikan ide atau solusi baru dalam pekerjaan?',
                'Seberapa baik pegawai mencari cara yang lebih efektif dalam menyelesaikan pekerjaan?',
                'Seberapa mampu pegawai mengembangkan ide menjadi solusi yang dapat diterapkan?',
            ],

            'Kemampuan Bekerja Sama' => [
                'Seberapa baik pegawai bekerja sama dengan anggota tim?',
                'Seberapa aktif pegawai membantu rekan kerja ketika menghadapi kesulitan?',
                'Seberapa baik pegawai berkomunikasi dalam menyelesaikan pekerjaan bersama tim?',
            ],

            'Penampilan Saat Bekerja' => [
                'Seberapa baik pegawai menjaga kerapian dan kebersihan saat bekerja?',
                'Seberapa sesuai penampilan pegawai dengan ketentuan perusahaan?',
            ],

            'Integritas' => [
                'Seberapa jujur pegawai dalam menjalankan tugas dan tanggung jawabnya?',
                'Seberapa konsisten pegawai mematuhi aturan dan ketentuan perusahaan?',
                'Seberapa dapat dipercaya pegawai dalam menjalankan tanggung jawabnya?',
            ],

            'Sasaran Kerja Pegawai' => [
                'Seberapa baik pegawai mencapai target pekerjaan yang diberikan?',
                'Seberapa konsisten pegawai menyelesaikan pekerjaan sesuai target dan waktu yang ditentukan?',
                'Seberapa baik kualitas hasil pekerjaan pegawai dalam mencapai sasaran kerja?',
            ],
        ];

        foreach ($questions as $criterionName => $questionList) {
            $criterion = Criterion::where('name', $criterionName)->firstOrFail();

            foreach ($questionList as $index => $questionText) {
                Question::create([
                    'criterion_id' => $criterion->id,
                    'question' => $questionText,
                    'order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}