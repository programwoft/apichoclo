<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait{

    /*-------------------------------------------------
    Para extraer datos de las realciones
    -------------------------------------------------*/
    public function scopeIncluded(Builder $query){

        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

    $realtions = explode(',', request('included')); //['posts','relation2']
    $allowIncluded = collect($this->allowIncluded);

    foreach ($realtions as $key => $relationship){
            if (!$allowIncluded->contains($relationship)) {
                unset($realtions[$key]);
            }
    }

    $query->with($realtions);
    }

    /*-------------------------------------------------
    Para extraer datos por filtros
    -------------------------------------------------*/
    public function scopeFilter(Builder $query){
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%'.$value.'%');
            }
        }

    }

    /*-------------------------------------------------
    Para ordanar los datos
    -------------------------------------------------*/
    public function scopeSort(Builder $query){
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {

            $direccion = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direccion='desc';

                $sortField = substr($sortField, 1);
            }            

            if ( $allowSort->contains($sortField) ) {
                $query->orderBy($sortField, $direccion);
            }
        }

    }

    /*-------------------------------------------------
    Para extraer datos paginados
    -------------------------------------------------*/
    public function scopeGetOrPaginate(Builder $query){

        if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }
        return $query->get();
    }




}