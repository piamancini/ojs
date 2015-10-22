<?php

namespace Ojs\JournalBundle\Event;

use Ojs\JournalBundle\Entity\Journal;
use Ojs\UserBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class JournalEvent extends Event
{
    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var Response $response
     */
    private $response;

    /**
     * @var Journal $journal
     */
    private $journal;

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var string $eventType
     */
    private $eventType;

    /**
     * @param Request $request
     * @param Journal $journal
     * @param User $user
     * @param string $eventType
     */
    public function __construct(Request $request,Journal $journal, User $user, $eventType = '')
    {
        $this->request = $request;
        $this->journal = $journal;
        $this->user = $user;
        $this->eventType = $eventType;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Journal
     */
    public function getJournal()
    {
        return $this->journal;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
