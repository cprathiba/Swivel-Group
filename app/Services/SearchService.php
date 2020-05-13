<?php


namespace App\Services;

use App\Repository\OrganizationRepositoryInterface;
use App\Repository\TicketRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class SearchService
{

    /**
     * preferred entity user , ticket or org.
     * @var
     */

    protected $selectedEntity;

    /**
     * searching field
     * @var
     */

    protected $searchTerm;

    /**
     * search key word
     * @var
     */

    protected $searchValue;

    /**
     *
     * @var mixed
     */

    protected $user;

    /**
     * @var mixed
     */
    protected $organization;

    /**
     * @var mixed
     */
    protected $ticket;

    /**
     * SearchService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param TicketRepositoryInterface $ticketRepository
     * @param OrganizationRepositoryInterface $organizationRepository
     */

    public function __construct(UserRepositoryInterface $userRepository,
                                TicketRepositoryInterface $ticketRepository,
                                OrganizationRepositoryInterface $organizationRepository)
    {
        $this->user = $userRepository;

        $this->organization = $organizationRepository;

        $this->ticket = $ticketRepository;
    }

    /**
     * getting searchable parameters from each entity
     * @return array
     */

    public function getSearchableFields() {
        return ['Search Users with' => array_keys($this->user->getFields()), 'Search Tickets with' => array_keys($this->ticket->getFields()),
            'Search Organizations with' => array_keys($this->organization->getFields())];
    }

    /**
     * filter results based on search criteria
     * @param $selectedEntity
     * @param $searchTerm
     * @param $searchValue
     * @return array
     * @throws \Exception
     */

    public function filterProcess($selectedEntity, $searchTerm, $searchValue){

        try {

            $this->selectedEntity = $selectedEntity;

            $this->searchValue = $searchValue;

            $this->searchTerm = $searchTerm;

            if(!array_key_exists($this->searchTerm, $this->{$this->selectedEntity}->getFields())) {
                throw new \Exception('Search term ,'.$this->searchTerm.' is not available');
            }

            return $this->searchEntity();

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

    /**
     * search from entities
     * @return array
     * @throws \Exception
     */

    private function searchEntity()
    {
        try {

            if($this->selectedEntity == $this->user::USER) {
                $users = ($this->{$this->selectedEntity}->search($this->searchTerm, $this->searchValue));

                if(count($users) == 0):
                    throw new \Exception('No records found');
                endif;

                $userSubmittedTickets = [];
                $userAssigneeTickets = [];
                $organization = [];

                foreach ($users as $key => $user):

                    $userSubmittedTickets[$user['name']] = $this->ticket->findAllSubmittedTicketsByUserId($user['_id'], ['subject']);
                    $userAssigneeTickets[$user['name']] = $this->ticket->findAllAssigneeTicketsByUserId($user['_id'], ['subject']);

                    if(array_key_exists('organization_id', $user)):
                        $organization[$user['name']] = $this->organization->findById($user['organization_id'], ['name']);
                    else:
                        $organization[$user['name']] = ['organization is not available'];
                    endif;

                endforeach;

                return ['tickets submitted by' => $userSubmittedTickets, 'tickets assignee to' => $userAssigneeTickets, 'organization name' => $organization];

            } elseif ($this->selectedEntity == $this->ticket::TICKET) {

                $tickets = ($this->{$this->selectedEntity}->search($this->searchTerm, $this->searchValue));

                if(count($tickets) == 0):
                    throw new \Exception('No records found');
                endif;

                $submitter = [];
                $assignee = [];

                foreach ($tickets as $ticket):

                    if(array_key_exists('organization_id',$ticket)):
                        $organizationName = $this->organization->findById($ticket['organization_id'], ['name']);
                    else:
                        $organizationName = ['Organization is not available'];
                    endif;

                    if (array_key_exists('submitter_id', $ticket)):
                        $submitterName = $this->user->findById($ticket['submitter_id'], ['name']);
                        $submitter[$ticket['_id']] = reset($submitterName).' - '.reset($organizationName);
                    endif;

                    if (array_key_exists('assignee_id', $ticket)):
                        $assigneeName = $this->user->findById($ticket['assignee_id'], ['name']);
                        $assignee[$ticket['_id']] = reset($assigneeName) .' - '. reset($organizationName);
                    endif;

                endforeach;

                return ['ticket submitter' => $submitter, 'ticket assignee' => $assignee];

            } elseif ($this->selectedEntity == $this->organization::ORGANIZATION) {
                $organizations = ($this->{$this->selectedEntity}->search($this->searchTerm, $this->searchValue));

                if(count($organizations) == 0):
                    throw new \Exception('No records found');
                endif;

                $users = [];
                $tickets = [];

                foreach ($organizations as $organization):

                    $users[$organization['name']] = $this->user->findAllUsersByOrgId($organization['_id'],['name']);
                    $tickets[$organization['name']] = $this->ticket->findAllTicketsByOrgId($organization['_id'], ['subject']);
                endforeach;

                return ['user names' => $users, 'ticket subjects' => $tickets];
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

}
