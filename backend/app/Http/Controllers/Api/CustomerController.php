<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomerController extends Controller
{
    /**
     * Zwraca wszystkich klientów.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CustomerResource::collection(Customer::paginate());
    }

    /**
     * Zwraca jednego klienta.
     * @param $id
     * @return CustomerResource
     */
    public function show($id): CustomerResource
    {
        return new CustomerResource(Customer::findOrFail($id));
    }
}
