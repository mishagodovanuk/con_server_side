<?php

namespace App\Http\Controllers;

use App\Factories\TableModelFactory;
use App\Http\Resources\TableCollectionResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller
{
    private $factory;

    public function __construct(TableModelFactory $factory)
    {
        $this->factory = $factory;
    }

    public function create(Request $request)
    {
        $request = $request->all();
        $model = $request['model'];
        unset($request['model']);
        if (!is_callable([$this->factory, $model])) {
            // Throw an exception or call some other action, e.g. $this->default()
            throw new Exception('Model not Exist');
        }

        $this->factory->$model()->create($request);

        return response('OK', Response::HTTP_CREATED);
    }

    public function update(Request $request, $model, $id)
    {
        $request = $request->all();
        if (!is_callable([$this->factory, $model])) {
            // Throw an exception or call some other action, e.g. $this->default()
            throw new Exception('Model not Exist');
        }
        $this->factory->$model()->find($id)->update($request);

        return response('OK', Response::HTTP_NO_CONTENT);
    }

    public function delete($model, $id)
    {
        $this->factory->$model()?->find($id)?->delete();

        return response('OK');
    }

    public function index($model)
    {
        return TableCollectionResource::collection($this->factory->$model()::paginate(15));
    }
}
