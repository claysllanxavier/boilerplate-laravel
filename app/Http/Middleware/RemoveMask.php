<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\ParameterBag;

class RemoveMask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isJson()) {
            $this->clean($request->json());
        } else {
            $this->clean($request->request);
        }

        return $next($request);
    }

    /**
     * Clean the request's data by removing mask from phonenumber.
     *
     * @param  \Symfony\Component\HttpFoundation\ParameterBag  $bag
     * @return void
     */
    private function clean(ParameterBag $bag)
    {
        $bag->replace($this->cleanData($bag->all()));
    }

    /**
     * Check the parameters and clean the number
     *
     * @param  array  $data
     * @return array
     */
    private function cleanData(array $data)
    {
        return collect($data)->map(function ($value, $key) {
            switch ($key) {
                case 'phone':
                case 'zip_code':
                case 'cpf':
                case 'username':
                    return removeMask($value);
                    break;

                default:
                    return $value;
                    break;
            }
        })->all();
    }

}
