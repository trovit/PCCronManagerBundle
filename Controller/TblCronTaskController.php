<?php

namespace Trovit\CronManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Exception\CommandNotExistsException;
use Trovit\CronManagerBundle\Form\TblCronTaskType;

/**
 * TblCronTask controller.
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
class TblCronTaskController extends Controller
{

    /**
     * Lists all TblCronTask entities.
     *
     */
    public function indexAction()
    {
        $crons = $this->get('trovit.cron_manager.read_cron_task')->getAllCronTasks();

        return $this->render('TrovitCronManagerBundle:TblCronTask:index.html.twig', array(
            'crons' => $crons,
        ));
    }

    /**
     * Creates a new TblCronTask entity.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws CommandNotExistsException
     */
    public function createAction(Request $request)
    {
        $cron = new TblCronTask();
        $form = $this->createCreateForm($cron);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('trovit.cron_manager.create_cron_task')->persistCron($cron);

            return $this->redirect($this->generateUrl('tblcrontask_show', array('id' => $cron->getId())));
        }

        return $this->render('TrovitCronManagerBundle:TblCronTask:new.html.twig', array(
            'cron'   => $cron,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TblCronTask entity.
     *
     * @param TblCronTask $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TblCronTask $entity)
    {
        $form = $this->createForm(new TblCronTaskType(), $entity, array(
            'action' => $this->generateUrl('tblcrontask_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TblCronTask entity.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $cron = new TblCronTask();
        $form   = $this->createCreateForm($cron);

        return $this->render('TrovitCronManagerBundle:TblCronTask:new.html.twig', array(
            'cron'   => $cron,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TblCronTask entity.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $cron = $this->get('trovit.cron_manager.read_cron_task')->getCronById($id);

        if (!$cron) {
            throw $this->createNotFoundException('Unable to find TblCronTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TrovitCronManagerBundle:TblCronTask:show.html.twig', array(
            'cron'        => $cron,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TblCronTask entity.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $cron = $this->get('trovit.cron_manager.read_cron_task')->getCronById($id);

        if (!$cron) {
            throw $this->createNotFoundException('Unable to find TblCronTask entity.');
        }

        $editForm = $this->createEditForm($cron);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TrovitCronManagerBundle:TblCronTask:edit.html.twig', array(
            'cron'        => $cron,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TblCronTask entity.
    *
    * @param TblCronTask $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TblCronTask $entity)
    {
        $form = $this->createForm(new TblCronTaskType(), $entity, array(
            'action' => $this->generateUrl('tblcrontask_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing TblCronTask entity.
     *
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws CommandNotExistsException
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $cron = $em->getRepository('TrovitCronManagerBundle:TblCronTask')->find($id);

        if (!$cron) {
            throw $this->createNotFoundException('Unable to find TblCronTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($cron);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if (!$this->get('trovit.cron_manager.command_validator')->commandExists($cron->getCommand())) {
                throw new CommandNotExistsException($cron->getCommand());
            }
            $em->flush();

            return $this->redirect($this->generateUrl('tblcrontask_edit', array('id' => $id)));
        }

        return $this->render('TrovitCronManagerBundle:TblCronTask:edit.html.twig', array(
            'cron'        => $cron,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TblCronTask entity.
     *
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $cron = $this->get('trovit.cron_manager.read_cron_task')->getCronById($id);

            if (!$cron) {
                throw $this->createNotFoundException('Unable to find TblCronTask entity.');
            }

            $this->get('trovit.cron_manager.delete_cron_task')->delete($cron);
        }

        return $this->redirect($this->generateUrl('tblcrontask'));
    }

    /**
     * Creates a form to delete a TblCronTask entity by id.
     *
     * @param int $id
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tblcrontask_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
