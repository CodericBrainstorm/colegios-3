<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use AppBundle\Form\Type\SostenedorType;
use AppBundle\Form\Type\DirectorType;
use AppBundle\Form\Type\MiembroType;
use AppBundle\Form\Type\EstadoType;
use AppBundle\Form\Type\AreaType;
use AppBundle\Form\Type\ColegioType;
use AppBundle\Form\Type\TipoColegioType;
use AppBundle\Form\Type\TipoInstitucionType;
use AppBundle\Form\Type\CiudadType;
use AppBundle\Form\Type\ComunaType;
use AppBundle\Entity\Estado;
use AppBundle\Entity\Area;
use AppBundle\Entity\Colegio;
use AppBundle\Entity\TipoColegio;
use AppBundle\Entity\TipoInstitucion;
use AppBundle\Entity\Ciudad;
use AppBundle\Entity\Comuna;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class AdminController extends Controller {

    /**
     * @Route("/admin/index/")
     */
    public function indexAction(Request $request) {
        return $this->render(
                        'admin/index.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/sostenedores/", name="sostenedores")
     */
    public function sostenedoresAction(Request $request) {
        $sostenedores = $this->getDoctrine()->getRepository('AppBundle:Sostenedor')->findAll();
        return $this->render(
                        'admin/sostenedores/list.html.twig', array('sostenedores' => $sostenedores)
        );
    }

    /**
     * @Route("/admin/sostenedor/", name="nuevo sostenedor")
     */
    public function nuevoSostenedorAction(Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = $userManager->createUser();

        $form = $this->createForm(SostenedorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('sostenedores');
        }
        return $this->render('admin/sostenedores/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/sostenedor/{id}", name="editar sostenedor")
     */
    public function editarSostenedorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(SostenedorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('sostenedores');
        }

        return $this->render('admin/sostenedores/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_sostenedor/{id}", name="ver sostenedor")
     */
    public function verSostenedorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = $userManager->findUserBy(array('id' => $id));
        return $this->render(
                        'admin/sostenedores/form.html.twig', array('op' => "vista",
                    'sostenedor' => $user
                        )
        );
    }

    /**
     * @Route("/admin/directores/", name="directores")
     */
    public function directoresAction(Request $request) {
        $directores = $this->getDoctrine()->getRepository('AppBundle:Director')->findAll();
        return $this->render(
                        'admin/directores/list.html.twig', array('directores' => $directores)
        );
    }

    /**
     * @Route("/admin/director/", name="nuevo director")
     */
    public function nuevoDirectorAction(Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->createUser();

        $form = $this->createForm(DirectorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores');
        }
        return $this->render('admin/directores/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/director/{id}", name="editar director")
     */
    public function editarDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(DirectorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores');
        }

        return $this->render('admin/directores/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_director/{id}", name="ver director")
     */
    public function verDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        return $this->render(
                        'admin/directores/form.html.twig', array('op' => "vista",
                    'director' => $user
                        )
        );
    }

    /**
     * @Route("/admin/miembros/", name="miembros")
     */
    public function miembrosAction(Request $request) {
        $miembros = $this->getDoctrine()->getRepository('AppBundle:Miembro')->findAll();
        return $this->render(
                        'admin/miembros/list.html.twig', array('miembros' => $miembros)
        );
    }

    /**
     * @Route("/admin/miembro/", name="nuevo miembro")
     */
    public function nuevoMiembroAction(Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->createUser();

        $form = $this->createForm(MiembroType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('miembros');
        }
        return $this->render('admin/miembros/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/miembro/{id}", name="editar miembro")
     */
    public function editarMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(MiembroType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('miembros');
        }

        return $this->render('admin/miembros/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_miembro/{id}", name="ver miembro")
     */
    public function verMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
        return $this->render(
                        'admin/miembros/form.html.twig', array('op' => "vista",
                    'miembro' => $user
                        )
        );
    }

    /**
     * @Route("/admin/rubricas/", name="rubricas")
     */
    public function rubricasAction(Request $request) {
        $estados = $this->getDoctrine()->getRepository('AppBundle:Estado')->findAll();
        return $this->render(
                        'admin/estados/list.html.twig', array('estados' => $estados)
        );
    }

    /**
     * @Route("/admin/rubrica/", name="nueva rubrica")
     */
    public function nuevaRubricaAction(Request $request) {
        $estado = new Estado();
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($estado);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('rubricas');
        }

        return $this->render('admin/estados/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/rubrica/{id}", name="editar rubrica")
     */
    public function editarRubricaAction($id, Request $request) {
        $estado = $this->_getObject('AppBundle:Estado', $id);
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('rubricas');
        }
        return $this->render('admin/estados/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_rubrica/{id}", name="ver rubrica")
     */
    public function verRubricaAction($id, Request $request) {
        $estado = $this->_getObject('AppBundle:Estado', $id);
        return $this->render(
                        'admin/estados/form.html.twig', array(
                    'op' => "vista",
                    'estado' => $estado
                        )
        );
    }

    /**
     * @Route("/admin/tipo_colegios/", name="tipo_colegios")
     */
    public function tipoColegiosAction(Request $request) {
        $tipoColegios = $this->getDoctrine()->getRepository('AppBundle:TipoColegio')->findAll();
        return $this->render(
                        'admin/tipo_colegios/list.html.twig', array('tipo_colegios' => $tipoColegios)
        );
    }

    /**
     * @Route("/admin/tipo_colegio/", name="nuevo tipo_colegio")
     */
    public function nuevoTipoColegioAction(Request $request) {
        $tipoColegio = new TipoColegio();
        $form = $this->createForm(TipoColegioType::class, $tipoColegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($tipoColegio);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_colegios');
        }

        return $this->render('admin/tipo_colegios/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/tipo_colegio/{id}", name="editar tipo_colegio")
     */
    public function editarTipoColegioAction($id, Request $request) {
        $tipoColegio = $this->_getObject('AppBundle:TipoColegio', $id);
        $form = $this->createForm(TipoColegioType::class, $tipoColegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_colegios');
        }
        return $this->render('admin/tipo_colegios/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_tipo_colegio/{id}", name="ver tipo_colegio")
     */
    public function verTipoColegioAction($id, Request $request) {
        $tipoColegio = $this->_getObject('AppBundle:TipoColegio', $id);
        return $this->render(
                        'admin/tipo_colegios/form.html.twig', array(
                    'op' => "vista",
                    'tipo_colegio' => $tipoColegio
                        )
        );
    }

    /**
     * @Route("/admin/tipos_de_institucion/", name="tipo_instituciones")
     */
    public function tiposDeInstitucionAction(Request $request) {
        $tipoInstituciones = $this->getDoctrine()->getRepository('AppBundle:TipoInstitucion')->findAll();
        return $this->render(
                        'admin/tipo_instituciones/list.html.twig', array('tipo_instituciones' => $tipoInstituciones)
        );
    }

    /**
     * @Route("/admin/institucion/", name="nuevo tipo de institucion")
     */
    public function nuevoTipoInstitucionAction(Request $request) {
        $tipoInstitucion = new TipoInstitucion();
        $form = $this->createForm(TipoInstitucionType::class, $tipoInstitucion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($tipoInstitucion);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_instituciones');
        }

        return $this->render('admin/tipo_instituciones/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/institucion/{id}", name="editar tipo de institucion")
     */
    public function editarTipoInstitucionAction($id, Request $request) {
        $tipoInstitucion = $this->_getObject('AppBundle:TipoInstitucion', $id);
        $form = $this->createForm(TipoInstitucionType::class, $tipoInstitucion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_instituciones');
        }
        return $this->render('admin/tipo_instituciones/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_tipo_institucion/{id}", name="ver tipo de institucion")
     */
    public function verTipoInstitucionAction($id, Request $request) {
        $tipoInstitucion = $this->_getObject('AppBundle:TipoInstitucion', $id);
        return $this->render(
                        'admin/tipo_instituciones/form.html.twig', array(
                    'op' => "vista",
                    'tipo_institucion' => $tipoInstitucion
                        )
        );
    }

    /**
     * @Route("/admin/ciudades/", name="ciudades")
     */
    public function ciudadesAction(Request $request) {
        $ciudades = $this->getDoctrine()->getRepository('AppBundle:Ciudad')->findAll();
        return $this->render(
                        'admin/ciudades/list.html.twig', array('ciudades' => $ciudades)
        );
    }

    /**
     * @Route("/admin/ciudad/", name="nueva ciudad")
     */
    public function nuevaCiudadAction(Request $request) {
        $ciudad = new Ciudad();
        $form = $this->createForm(CiudadType::class, $ciudad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($ciudad);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('ciudades');
        }

        return $this->render('admin/ciudades/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ciudad/{id}", name="editar ciudad")
     */
    public function editarCiudadAction($id, Request $request) {
        $ciudad = $this->_getObject('AppBundle:Ciudad', $id);
        $form = $this->createForm(CiudadType::class, $ciudad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('ciudades');
        }
        return $this->render('admin/ciudades/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_ciudad/{id}", name="ver ciudad")
     */
    public function verCiudadAction($id, Request $request) {
        $ciudad = $this->_getObject('AppBundle:Ciudad', $id);
        return $this->render(
                        'admin/ciudades/form.html.twig', array(
                    'op' => "vista",
                    'ciudad' => $ciudad
                        )
        );
    }

    /**
     * @Route("/admin/comunas/", name="comunas")
     */
    public function comunasAction(Request $request) {
        $comunas = $this->getDoctrine()->getRepository('AppBundle:Comuna')->findAll();
        return $this->render(
                        'admin/comunas/list.html.twig', array('comunas' => $comunas)
        );
    }

    /**
     * @Route("/admin/comuna/", name="nueva comuna")
     */
    public function nuevaComunaAction(Request $request) {
        $comuna = new Comuna();
        $form = $this->createForm(ComunaType::class, $comuna);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($comuna);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('comunas');
        }

        return $this->render('admin/comunas/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/comuna/{id}", name="editar comuna")
     */
    public function editarComunaAction($id, Request $request) {
        $comuna = $this->_getObject('AppBundle:Comuna', $id);
        $form = $this->createForm(ComunaType::class, $comuna);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('comunas');
        }
        return $this->render('admin/comunas/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_comuna/{id}", name="ver comuna")
     */
    public function verComunaAction($id, Request $request) {
        $comuna = $this->_getObject('AppBundle:Comuna', $id);
        return $this->render(
                        'admin/comuna/form.html.twig', array(
                    'op' => "vista",
                    'comuna' => $comuna
                        )
        );
    }

    /**
     * @Route("/admin/colegios/", name="colegios")
     */
    public function colegiosAction(Request $request) {
        $colegios = $this->getDoctrine()->getRepository('AppBundle:Colegio')->findAll();
        return $this->render(
                        'admin/colegios/list.html.twig', array('colegios' => $colegios)
        );
    }

    /**
     * @Route("/admin/colegio/", name="nuevo colegio")
     */
    public function nuevoColegioAction(Request $request) {
        $colegio = new Colegio();
        $form = $this->createForm(ColegioType::class, $colegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($colegio);
            $this->addFlash('notice', 'flash.success.cambio');
            return $this->redirectToRoute('colegios');
        }
        return $this->render('admin/colegios/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/colegio/{id}", name="editar colegio")
     */
    public function editarColegioAction($id, Request $request) {
        $colegio = $this->_getObject('AppBundle:Colegio', $id);
        $form = $this->createForm(ColegioType::class, $colegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('colegios');
        }
        return $this->render('admin/colegios/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_colegio/{id}", name="ver colegio")
     */
    public function verColegioAction($id, Request $request) {
        $colegio = $this->_getObject('AppBundle:Colegio', $id);
        return $this->render(
                        'admin/form.html.twig', array(
                    'op' => "vista",
                    'colegio' => $colegio
                        )
        );
    }

    /**
     * @Route("/admin/areas/", name="areas")
     */
    public function areasAction(Request $request) {
        $areas = $this->getDoctrine()->getRepository('AppBundle:Area')->findAll();
        return $this->render(
                        'admin/areas/list.html.twig', array('areas' => $areas)
        );
    }

    /**
     * @Route("/admin/area/", name="nueva area")
     */
    public function nuevaAreaAction(Request $request) {
        $area = new Area();
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($area);
            $this->addFlash('notice', 'flash.success.cambio');
            return $this->redirectToRoute('areas');
        }
        return $this->render('admin/areas/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/area/{id}", name="editar area")
     */
    public function editarAreaAction($id, Request $request) {
        $area = $this->_getObject('AppBundle:Area', $id);
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('areas');
        }
        return $this->render('admin/areas/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_area/{id}", name="ver area")
     */
    public function verAreaAction($id, Request $request) {
        $area = $this->_getObject('AppBundle:Area', $id);
        return $this->render(
                        'admin/areas/form.html.twig', array(
                    'op' => "vista",
                    'area' => $area
                        )
        );
    }

    private function _obtenerUserManager($class) {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass($class);
        return $this->container->get('pugx_user_manager');
    }

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
