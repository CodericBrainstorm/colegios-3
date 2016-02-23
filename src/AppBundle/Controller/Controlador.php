<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Controlador extends Controller {

    public $form_template = 'base_form.html.twig';
    public $view_template = 'base_view.html.twig';

    protected function _renderFormTemplate($options) {
        return $this->render($this->form_template, $options);
    }

    protected function _renderViewTemplate($options) {
        return $this->render($this->view_template, $options);
    }

}
