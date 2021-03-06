<?php

namespace Ojs\ApiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Ojs\AdminBundle\Form\Type\PublisherType;
use Ojs\JournalBundle\Entity\Publisher;
use Symfony\Component\Form\FormFactoryInterface;
use Ojs\ApiBundle\Exception\InvalidFormException;

class PublisherHandler
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Publisher.
     *
     * @param mixed $id
     *
     * @return Publisher
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Publishers.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new Publisher.
     *
     * @param array $parameters
     *
     * @return Publisher
     */
    public function post(array $parameters)
    {
        $entity = $this->createPublisher();
        return $this->processForm($entity, $parameters, 'POST');
    }

    /**
     * Edit a Publisher.
     *
     * @param Publisher $entity
     * @param array         $parameters
     *
     * @return Publisher
     */
    public function put(Publisher $entity, array $parameters)
    {
        return $this->processForm($entity, $parameters, 'PUT');
    }

    /**
     * Partially update a Publisher.
     *
     * @param Publisher $entity
     * @param array         $parameters
     *
     * @return Publisher
     */
    public function patch(Publisher $entity, array $parameters)
    {
        return $this->processForm($entity, $parameters, 'PATCH');
    }

    /**
     * Delete a Publisher.
     *
     * @param Publisher $entity
     *
     * @return Publisher
     */
    public function delete(Publisher $entity)
    {
        $this->om->remove($entity);
        $this->om->flush();
        return $this;
    }

    /**
     * Processes the form.
     *
     * @param Publisher $entity
     * @param array         $parameters
     * @param String        $method
     *
     * @return Publisher
     *
     * @throws \Ojs\ApiBundle\Exception\InvalidFormException
     */
    private function processForm(Publisher $entity, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new PublisherType(), $entity, array('method' => $method, 'csrf_protection' => false));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {
            $page = $form->getData();
            $entity->setCurrentLocale('en');
            $this->om->persist($entity);
            $this->om->flush();
            return $page;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createPublisher()
    {
        return new $this->entityClass();
    }
}