<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ApiExceptionTrait
{
    /**
     * Verifica si la excepcion es arrojada por
     * no haber encontrado el modelo
     *
     * @param Request $request
     * @param Exceptions $e
     * @return void
     */
    public function apiException($request, $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
            'error' => 'Entry for '.str_replace('App\\', '', $e->getModel()).' not found'], 404);
        }

        return parent::render($request, $e);
    }
}
