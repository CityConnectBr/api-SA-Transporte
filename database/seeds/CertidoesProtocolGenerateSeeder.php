<?php

use App\Models\Certidao;
use App\Models\CounterProtocol;
use Illuminate\Database\Seeder;

class CertidoesProtocolGenerateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 1;
        $previousYear = 0;
        $previousCounter = 0;
        (new \App\Models\Certidao)->chunkById(200, function ($certidoes) use (&$counter, &$previousYear, &$previousCounter) {
            foreach ($certidoes as $certidao) {
                if($previousCounter > 1 and $previousYear == Carbon\Carbon::parse($certidao->data)->format('Y')) {
                    $counter = $previousCounter;
                }
                
                if(Carbon\Carbon::parse($certidao->data)->format('Y') == Carbon\Carbon::now()->format('Y')) {
                    $counter2023 = CounterProtocol::firstOrCreate(
                        ['year' => Carbon\Carbon::now()->year],
                        ['number' => 1]
                    );
                    (new CounterProtocol)->where('year', Carbon\Carbon::now()->year)->increment('number');

                    $certidao->protocol = $counter2023->year . '-' . $counter2023->number;
                    $certidao->save();
                    continue;
                }

                if($counter > 1) {
                    if ($previousYear != Carbon\Carbon::parse($certidao->data)->format('Y')) {
                        $counter = 1;
                    }

                }
                $currentYear = Carbon\Carbon::parse($certidao->data)->format('Y');
                $certidao->protocol = $currentYear . '-' . $counter;
                $certidao->save();
                $counter++;
                $previousYear = $currentYear;
                $previousCounter = $counter;
            }
        });
    }
}
