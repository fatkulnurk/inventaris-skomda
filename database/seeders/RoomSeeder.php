<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms =  [
            [
                "name" => "Ruang 1",
                "code" => "R01",
                "description" => "Ruang Kelas X SIJA 2"
            ],
            [
                "name" => "Ruang 2",
                "code" => "R02",
                "description" => "Ruang Kelas X SIJA 1"
            ],
            [
                "name" => "Kamar Mandi 1",
                "code" => "RM01",
                "description" => "Kamar Mandi Karyawan"
            ],
            [
                "name" => "Ruang 3",
                "code" => "R03",
                "description" => "Ruang Guru"
            ],
            [
                "name" => "Ruang 4",
                "code" => "R04",
                "description" => "Ruang TU-SARPRA"
            ],
            [
                "name" => "Ruang 5",
                "code" => "R05",
                "description" => "Ruang Kesiswaan - Kurikulum"
            ],
            [
                "name" => "Ruang 6",
                "code" => "R06",
                "description" => "Ruang Kepsek"
            ],
            [
                "name" => "Ruang 7",
                "code" => "R07",
                "description" => "Ruang Perpus, UKS, Konseling"
            ],
            [
                "name" => "Ruang 8",
                "code" => "R08",
                "description" => "Ruang SMC"
            ],
            [
                "name" => "Ruang 9",
                "code" => "R09",
                "description" => "Ruang Hubin"
            ],
            [
                "name" => "Kamar Mandi 2",
                "code" => "RM02",
                "description" => "Kamar Mandi Siswi"
            ],
            [
                "name" => "Kamar Mandi 3",
                "code" => "RM03",
                "description" => "Kamar Mandi Siswa"
            ],
            [
                "name" => "Ruang 10",
                "code" => "R10",
                "description" => "Ruang Aula 1"
            ],
            [
                "name" => "Ruang 11",
                "code" => "R11",
                "description" => "Ruang Aula 2"
            ],
            [
                "name" => "Ruang 12",
                "code" => "R12",
                "description" => "Ruang Aula 3"
            ],
            [
                "name" => "Ruang 13",
                "code" => "R13",
                "description" => "Ruang Kelas X TJA 1"
            ],
            [
                "name" => "Ruang 14",
                "code" => "R14",
                "description" => "Ruang Kelas X TJA 2"
            ],
            [
                "name" => "Kamar Mandi 4",
                "code" => "RM04",
                "description" => "Kamar Mandi 4"
            ],
            [
                "name" => "Ruang 15",
                "code" => "R15",
                "description" => "Ruang Kelas X TJA 3"
            ],
            [
                "name" => "Ruang 16",
                "code" => "R16",
                "description" => "Ruang Kelas X TJA 4"
            ],
            [
                "name" => "Ruang 17",
                "code" => "R17",
                "description" => "Ruang Kelas X TJA 5"
            ],
            [
                "name" => "Ruang 18",
                "code" => "R18",
                "description" => "Ruang Kelas X TJA 6"
            ],
            [
                "name" => "Ruang 19",
                "code" => "R19",
                "description" => "Ruang Lab Fiber Optik"
            ],
            [
                "name" => "Ruang 20",
                "code" => "R20",
                "description" => "Ruang Lab Data Center"
            ],
            [
                "name" => "Ruang 21",
                "code" => "R21",
                "description" => "Ruang Lab Komputer"
            ],
            [
                "name" => "Kamar Mandi 5",
                "code" => "RM05",
                "description" => "Kamar Mandi 5"
            ],
            [
                "name" => "Ruang 22",
                "code" => "R22",
                "description" => "Ruang Lab Jaringan"
            ],
            [
                "name" => "Ruang 23",
                "code" => "R23",
                "description" => "Ruang Lab IoT"
            ],
            [
                "name" => "Ruang 24",
                "code" => "R24",
                "description" => "Ruang Kelas Kosong"
            ],
            [
                "name" => "Ruang 25",
                "code" => "R25",
                "description" => "Ruang Kelas XI SIJA 1"
            ],
            [
                "name" => "Ruang 26",
                "code" => "R26",
                "description" => "Ruang Kelas XI SIJA 2"
            ],
            [
                "name" => "Kamar Mandi 6",
                "code" => "RM06",
                "description" => "Kamar Mandi 6"
            ],
            [
                "name" => "Ruang 27",
                "code" => "R27",
                "description" => "Ruang Kelas XI TJA 1"
            ],
            [
                "name" => "Ruang 28",
                "code" => "R28",
                "description" => "Ruang Kelas XI TJA 2"
            ],
            [
                "name" => "Ruang 29",
                "code" => "R29",
                "description" => "Ruang Kelas XI TJA 3"
            ],
            [
                "name" => "Ruang 30",
                "code" => "R30",
                "description" => "Ruang Kelas XI TJA 4"
            ],
            [
                "name" => "Ruang 31",
                "code" => "R31",
                "description" => "Ruang Kelas XI TJA 5"
            ],
            [
                "name" => "Ruang 32",
                "code" => "R32",
                "description" => "Ruang Kelas XII TJA 1"
            ],
            [
                "name" => "Ruang 33",
                "code" => "R33",
                "description" => "Ruang Kelas XII TJA 2"
            ],
            [
                "name" => "Ruang 34",
                "code" => "R34",
                "description" => "Ruang Kelas XII TJA 3"
            ],
            [
                "name" => "Ruang 35",
                "code" => "R35",
                "description" => "Ruang Kelas XII TJA 4"
            ],
            [
                "name" => "Ruang 36",
                "code" => "R36",
                "description" => "Ruang Kelas XII TJA 5"
            ]
        ];

//        $building = Building::query()->first();
//        foreach ($rooms as &$room) {
//            $room['building_id'] = $building->getKey();
//        }

        Room::query()->upsert($rooms, ['id']);
    }
}
