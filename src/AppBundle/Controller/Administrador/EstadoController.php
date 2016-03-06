<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Estado;
use AppBundle\Form\Type\EstadoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class EstadoController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/rubricas/", name="rubricas")
     */
    public function rubricasAction(Request $request) {
        return $this->_listarObjects('AppBundle:Estado', 'estados', 'admin/estados/list.html.twig', array('borrado'=>false));
    }

    /**
     * @Route("/admin/rubrica/", name="nueva rubrica")
     */
    public function nuevaRubricaAction(Request $request) {
        return $this->_crearObject($request, Estado::class, EstadoType::class, 'rubricas', "estado", false);
    }
    
    /**
     * @Route("/admin/rubrica_predefinida/{id}", name="predefinir rubrica")
     */
    public function predefinirRubricaAction($id, Request $request) {
        $config = $this->_getObject('AppBundle:Config', 1);
        $config->setEstadoPredefinido($this->_getObject('AppBundle:Estado', $id));
        $this->_persistObject($config);
        return $this->redirectToRoute('rubricas');
    }

    /**
     * @Route("/admin/rubrica/{id}", name="editar rubrica")
     */
    public function editarRubricaAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Estado', EstadoType::class, 'rubricas', 'estado');
    }

    /**
     * @Route("/admin/ver_rubrica/{id}", name="ver rubrica")
     */
    public function verRubricaAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Estado', EstadoType::class, 'estado');
    }

    /**
     * @Route("/admin/eliminar_rubrica/{id}", name="eliminar rubrica")
     */
    public function eliminarRubricaAction($id, Request $request) {
        return $this->_borrarObjectByMethod('AppBundle:Estado', $id, 'borrar', 'rubricas');
    }
}
