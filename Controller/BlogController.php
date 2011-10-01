<?php

/*
 *  @category   Blog Bundle
 *  @package    Controller
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Faianca\BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\ArrayAdapter;

class BlogController extends Controller {
    
    public function indexAction($page)
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $articles = $em->getRepository('FaiancaBlogBundle:Post')->findAll();
        
        $adapter = new ArrayAdapter($articles);
        $pager = new Pager($adapter, array('page' => $page, 'limit' => 5));
      
        return $this->render('FaiancaBlogBundle:Blog:index.html.twig', array(
            'pager' => $pager
        ));   
    }
    
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $article = $em->getRepository('Faianca\BlogBundle\Entity\Post')->findOneBySlug($slug);
        
         if (!$article) {
            throw new NotFoundHttpException(sprintf('Post (%s) not found', $slug));
        }
        
       // $commentForm = $this->createForm(new CommentType(), $article);
        $form = $this->getCommentForm($article);
        
        return $this->render('FaiancaBlogBundle:Blog:show.html.twig', array(
            'article' => $article,
            'form' => $form->createView()
        ));
    }
    
     /**
     * @param $post
     * @return
     */
    public function getCommentForm($post)
    {
        $comment = $this->get('faianca.blog.comment')->create();
        $comment->setPost($post);
        $comment->setCreatedAt('now');
        $comment->setStatus(1);
        
        return $this->get('form.factory')->createNamed('faianca_comment', 'comment', $comment);
    }
    
    
    public function addCommentAction($id)
    {
        $post = $this->get('faianca.manager.post')->findOneBy(array(
            'id' => $id
        ));

        if (!$post) {
            throw new NotFoundHttpException(sprintf('Post (%d) not found', $id));
        }

        $form = $this->getCommentForm($post);
        $form->bindRequest($this->get('request'));

        if ($form->isValid()) {
            $this->get('faianca.blog.comment')->save($form->getData());

            // todo : add notice
            return new RedirectResponse($this->generateUrl('blog_show', array(
                'slug'  => $post->getSlug()
            )));
        }

        return $this->render('FaiancaBlogBundle:Blog:show.html.twig', array(
            'article' => $post,
            'form' => $form->createView()
        ));
    }
    
}