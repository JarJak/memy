<?php

namespace Memy\MemeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Memy\MemeBundle\Entity\Meme;
use Memy\MemeBundle\Form\MemeType;

/**
 * Meme controller.
 *
 */
class MemeController extends Controller
{
    /**
     * @param Request $request
     */
    public function listAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT m FROM MemyMemeBundle:Meme m ORDER BY m.insertedAt DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            40/*limit per page*/
        );

        // parameters to template
        return $this->render('MemyMemeBundle:Meme:list.html.twig', array('pagination' => $pagination));
    }
    
    /**
     * Creates a new Meme entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Meme();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid() && $form['filename']->getData()) {
            $dir = $this->get('kernel')->getRootDir() . '/../web/uploads/memes/';
            $form['filename']->getData()->move($dir);
            $entity->setOriginalFilename($form['filename']->getData());
            $entity->setUserIp($request->getClientIp());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        return $this->render('MemyMemeBundle:Meme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Meme entity.
     *
     * @param Meme $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Meme $entity)
    {
        $form = $this->createForm(new MemeType(), $entity, array(
            'action' => $this->generateUrl('meme_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Meme entity.
     *
     */
    public function newAction()
    {
        $entity = new Meme();
        $form   = $this->createCreateForm($entity);

        return $this->render('MemyMemeBundle:Meme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Meme entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemyMemeBundle:Meme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MemyMemeBundle:Meme:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a random Meme entity.
     *
     */
    public function randomAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemyMemeBundle:Meme')->findBy(array(), array(), 1);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        return $this->render('MemyMemeBundle:Meme:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Meme entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemyMemeBundle:Meme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MemyMemeBundle:Meme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Meme entity.
    *
    * @param Meme $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Meme $entity)
    {
        $form = $this->createForm(new MemeType(), $entity, array(
            'action' => $this->generateUrl('_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Meme entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemyMemeBundle:Meme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_edit', array('id' => $id)));
        }

        return $this->render('MemyMemeBundle:Meme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Meme entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MemyMemeBundle:Meme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meme entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl(''));
    }

    /**
     * Creates a form to delete a Meme entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
