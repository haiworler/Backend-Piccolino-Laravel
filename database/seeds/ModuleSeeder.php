<?php

use Illuminate\Database\Seeder;
use App\Models\Security\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create( //1
            [
                'name' => 'Lugares',
                'route' => '/places',
                'icon' => 'dashboard',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //2
            [
                'name' => 'Gestion de barrios',
                'route' => '/places/neighborhoods',
                'icon' => 'vsm-icon fa fa-map-marker icon-gradient bg-happy-itmeo',
                'class' => '',
                'module_id' => 1,
            ]
        );

        Module::create( //3
            [
                'name' => 'Gestion de Sedes',
                'route' => '/places/headquarters',
                'icon' => 'vsm-icon fa fa-fort-awesome icon-gradient bg-happy-itmeo',
                'class' => '',
                'module_id' => 1,
            ]
        );

        Module::create( //4
            [
                'name' => 'Personas',
                'route' => '/people',
                'icon' => 'dashboard',
                'class' => '',
                'module_id' => null,
            ]
        );

        Module::create( //5
            [
                'name' => 'Gestion de Estudiantes',
                'route' => '/people/students',
                'icon' => 'vsm-icon fa fa-user icon-gradient bg-deep-blue',
                'class' => '',
                'module_id' => 4,
            ]
        );
        Module::create( //6
            [
                'name' => 'Gestion de voluntarios',
                'route' => '/people/voluntaries',
                'icon' => 'vsm-icon fa fa-user-secret icon-gradient bg-deep-blue',
                'class' => '',
                'module_id' => 4,
            ]
        );

        Module::create( //7
            [
                'name' => 'Asignaturas',
                'route' => '/subject',
                'icon' => 'vsm-icon fa fa-book icon-gradient bg-happy-fisher',
                'class' => '',
                'module_id' => null,
            ]
        );

        Module::create( //8
            [
                'name' => 'Inscripciones',
                'route' => '/enrollments',
                'icon' => 'vsm-icon fa fa-id-card icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );

        Module::create( //9
            [
                'name' => 'Gestion de Cortes',
                'route' => '/enrollments/cuts',
                'icon' => 'vsm-icon fa fa-th icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 8,
            ]
        );
        Module::create( //10
            [
                'name' => 'Gestion de Semestres',
                'route' => '/enrollments/semester',
                'icon' => 'vsm-icon fa fa-th-list icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 8,
            ]
        );
        Module::create( //11
            [
                'name' => 'Gestion de Grados',
                'route' => '/enrollments/grade',
                'icon' => 'vsm-icon fa fa-th-large icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 8,
            ]
        );
        Module::create( //12
            [
                'name' => 'Gestion de Matrículas',
                'route' => '/enrollments/enrolled',
                'icon' => 'vsm-icon fa fa-id-card icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 8,
            ]
        );
        Module::create( //13
            [
                'name' => 'Grupos',
                'route' => '/groups',
                'icon' => 'vsm-icon fa fa-slideshare icon-gradient bg-sunny-morning',
                'class' => '',
                'module_id' => null,
            ]
        );
        Module::create( //14
            [
                'name' => 'Notas',
                'route' => '/notes',
                'icon' => 'dashboard',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //15
            [
                'name' => 'Registrar notas',
                'route' => '/notes/create',
                'icon' => 'vsm-icon fa fa-pencil-square-o icon-gradient bg-happy-fisher',
                'class' => '',
                'module_id' => 14,
            ]
        );
        Module::create( //16
            [
                'name' => 'Actualizar notas',
                'route' => '/notes/update',
                'icon' => 'vsm-icon fa fa-pencil-square icon-gradient bg-happy-fisher',
                'class' => '',
                'module_id' => 14,
            ]
        );
        Module::create( //17
            [
                'name' => 'Seguridad',
                'route' => '/security',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //18
            [
                'name' => 'Usuarios',
                'route' => '/security/users',
                'icon' => 'vsm-icon fa fa-key icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 17,
            ]
        );
        Module::create( //19
            [
                'name' => 'Perfiles',
                'route' => '/security/profiles',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 17,
            ]
        );
        Module::create( //20
            [
                'name' => 'Informes',
                'route' => '/export',
                'icon' => 'vsm-icon fa fa-files-o icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //21
            [
                'name' => 'Informe de personas',//Informe de estudiantes
                'route' => '/export/student',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 20,            ]
        );
        Module::create( //22
            [
                'name' => 'Informe de grupos',//Informe de estudiantes
                'route' => '/export/group',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 20,
            ]
        );
      
        

    }
}
