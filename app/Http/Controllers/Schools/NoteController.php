<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\{Note, Group, Subject, Enrolled,NoteCompetition};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all()->where('enabled', '1');
        return $this->showAll($notes);
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
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'subject_id' => 'required',
            'subject_name' => 'required',
            'group_id' => 'required',
            'group_name' => 'required',
            'enrolled_id' => 'required',
            'people_id' => 'required',
            'semester_id' => 'required',
            'cut_id' => 'required'
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $note = new Note();
            DB::beginTransaction();
            $note = $note->create($request->all());
            if(count($request->input('competencies'))){
                foreach($request->input('competencies') as $competencie){
                    $note->noteCompetitions()->create($competencie);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($note, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'subject_id' => 'required',
            'subject_name' => 'required',
            'group_id' => 'required',
            'group_name' => 'required',
            'enrolled_id' => 'required',
            'people_id' => 'required',
            'semester_id' => 'required',
            'cut_id' => 'required'
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            DB::beginTransaction();
            $note = $note->update($request->all());
            if(count($request->input('competencies'))){
                foreach($request->input('competencies') as $competencie){
                    $noteCompetition = NoteCompetition::find($competencie['id']);
                    if($noteCompetition){
                      $noteCompetition->update($competencie);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($note, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        try {
            DB::beginTransaction();
            $note->noteCompetitions()->delete();
            $note->delete();
            DB::commit();
          } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage(), 422));
          }
          return ($this->successResponse($note, 200));
    }

    /**
     * 
     */
    public function dependences()
    {
        $controllers = [
            'Schools\SemesterController' => ['semesters', 'index', 1],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }

    /**
     * COnsulta los grupos mediante el id del semestres y el id del profesor asignado
     * en el horario
     */

    public function getGroupTeacher(Request $request)
    {
        $groups = Group::with('semester', 'people', 'scheduleDays.scheduleHours.people')
            ->where('semester_id', $request['semester_id'])
            ->whereHas('scheduleDays.scheduleHours', function ($query) use ($request) {
                return $query->where('people_id', $request['people_id']);
            })
            ->get();
        return $groups;
    }

    /**
     * Consulta las materias asignadas al grupo del semestre 
     * a las cuales el profesor dicta clase
     */
    public function getSubjectTeacher(Request $request)
    {
        $subjects = Subject::with('scheduleHours.scheduleDay.group', 'competencies')
            ->whereHas('scheduleHours', function ($query) use ($request) {
                return $query->where('people_id', $request['people_id']);
            })
            ->whereHas('scheduleHours.scheduleDay.group', function ($query) use ($request) {
                return $query->where('id', $request['group_id'])->where('semester_id', $request['semester_id']);
            })
            ->get();
        return $subjects;
    }

    /**
     * Busca los estudiantes del grupo que ya no tengan una calificación
     */
    public function getPeopleGroupNote(Request $request)
    {
        $enrolleds = Enrolled::with('people', 'notes', 'groups')
            ->whereHas('groups', function ($query) use ($request) {
                return $query->where('groups.id', $request['group_id'])->where('groups.semester_id', $request['semester_id']);
            })
            ->whereDoesntHave('notes', function ($query) use ($request) {
                return $query->where('subject_id', $request['subject_id'])
                    ->where('cut_id', $request['cut_id']);
            })
            ->get();
        return  $enrolleds;
    }

      /**
     * Busca los estudiantes del grupo que ya tengan calificación
     */
    public function getPeopleGroupNoteUpdate(Request $request)
    {
        $enrolleds = Enrolled::with('people', 'notes.noteCompetitions', 'groups')
            ->whereHas('groups', function ($query) use ($request) {
                return $query->where('groups.id', $request['group_id'])->where('groups.semester_id', $request['semester_id']);
            })
            ->whereHas('notes', function ($query) use ($request) {
                return $query->where('subject_id', $request['subject_id'])
                    ->where('cut_id', $request['cut_id']);
            })
            ->get();
        return  $enrolleds;
    }

}
