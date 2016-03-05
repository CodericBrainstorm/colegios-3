<?php

namespace AppBundle\Controller\Utils;

trait DBUsersUtilsTrait {

    private function _listarUsersByClass($class, $nombre, $template) {
        $userManager = $this->_obtenerSimpleUserManager();
        $users = $userManager->findUsersByClass($class);
        return $this->render($template, array($nombre => $users));
    }

    private function _listarUsersByOwn($method, $nombre, $template) {
        $user = $this->getUser();
        $users = $user->$method();
        return $this->render($template, array($nombre => $users));
    }

    private function _listarUsersByParent($id, $method, $nombre, $parent_name, $template) {
        $userManager = $this->_obtenerSimpleUserManager();
        $parent = $userManager->findUserBy(array('id' => $id));
        $users = $parent->$method();
        return $this->render($template, array($nombre => $users, $parent_name => $parent));
    }

    private function _verUser($request, $id, $class, $type, $title, $formOpt = array()) {
        $user = $this->_obtenerUser($class, $id, 'view');
        $formOpt['disabled'] = true;
        $formOpt['attr'] = array('class' => 'view_form');
        $form = $this->createForm($type, $user, $formOpt);
        $form->remove('plainPassword');
        $form->handleRequest($request);
        return $this->_renderViewTemplate(array('title' => $title . '.views.ver.title', 'form' => $form->createView()));
    }

    private function _crearUser($request, $class, $type, $redirect, $title, $formOpt = array(), $redirect_params = array()) {
        $user = $this->_createUser($class);
        return $this->_generarFormUser($request, $class, $user, $type, $redirect, $title, $formOpt, 'new', $redirect_params);
    }

    private function _crearUserWithAssign($request, $class, $type, $redirect, $title, $assigned_obj, $assign, $formOpt = array(), $redirect_params = array()) {
        $user = $this->_createUser($class);
        $user->$assign($assigned_obj);
        return $this->_generarFormUser($request, $class, $user, $type, $redirect, $title, $formOpt, 'new', $redirect_params);
    }

    private function _editarUser($request, $id, $class, $type, $redirect, $title, $formOpt = array(), $redirect_params = array()) {
        $user = $this->_obtenerUser($class, $id, 'edit');
        return $this->_generarFormUser($request, $class, $user, $type, $redirect, $title, $formOpt, 'edit', $redirect_params);
    }

    private function _generarFormUser($request, $class, $user, $type, $redirect, $title, $formOpt, $title2, $redirect_params = array()) {
        $form = $this->createForm($type, $user, $formOpt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager = $this->_obtenerUserManager($class);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute($redirect, $redirect_params);
        }
        return $this->_renderFormTemplate(array('title' => $title . '.views.' . $title2 . '.title', 'form' => $form->createView()));
    }

    private function _createUser($class) {
        $ano = $this->getUser()->getAno();
        $userManager = $this->_obtenerUserManager($class);
        $user = $userManager->createUser();
        $user->setAno($ano);
        $user->setEnabled(true);
        return $user;
    }

    private function _obtenerUser($class, $id, $action) {
        $userManager = $this->_obtenerUserManager($class);
        $user = $userManager->findUserBy(array('id' => $id));
        $this->denyAccessUnlessGranted($action, $user);
        return $user;
    }

    private function _obtenerUserManager($class) {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass($class);
        return $this->_obtenerSimpleUserManager();
    }

    private function _obtenerSimpleUserManager() {
        return $this->container->get('my_pugx_user_manager');
    }

}
