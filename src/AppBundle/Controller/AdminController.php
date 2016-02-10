<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use AppBundle\Form\Type\RegistrationSostenedorFormType;
use AppBundle\Form\Type\EstadoType;
use Symfony\Component\HttpFoundation\Request;
use \AppBundle\Entity\Estado;

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
        return $this->render(
                        'admin/sostenedores.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/sostenedor/{id}", defaults={"id" = "new"} , name="sostenedor")
     */
    public function nuevoSostenedorAction($id, Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = ($id === "new" ? $userManager->createUser() : $userManager->findUserBy(array('id' => $id)));
        $form = $this->createForm(RegistrationSostenedorFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($id === "new") {
                $user->setEnabled(true);
            }
            $userManager->updateUser($user, true);
            $this->addFlash('notice', 'Your changes were saved!');
            return $this->redirectToRoute('sostenedores');
        }

        return $this->render('admin/form_sostenedor.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/editar_sostenedor/{id}", name="editar sostenedor")
     */
    public function editarSostenedorAction($id, Request $request) {
        return $this->render(
                        'admin/form_sostenedor.html.twig', array(
                    'op' => "modificacion",
                    'nombre' => "asd",
                    'tipo_de_institucion' => "asd",
                    'email' => "asd",
                    'usuario' => "asd",
                    'contraseña' => "asd",
                    'ciudad' => "asd",
                    'comuna' => "asd",
                    'direccion' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_sostenedor/{id}", name="ver sostenedor")
     */
    public function verSostenedorAction($id, Request $request) {
        return $this->render(
                        'admin/form_sostenedor.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd",
                    'tipo_de_institucion' => "asd",
                    'email' => "asd",
                    'usuario' => "asd",
                    'contraseña' => "asd",
                    'ciudad' => "asd",
                    'comuna' => "asd",
                    'direccion' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/directores/", name="directores")
     */
    public function directoresAction(Request $request) {
        return $this->render(
                        'admin/directores.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/nuevo_director/", name="nuevo director")
     */
    public function nuevoDirectorAction(Request $request) {
        return $this->render(
                        'admin/form_director.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/editar_director/{id}", name="editar director")
     */
    public function editarDirectorAction($id, Request $request) {
        return $this->render(
                        'admin/form_director.html.twig', array(
                    'op' => "modificacion",
                    'sostenedor' => "asd",
                    'nombre' => "asd",
                    'tipo_de_escuela' => "asd",
                    'escuela' => "asd",
                    'usuario' => "asd",
                    'contraseña' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_director/{id}", name="ver director")
     */
    public function verDirectorAction($id, Request $request) {
        return $this->render(
                        'admin/form_director.html.twig', array(
                    'op' => "vista",
                    'sostenedor' => "asd",
                    'nombre' => "asd",
                    'tipo_de_escuela' => "asd",
                    'escuela' => "asd",
                    'usuario' => "asd",
                    'contraseña' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/miembros/", name="miembros")
     */
    public function miembrosAction(Request $request) {
        return $this->render(
                        'admin/miembros.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/nuevo_miembro/", name="nuevo miembro")
     */
    public function nuevoMiembroAction(Request $request) {
        return $this->render(
                        'admin/form_miembro.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/editar_miembro/{id}", name="editar miembro")
     */
    public function editarMiembroAction($id, Request $request) {
        return $this->render(
                        'admin/form_miembro.html.twig', array(
                    'op' => "modificacion",
                    'director' => "asd",
                    'nombre' => "asd",
                    'usuario' => "asd",
                    'contraseña' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_miembro/{id}", name="ver miembro")
     */
    public function verMiembroAction($id, Request $request) {
        return $this->render(
                        'admin/form_miembro.html.twig', array(
                    'op' => "vista",
                    'director' => "asd",
                    'nombre' => "asd",
                    'usuario' => "asd",
                    'contraseña' => "asd"
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($estado);
            $em->flush();
            $this->addFlash('notice', 'flash.success.cambio');
            return $this->redirectToRoute('rubricas');
        }

        return $this->render('admin/estados/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/rubrica/{id}", name="editar rubrica")
     */
    public function editarRubricaAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $estado = $em->getRepository('AppBundle:Estado')->find($id);
        if (!$estado) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('notice', 'flash.success.cambio');
            return $this->redirectToRoute('rubricas');
        }
        return $this->render('admin/estados/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_rubrica/", name="ver rubrica")
     */
    public function verRubricaAction(Request $request) {
        return $this->render(
                        'admin/form_rubrica.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/tipos_de_institucion/", name="tipos de institucion")
     */
    public function tiposDeInstitucionAction(Request $request) {
        return $this->render(
                        'admin/tipos_de_institucion.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/nuevo_tipo_institucion/", name="nuevo tipo de institucion")
     */
    public function nuevoTipoInstitucionAction(Request $request) {
        return $this->render(
                        'admin/form_tipo_institucion.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/editar_tipo_institucion/", name="editar tipo de institucion")
     */
    public function editarTipoInstitucionAction(Request $request) {
        return $this->render(
                        'admin/form_tipo_institucion.html.twig', array(
                    'op' => "modificacion",
                    'nombre' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_tipo_institucion/", name="ver tipo de institucion")
     */
    public function verTipoInstitucionAction(Request $request) {
        return $this->render(
                        'admin/form_tipo_institucion.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ciudades/", name="ciudades")
     */
    public function ciudadesAction(Request $request) {
        return $this->render(
                        'admin/ciudades.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/nueva_ciudad/", name="nueva ciudad")
     */
    public function nuevaCiudadAction(Request $request) {
        return $this->render(
                        'admin/form_ciudad.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/editar_ciudad/", name="editar ciudad")
     */
    public function editarCiudadAction(Request $request) {
        return $this->render(
                        'admin/form_ciudad.html.twig', array(
                    'op' => "modificacion",
                    'nombre' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_ciudad/", name="ver ciudad")
     */
    public function verCiudadAction(Request $request) {
        return $this->render(
                        'admin/form_ciudad.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/comunas/", name="comunas")
     */
    public function comunasAction(Request $request) {
        return $this->render(
                        'admin/comunas.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/nueva_comuna/", name="nueva comuna")
     */
    public function nuevaComunaAction(Request $request) {
        return $this->render(
                        'admin/form_comuna.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/editar_comuna/", name="editar comuna")
     */
    public function editarComunaAction(Request $request) {
        return $this->render(
                        'admin/form_comuna.html.twig', array(
                    'op' => "modificacion",
                    'nombre' => "asd",
                    'ciudad' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_comuna/", name="ver comuna")
     */
    public function verComunaAction(Request $request) {
        return $this->render(
                        'admin/form_comuna.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd",
                    'ciudad' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/escuelas/", name="escuelas")
     */
    public function escuelasAction(Request $request) {
        return $this->render(
                        'admin/escuelas.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/nueva_escuela/", name="nueva escuela")
     */
    public function nuevaEscuelaAction(Request $request) {
        return $this->render(
                        'admin/form_escuela.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/editar_escuela/", name="editar escuela")
     */
    public function editarEscuelaAction(Request $request) {
        return $this->render(
                        'admin/form_escuela.html.twig', array(
                    'op' => "modificacion",
                    'nombre' => "asd",
                    'comuna' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_escuela/", name="ver escuela")
     */
    public function verEscuelaAction(Request $request) {
        return $this->render(
                        'admin/form_escuela.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd",
                    'comuna' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/areas/", name="areas")
     */
    public function areasAction(Request $request) {
        return $this->render(
                        'admin/areas/areas.html.twig', array('params' => 1)
        );
    }

    /**
     * @Route("/admin/area/", name="nueva area")
     */
    public function nuevaAreaAction(Request $request) {
        return $this->render(
                        'admin/areas/form_area.html.twig', array('op' => "alta")
        );
    }

    /**
     * @Route("/admin/area/{id}", name="editar area")
     */
    public function editarAreaAction($id, Request $request) {
        return $this->render(
                        'admin/areas/form_area.html.twig', array(
                    'op' => "modificacion",
                    'nombre' => "asd"
                        )
        );
    }

    /**
     * @Route("/admin/ver_area/", name="ver area")
     */
    public function verAreaAction(Request $request) {
        return $this->render(
                        'admin/areas/form_area.html.twig', array(
                    'op' => "vista",
                    'nombre' => "asd"
                        )
        );
    }

    private function _obtenerUserManager($class) {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass($class);
        return $this->container->get('pugx_user_manager');
    }

}
