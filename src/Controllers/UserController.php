<?php

namespace Api\Controllers;

use Api\Entities\User;
use Api\Enum\StatusEnum;
use Core\Controller\ControllerInterface;
use Core\Controller\ControllerResponse;
use Core\Database\DB;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;

final class UserController implements ControllerInterface
{
    protected EntityManager $DB;

    /** @throws \Exception */
    public function __construct()
    {
        $this->DB = (new DB())->getConnection();
    }

    /**
     * @param int|null $id
     * @return \Core\Controller\ControllerResponse
     */
    public function index(?int $id): ControllerResponse
    {
        $userRepository = $this->DB->getRepository('Api\Entities\User');

        if ($id) {
            (new ControllerResponse(
                StatusEnum::OK,
                'Users list',
                $userRepository->findBy(['id' => $id])
            ));
        }

        return (new ControllerResponse(
            StatusEnum::OK,
            'Users list',
            $userRepository->findAll()
        ));
    }

    /**
     * @param array $requestArguments
     * @return \Core\Controller\ControllerResponse
     */
    public function create(array $requestArguments): ControllerResponse
    {
        try {
            $user = new User();

            $user->setUsername($requestArguments['username']);
            $user->setPassword($requestArguments['password']);

            $this->DB->persist($user);
            $this->DB->flush();


            return (new ControllerResponse(StatusEnum::CREATED, 'User  was created.'));
        } catch (ORMException $exception) {
            return (new ControllerResponse(StatusEnum::ERROR, $exception->getMessage()));
        }
    }

    /**
     * @param int $id
     * @param array $requestArguments
     * @return \Core\Controller\ControllerResponse
     */
    public function update(int $id, array $requestArguments): ControllerResponse
    {
        try {
            $user = $this->DB->find('Api\Entities\User', $id);

            if ($user === null) {
                return (new ControllerResponse(StatusEnum::NOT_FOUND, "User $id does not exist."));
            }

            $user->setUsername($requestArguments['username']);
            $user->setPassword($requestArguments['password']);

            $this->DB->persist($user);
            $this->DB->flush();

            return (new ControllerResponse(StatusEnum::OK, 'User has been updated.'));
        } catch (OptimisticLockException | TransactionRequiredException | ORMException $exception) {
            return (new ControllerResponse(StatusEnum::ERROR, $exception->getMessage()));
        }
    }

    /**
     * @param int $id
     * @return \Core\Controller\ControllerResponse
     */
    public function delete(int $id): ControllerResponse
    {
        try {
            $user = $this->DB->find('Api\Entities\User', $id);

            if ($user === null) {
                return (new ControllerResponse(StatusEnum::NOT_FOUND, "User $id does not exist."));
            }

            $this->DB->remove($user);
            $this->DB->flush();

            return (new ControllerResponse(StatusEnum::OK, 'User has been deleted.'));
        } catch (OptimisticLockException | TransactionRequiredException | ORMException $exception) {
            return (new ControllerResponse(StatusEnum::ERROR, $exception->getMessage()));
        }
    }
}
