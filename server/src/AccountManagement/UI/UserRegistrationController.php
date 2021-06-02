<?php
declare(strict_types=1);

namespace RealDeal\AccountManagement\UI;

use RealDeal\AccountManagement\Domain\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use RealDeal\AccountManagement\Domain\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRegistrationController
{
    private UserPasswordEncoderInterface $userPasswordEncoder;
    private UserRepository $userRepository;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        UserRepository $userRepository
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userRepository = $userRepository;
    }
    public function registerAccountAction(Request $request): JsonResponse
    {
        $request = json_decode($request->getContent(), true);

        $userName = $request['username'];
        $firstName = $request['firstname'];
        $lastName = $request['lastname'];
        $email = $request['email'];
        $password = $request['password'];

        /** @var UserInterface $user */
        $user = User::createNew($firstName, $lastName, $userName, $email, $password);
        $encodedPassword = $this->userPasswordEncoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);
        $this->userRepository->save($user);

        return new JsonResponse($user->getId(), Response::HTTP_CREATED);
    }
}
