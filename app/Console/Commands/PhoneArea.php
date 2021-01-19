<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class PhoneArea extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phone:area  {--path=} {--save=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取手机号的归属地';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws
     */
    public function handle()
    {
        $path = $this->option("path");
        $save = $this->option("save");

        if(empty($path))
        {
            return false;
        }
        $helper = new Sample();
        $inputFileName = $path;
        $helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
        $spreadsheet = IOFactory::load($inputFileName);
        $active_sheet = $spreadsheet->getActiveSheet();
        $sheetData = $active_sheet->toArray(null, true, true, true);



        foreach ($sheetData as $key => $value)
        {
            $phone = $value["A"];
            $url = "https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query={$phone}&resource_id=6004&ie=utf8&oe=utf8&format=json";

            try{
                echo microtime(),":执行第{$key}个号码\n";
                $json = file_get_contents($url);
                $data = json_decode($json, true);
                echo microtime(), ":执行完成,省:",$data['data'][0]['prov'],"市:",$data['data'][0]['city'],"\n";
                $active_sheet->setCellValue("B".$key, $data['data'][0]['prov']);
                $active_sheet->setCellValue("C".$key, $data['data'][0]['city']);
            }catch(\Exception $e)
            {

            }
        }

        $writer = new Xls($spreadsheet);
        $writer->save($save);
//        var_dump($sheetData);
    }
}
