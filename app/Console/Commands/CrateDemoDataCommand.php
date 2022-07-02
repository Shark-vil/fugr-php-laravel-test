<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notebook;

class CrateDemoDataCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'demo:makedata';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create demonstration dataset';

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
	 * @return int
	 */
	public function handle()
	{
		$result = Notebook::factory(300)->create();

		echo('"' . count($result) . '" records were created in table "notebooks".');

		return 0;
	}
}
