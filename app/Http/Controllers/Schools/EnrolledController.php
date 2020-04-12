<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\Enrolled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\People\{People};

class EnrolledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrolleds = Enrolled::all()->where('enabled', '1');
        return $this->showAll($enrolleds);
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
            return ($this->errorResponse('El estudiante ya se encuentra matrículado para el semestre indicado', 422));
        }

        $validator = Validator::make($request->all(), [
            'people_id' => 'required',
            'headquarter_id' => 'required',
            'cost' => 'required',
            'semester_id' => 'required',
            'grade_id' => 'required'
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $enrolled = new Enrolled();
            DB::beginTransaction();
            $enrolled->create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($enrolled, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\Enrolled  $enrolled
     * @return \Illuminate\Http\Response
     */
    public function show(Enrolled $enrolled)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Enrolled  $enrolled
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrolled $enrolled)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Enrolled  $enrolled
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrolled $enrolled)
    {
        try {
            if ($enrolled->people_id != $request['people_id'] || $enrolled->semester_id != $request['semester_id']) {
                $valid = $this->SpecialValidation($request);
                if ($valid['exist']) {
                    return ($this->errorResponse('El estudiante ya se encuentra matrículado para el semestre indicado', 422));
                }
            }
            DB::beginTransaction();
            $enrolled->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($enrolled, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Enrolled  $enrolled
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrolled $enrolled)
    {
        try {
            $enrolled->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($enrolled, 200));
    }

    /**
     * Para el listar de los matrículas
     */
    public function dataTable(Request $request)
    {
        $enrolleds = Enrolled::with('people', 'headquarter', 'semester', 'grade')
            ->orWhereHas('people', function ($query) use ($request) {
                return $query->where('names', 'like', '%' . $request->term . '%');
            })
            ->orWhereHas('headquarter', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->orWhereHas('semester', function ($query) use ($request) {
                return $query->where('code', 'like', '%' . $request->term . '%');
            })
            ->orWhereHas('grade', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($enrolleds);
    }

    /**
     * 
     */
    public function dependences()
    {
        $controllers = [
            'Schools\HeadquarterController' => ['headquarters', 'index'],
            'Schools\SemesterController' => ['semesters', 'index'],
            'MasterTables\GradeController' => ['grades', 'index'],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }

    /**
     * 
     */
    public function getStudent(Request $request)
    {

        $people = People::with('typeDocument', 'town', 'gender', 'neighborhood', 'occupation', 'typePeople')
            ->where('type_people_id', 1)->where('enabled', 1);
        $people->where('document_number', 'like', '%' . $request->term . '%');
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
            $enrolled = Enrolled::where('people_id', $request['people_id'])->where('semester_id', $request['semester_id'])->first();
            if ($enrolled) {
                $validate['exist'] = true;
                return $validate;
            }
            $validate['exist'] = false;
            return $validate;
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
    }
}
