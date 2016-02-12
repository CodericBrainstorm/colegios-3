<?php

namespace AppBundle\Controller\Utils;

trait DBGeneralUtilsTrait {

    private $form_template = 'base_form.html.twig';
    private $view_template = 'base_view.html.twig';

    private function _persistObject($obj) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($obj);
        $em->flush();
    }

    private function _getObject($class, $id) {
        $em = $this->getDoctrine()->getManager();
        $obj = $em->getRepository($class)->find($id);
        if (!$obj) {
            throw $this->createNotFoundException('No ' . $obj . ' found for id ' . $id);
        }
        return $obj;
    }

    private function _updateObject() {
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

}
