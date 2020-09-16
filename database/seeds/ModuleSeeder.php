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
        Module::create(// 1
            [
                'name' => 'Configuración',
                'route' => '/configurations',
                'icon' => 'vsm-icon fa fa-cogs  icon-gradient bg-heavy-rain',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( // 2
            [
                'name' => 'Ubicación',
                'route' => '/configurations/locations',
                'icon' => 'vsm-icon fa fa-map-signs icon-gradient bg-heavy-rain',
                'class' => '',
                'module_id' => 1,
                'abstract'=> true
            ]
        );

        Module::create( //3
            [
                'name' => 'País',
                'route' => '/configurations/locations/country',
                'icon' => 'vsm-icon fa fa-map  icon-gradient bg-sunny-morning',
                'class' => '',
                'module_id' => 2,
            ]
        );

        Module::create( //4
            [
                'name' => 'Departamentos',
                'route' => '/configurations/locations/departments',
                'icon' => 'vsm-icon fa fa-road icon-gradient bg-sunny-morning',
                'class' => '',
                'module_id' => 2,
            ]
        );
        Module::create( //5
            [
                'name' => 'Ciudades',
                'route' => '/configurations/locations/cities',
                'icon' => 'vsm-icon fa fa-map-o icon-gradient bg-sunny-morning',
                'class' => '',
                'module_id' => 2,
            ]
        );

        Module::create( //6
            [
                'name' => 'Localidades',
                'route' => '/configurations/locations/localities',
                'icon' => 'vsm-icon fa fa-map-pin icon-gradient bg-sunny-morning',
                'class' => '',
                'module_id' => 2,
            ]
        );

        Module::create( // 7
            [
                'name' => 'Documentos',
                'route' => '/configurations/documents',
                'icon' => 'vsm-icon fa fa-clipboard icon-gradient bg-heavy-rain',
                'class' => '',
                'module_id' => 1,
                'abstract'=> true
            ]
        );

        Module::create( //8
            [
                'name' => 'Documentos de identificación ',
                'route' => '/configurations/documents/identificationDocuments',
                'icon' => 'vsm-icon lnr-file-add icon-gradient bg-warm-flame',
                'class' => '',
                'module_id' => 7,
            ]
        );
        Module::create( //9
            [
                'name' => 'Tipos de documentos',
                'route' => '/configurations/documents/typesDocuments',
                'icon' => 'vsm-icon lnr-file-empty icon-gradient bg-warm-flame',
                'class' => '',
                'module_id' => 7,
            ]
        );

        Module::create( //10
            [
                'name' => 'Niveles académicos',
                'route' => '/configurations/documents/academicLevels',
                'icon' => 'vsm-icon lnr-book icon-gradient bg-warm-flame',
                'class' => '',
                'module_id' => 7,
            ]
        );
        Module::create( // 11
            [
                'name' => 'General',
                'route' => '/configurations/general',
                'icon' => 'vsm-icon fa fa-cog icon-gradient bg-heavy-rain',
                'class' => '',
                'module_id' => 1,
                'abstract'=> true
            ]
        );
        Module::create( // 12
            [
                'name' => 'Ocupaciones',
                'route' => '/configurations/general/occupations',
                'icon' => 'vsm-icon fa fa-grav icon-gradient bg-love-kiss',
                'class' => '',
                'module_id' => 11,
            ]
        );




        Module::create( //13 -> 1
            [
                'name' => 'Lugares',
                'route' => '/places',
                'icon' => 'dashboard',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //14 -> 2
            [
                'name' => 'Gestion de barrios',
                'route' => '/places/neighborhoods',
                'icon' => 'vsm-icon fa fa-map-marker icon-gradient bg-happy-itmeo',
                'class' => '',
                'module_id' => 13,
            ]
        );

        Module::create( //15 _> 3
            [
                'name' => 'Gestion de Sedes',
                'route' => '/places/headquarters',
                'icon' => 'vsm-icon fa fa-fort-awesome icon-gradient bg-happy-itmeo',
                'class' => '',
                'module_id' => 13,
            ]
        );

        Module::create( //16 -> 4
            [
                'name' => 'Personas',
                'route' => '/people',
                'icon' => 'dashboard',
                'class' => '',
                'module_id' => null,
            ]
        );

        Module::create( //17 -> 5
            [
                'name' => 'Gestion de Estudiantes',
                'route' => '/people/students',
                'icon' => 'vsm-icon fa fa-graduation-cap icon-gradient bg-deep-blue',
                'class' => '',
                'module_id' => 16,
            ]
        );
        Module::create( //18 -> 6
            [
                'name' => 'Gestion de voluntarios',
                'route' => '/people/voluntaries',
                'icon' => 'vsm-icon fa fa-users icon-gradient bg-deep-blue',
                'class' => '',
                'module_id' => 16,
            ]
        );

        Module::create( //19 - > 7
            [
                'name' => 'Asignaturas',
                'route' => '/subject',
                'icon' => 'vsm-icon fa fa-book icon-gradient bg-happy-fisher',
                'class' => '',
                'module_id' => null,
            ]
        );

        Module::create( //20 -> 8
            [
                'name' => 'Inscripciones',
                'route' => '/enrollments',
                'icon' => 'vsm-icon fa fa-id-card icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );

        Module::create( //21 -> 9
            [
                'name' => 'Gestion de Cortes',
                'route' => '/enrollments/cuts',
                'icon' => 'vsm-icon fa fa-th icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 20,
            ]
        );
        Module::create( //22 -> 10
            [
                'name' => 'Gestion de Semestres',
                'route' => '/enrollments/semester',
                'icon' => 'vsm-icon fa fa-th-list icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 20,
            ]
        );
        Module::create( //23 - > 11
            [
                'name' => 'Gestion de Grados',
                'route' => '/enrollments/grade',
                'icon' => 'vsm-icon fa fa-th-large icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 20,
            ]
        );
        Module::create( //24 - > 12
            [
                'name' => 'Gestion de Matrículas',
                'route' => '/enrollments/enrolled',
                'icon' => 'vsm-icon fa fa-id-card icon-gradient bg-grow-early',
                'class' => '',
                'module_id' => 20,
            ]
        );
        Module::create( //25 - > 13
            [
                'name' => 'Grupos',
                'route' => '/groups',
                'icon' => 'vsm-icon fa fa-slideshare icon-gradient bg-sunny-morning',
                'class' => '',
                'module_id' => null,
            ]
        );
        Module::create( //26 - > 14
            [
                'name' => 'Notas',
                'route' => '/notes',
                'icon' => 'dashboard',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //27 -> 15
            [
                'name' => 'Registrar notas',
                'route' => '/notes/create',
                'icon' => 'vsm-icon fa fa-pencil-square-o icon-gradient bg-happy-fisher',
                'class' => '',
                'module_id' => 26,
            ]
        );
        Module::create( //28 - > 16
            [
                'name' => 'Actualizar notas',
                'route' => '/notes/update',
                'icon' => 'vsm-icon fa fa-pencil-square icon-gradient bg-happy-fisher',
                'class' => '',
                'module_id' => 26,
            ]
        );
        Module::create( //29 -> 17
            [
                'name' => 'Seguridad',
                'route' => '/security',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //30 -> 18
            [
                'name' => 'Usuarios',
                'route' => '/security/users',
                'icon' => 'vsm-icon fa fa-key icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 29,
            ]
        );
        Module::create( //31 -> 19
            [
                'name' => 'Perfiles',
                'route' => '/security/profiles',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 29,
            ]
        );
        Module::create( //32 -> 20
            [
                'name' => 'Informes',
                'route' => '/export',
                'icon' => 'vsm-icon fa fa-files-o icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => null,
                'abstract'=> true
            ]
        );
        Module::create( //33 -> 21
            [
                'name' => 'Informe de personas',//Informe de estudiantes
                'route' => '/export/student',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 32,            ]
        );
        Module::create( //34 -> 22
            [
                'name' => 'Informe de grupos',//Informe de estudiantes
                'route' => '/export/group',
                'icon' => 'vsm-icon fa fa-unlock-alt icon-gradient bg-arielle-smile',
                'class' => '',
                'module_id' => 32,
            ]
        );
      
        

    }
}
