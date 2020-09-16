<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\{Group, Enrolled, Subject, ScheduleDay};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\People\{People};

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
        if($type){
            $groups = Group::with('semester')->get();
        }else{
            $groups = Group::all()->where('enabled', '1');
        }
        return $this->showAll($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $valid = $this->SpecialValidation($request, 'store');
        if ($valid['exist']) {
            return ($this->errorResponse('El grupo ya se encuentra creado para el semestre indicado', 422));
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'headquarter_id' => 'required',
            'semester_id' => 'required'
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $group = new Group();
            DB::beginTransaction();
            $group->create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($group, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        try {
            if ($group->name != $request['name'] || $group->semester_id != $request['semester_id']) {
                $valid = $this->SpecialValidation($request, 'store');
                if ($valid['exist']) {
                    return ($this->errorResponse('El grupo ya se encuentra creado para el semestre indicado', 422));
                }
            }
            DB::beginTransaction();
            $group->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($group, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        try {
            $group->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($group, 200));
    }

    /**
     * Para el listar de los matrículas
     */
    public function dataTable(Request $request)
    {
        $groups = Group::with('people', 'headquarter', 'semester')
            ->orWhereHas('people', function ($query) use ($request) {
                return $query->where('names', 'like', '%' . $request->term . '%');
            })
            ->orWhereHas('headquarter', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->orWhereHas('semester', function ($query) use ($request) {
                return $query->where('code', 'like', '%' . $request->term . '%');
            })
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($groups);
    }

    /**
     * 
     */
    public function dependences()
    {
        $controllers = [
            'Schools\HeadquarterController' => ['headquarters', 'index'],
            'Schools\SemesterController' => ['semesters', 'index'],
            'Schools\DayController' => ['days', 'index'],
            'Schools\HourController' => ['hours', 'index'],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }


    /**
     * 
     */
    public function getTeacher(Request $request)
    {

        $people = People::with('typeDocument', 'town', 'gender', 'neighborhood', 'occupation', 'typePeople')
            ->whereIn('type_people_id', [3,4, 5,6,7,8,9])->where('enabled', 1);
            $people->where(function ($query) use ($request) {
                $query->where('names', 'like', '%' . $request->term . '%')
                ->orWhere('surnames', 'like', '%' . $request->term . '%')
                    ->orWhere('document_number', 'like', '%' . $request->term . '%')
                    ->orWhere('phone', 'like', '%' . $request->term . '%')
                    ->orWhere('cell', 'like', '%' . $request->term . '%')
                    ->orWhere('email', 'like', '%' . $request->term . '%')
                    ->orWhere('address_residence', 'like', '%' . $request->term . '%')
                    ->orWhere('rh', 'like', '%' . $request->term . '%')
                    ->orWhere('eps', 'like', '%' . $request->term . '%')
                    ->orWhere('history', 'like', '%' . $request->term . '%');
            });
        $Query = $people->paginate($request->limit)
            ->toArray();
        return $Query;
    }


    /**
     * Se encarga de validar que ya no este registrado la unidad de medida. 
     */
    public function SpecialValidation($request = null, $tipo = null)
    {
        try {
            $group = Group::where('semester_id', $request['semester_id'])->where('name', 'like', '%' . $request['name'] . '%')->first();
            if ($group) {
                $validate['exist'] = true;
                return $validate;
            }
            $validate['exist'] = false;
            return $validate;
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
    }

    /**
     * ///////////////////// Estudiantes /////////////////////////
     */

    /**
     * Obtiene la lista de los estudiantes pertenecientes al grupo
     */
    public function groupStudentList(Request $request, $id)
    {
        $studentList = Group::with('enrolleds.people')->where('id', $id)
            ->first();
        return  $studentList;
    }

    /**
     * Remove el alumno del grupo
     */
    public function removeStudent(Request $request, $id)
    {
        try {
            $group = Group::find($id);
            $group->enrolleds()->detach($request['enrolled_id']);
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($group, 200));
    }

    /**
     * Muestra la lista de estudiantes matriculas en el mismo semestre y que aun no hacen 
     * parte del grupo
     */
    public function studentList(Request $request, $id)
    {
        $Query = Enrolled::with('people')
            ->where('enabled', 1)
            ->where('semester_id', $request['semester_id']);
        if (count($request->get('enrolleds'))) {
            foreach ($request->get('enrolleds') as $enrolled_id) {
                $Query->where('id', '<>', $enrolled_id);
            }
        }
        $enrolleds =  $Query->get();
        return  $enrolleds;
    }


    /**
     * Asigna los estudiantes selecionado sl grupo indicado
     */
    public function assignStudentsGroup(Request $request)
    {

        try {
            DB::beginTransaction();
            $group = Group::find($request['group_id']);
            $group->enrolleds()->attach(Array_values($request->get('students')));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($group, 200));
    }

    /**
     * ///////////////////// Asignaturas /////////////////////////
     */

    /**
     * Obtiene la lista de asignatura pertenecientes al grupo
     */
    public function subjectStudentList(Request $request, $id)
    {
        $studentList = Group::with('subjects')->where('id', $id)
            ->first();
        return  $studentList;
    }

    /**
     * Remove la asignatura del grupo
     */
    public function removeSubject(Request $request, $id)
    {
        try {
            $group = Group::find($id);
            $group->subjects()->detach($request['subject_id']);
        } catch (Exception $e) {
            return ($this->errorResponse('No se pudo realizar la operación', 422));
        }
        return ($this->successResponse($group, 200));
    }

    /**
     * Muestra la lista de asignaturas   que aun no hacen 
     * parte del grupo
     */
    public function subjectList(Request $request)
    {
        $Query = Subject::where('enabled', 1);
        if (count($request->get('subjects'))) {
            foreach ($request->get('subjects') as $subjects_id) {
                $Query->where('id', '<>', $subjects_id);
            }
        }
        $subjects =  $Query->get();
        return  $subjects;
    }


    /**
     * Asigna las asignatuas selecionado sl grupo indicado
     */
    public function assignSubjectsGroup(Request $request)
    {

        try {
            DB::beginTransaction();
            $group = Group::find($request['group_id']);
            $group->subjects()->attach(Array_values($request->get('subjects')));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($group, 200));
    }

    /**
     * ///////////////////// Horario ////////////
     */

     /**
     * Obtiene la lista de los estudiantes pertenecientes al grupo
     */
    public function groupScheduleList(Request $request, $id)
    {
        $studentList = Group::with('scheduleDays.scheduleHours.hour', 'scheduleDays.day','scheduleDays.scheduleHours.subject','scheduleDays.scheduleHours.people','scheduleDays.scheduleHours.headquarter')->where('id', $id)
            ->first();
        return  $studentList;
    }

     /**
     * Obtiene la lista de los maestros que  pertenecientes a la asignatura
     */
    public function getSubjectTeacher(Request $request, $id)
    {
        $subjects = Subject::with('people')->where('id', $id)
            ->first();
        return  $subjects;
    }


      /**
     * 
     */
    public function dependencesExport()
    {
        $controllers = [
            'Schools\SemesterController' => ['semesters', 'index',2],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
