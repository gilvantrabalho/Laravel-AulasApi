<?php

namespace App\Repositories;

use App\Models\Cars;

class CarsRepository
{
    public function create($car)
    {
        $car = new Cars($car);
        $car->save();
        return $car;
    }

    public function show($id)
    {
        return Cars::findOrFail($id);
    }

    public function read()
    {
        return Cars::paginate(2);
    }
}
