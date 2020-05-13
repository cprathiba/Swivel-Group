<?php

namespace App\Console\Commands;

use App\Services\SearchService;
use Illuminate\Console\Command;

class SearchStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * const val for Quite from command
     */

    protected const QUITE = 'quite';

    /**
     * const value for search option
     */

    protected const SEARCH = 1;

    /**
     * const value for getting searchable fields
     */

    protected const RETRIEVE_PARAMS = 2;

    /**
     * search service
     * @var SearchService
     */

    protected $searchService;

    /**
     * Create a new command instance. SearchStart constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $preferredOption = $this->choice('Select search options: '
                , [1 => 'Press 1 to search', 2 => 'Press 2 to view a list of searchable fields',
                    'quite' => ' Type "quite" to exit']);

            if ($preferredOption == self::QUITE):
                return false;
            endif;

            $response = [];

            if ($preferredOption == self::SEARCH):
                $entity = $this->choice('Select ', [1 => 'user', 2 => 'ticket', 3 => 'organization']);

                $searchTerm = $this->ask('Enter search term');

                $searchValue = $this->ask('Enter search value');

                $response = $this->searchService->filterProcess($entity, $searchTerm, $searchValue);

            elseif ($preferredOption == self::RETRIEVE_PARAMS):

                $response = $this->searchService->getSearchableFields();

            elseif ($preferredOption == self::QUITE):
                return false;
            endif;

            $this->displayOutput($response);

        } catch (\Exception $exception) {

            $this->info($exception->getMessage());
        }

    }

    /**
     * display out put here
     * @param $results
     */

    private function displayOutput($results)
    {

        foreach ($results as $entity => $items):
            $this->info('******************************************************');
            $this->info('<info>-------------' . $entity . '-----------------</info>');
            $this->info('******************************************************');

            foreach ($items as $key => $item):
                if (is_array($item)):
                    $this->info('<info>' . $key . ' - ' . implode(',', $item) . '</info>');
                else:
                    $this->info('<info>' . $key . ' - ' . $item . '</info>');
                endif;

            endforeach;

        endforeach;
    }

}
