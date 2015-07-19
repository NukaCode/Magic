<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\Series;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\Filesystem;

class ConvertCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtg:convert {series}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert JSON file to database records.';

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var Series
     */
    private $series;

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * Create a new command instance.
     *
     * @param Filesystem      $filesystem
     * @param Series          $series
     * @param DatabaseManager $db
     */
    public function __construct(Filesystem $filesystem, Series $series, DatabaseManager $db)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->series     = $series;
        $this->db         = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $series = $this->argument('series');

        $data = json_decode($this->filesystem->get(base_path('resources/assets/json/'. $series .'_full.json')));

        $series = $this->series->create((array)$data);

        $this->db->table('cards')->whereNull('series_id')->update(['series_id' => $series->id]);
    }
}
