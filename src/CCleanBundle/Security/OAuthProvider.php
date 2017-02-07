<?php
/**
 * Created by PhpStorm.
 * User: j1v3
 * Date: 07/02/17
 * Time: 10:44
 */

namespace CCleanBundle\Security;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use CCleanBundle\Entity\Client;

class OAuthProvider extends OAuthUserProvider
{
    protected $session, $doctrine, $admins;

    /**
     * @param $session
     * @param $doctrine
     * @param $service_container
     */
    public function __construct($session, $doctrine, $service_container)
    {
        $this->session = $session;
        $this->doctrine = $doctrine;
        $this->container = $service_container;
    }

    /**
     * @param string $username
     * @return Client
     */
    public function loadUserByUsername($username)
    {

        $qb = $this->doctrine->getManager()->createQueryBuilder();
        $qb->select('u')
            ->from('CCleanBundle:Client', 'u')
            ->where('u.googleId = :gid')
            ->setParameter('gid', $username)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        if (count($result)) {
            return $result[0];
        } else {
            return new Client();
        }
    }

    /**
     * @param UserResponseInterface $response
     * @return Client
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        //Data from Google response
        $google_id = $response->getUsername(); /* An ID like: 112259658235204980084 */
        $email = $response->getEmail();
        $nickname = $response->getNickname();
        $realname = $response->getRealName();
        $avatar = $response->getProfilePicture();

        //set data in session
        $this->session->set('email', $email);
        $this->session->set('nickname', $nickname);
        $this->session->set('realname', $realname);
        $this->session->set('avatar', $avatar);

        //Check if this Google user already exists in our app DB
        $qb = $this->doctrine->getManager()->createQueryBuilder();
        $qb->select('u')
            ->from('FoggylineTickerBundle:User', 'u')
            ->where('u.googleId = :gid')
            ->setParameter('gid', $google_id)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        //add to database if doesn't exists
        if (!count($result)) {
            $user = new Client();
            $user->setUsername($google_id);
            $user->setName($realname);
            $user->setSurname($nickname);
            $user->setMail($email);
            $user->setGoogleId($google_id);
            //$user->setRoles('ROLE_USER');

            //Set some wild random pass since its irrelevant, this is Google login
            $factory = $this->container->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword(md5(uniqid()), $user->getSalt());
            $user->setPassword($password);

            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();
        } else {
            $user = $result[0]; /* return User */
        }

        //set id
        $this->session->set('id', $user->getId());

        return $this->loadUserByUsername($response->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'CCleanBundle\\Entity\\Client';
    }
}