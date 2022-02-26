<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cars\CarsCollection;
use App\Http\Resources\Cars\CarsResource;
use App\Models\Cars;
use App\Repositories\CarsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    private $carsRepository;

    public function __construct(CarsRepository $carsRepository)
    {
        $this->carsRepository = $carsRepository;
    }

    public function index()
    {
        return new CarsCollection(
            $this->carsRepository->read()
        );
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'plate' => 'required',
                'age' => 'required',
                'color' => 'required'
            ], [
                'required' => ':attribute é um valor obrigatório!'
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $create = $this->carsRepository->create($request->only([
                'name', 'plate', 'age', 'color'
            ]));

            if (!$create) {
                throw new \Exception([
                    'error' => true,
                    'response' => 'Erro. Carro não cadastrado!'
                ]);
            }

            return new CarsResource($create);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        return new CarsResource(
            $this->carsRepository->show($id)
        );
    }

    public function update(Request $request, Cars $cars)
    {
        //CRUD create, read, update, delete
    }

    public function destroy(Cars $cars)
    {
        //
    }
}
