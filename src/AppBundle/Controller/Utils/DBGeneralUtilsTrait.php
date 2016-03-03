<?php

namespace AppBundle\Controller\Utils;

trait DBGeneralUtilsTrait {

    private function _listarObjects($class, $nombre, $template, $query = null) {
        if (is_null($query)) {
            return $this->_listarObjectsByMethod($class, $nombre, $template, "findAll");
        } else {
            return $this->_listarObjectsByMethod($class, $nombre, $template, "findBy", $query);
        }
    }
    
    private function _listarObjectsByMethod($class, $nombre, $template, $method, $params = null){
        if(is_null($params)){
            $objects = $this->getDoctrine()->getRepository($class)->$method();
        }else{
            $objects = $this->getDoctrine()->getRepository($class)->$method($params);
        }
        return $this->render($template, array($nombre => $objects));
    }

    private function _verObject($request, $id, $class, $type, $title, $formOpt = array()) {
        $object = $this->_getObject($class, $id);
        $this->denyAccessUnlessGranted('view', $object);
        $formOpt['disabled'] = true;
        $formOpt['attr'] = array('class' => 'view_form');
        $form = $this->createForm($type, $object, $formOpt);
        $form->handleRequest($request);
        return $this->_renderViewTemplate(array('title' => $title . '.views.ver.title', 'form' => $form->createView()));
    }

    private function _editarObject($request, $id, $class, $type, $redirect, $title, $formOpt = array()) {
        $object = $this->_getObject($class, $id);
        return $this->_generarFormObject($request, $object, $type, $redirect, $title, $formOpt, 'edit');
    }

    private function _crearObject($request, $class, $type, $redirect, $title, $ano = true, $formOpt = array()) {
        $object = new $class;
        if ($ano) {
            $object->setAno($this->getUser()->getAno());
        }
        return $this->_generarFormObject($request, $object, $type, $redirect, $title, $formOpt, 'new');
    }

    private function _generarFormObject($request, $object, $type, $redirect, $title, $formOpt, $title2) {
        $form = $this->createForm($type, $object, $formOpt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($object);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute($redirect);
        }
        return $this->_renderFormTemplate(array('title' => $title . '.views.' . $title2 . '.title', 'form' => $form->createView()));
    }

    private function _persistObject($obj = false) {
        $em = $this->getDoctrine()->getManager();
        if (is_null($obj->getId())) {
            $em->persist($obj);
        }
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
    
    private function _borrarObject($class, $id, $redirect){
        $obj = $this->_getObject($class, $id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($obj);
        $em->flush();
        return $this->redirectToRoute($redirect);
    }
    
    private function _borrarObjectByMethod($class, $id, $method, $redirect){
        $obj = $this->_getObject($class, $id);
        $obj->$method();
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute($redirect);
    }
}
