<?php

namespace App\Http\Controllers;

use App\Http\Requests\WineRequest;
use App\Models\Wine;
use App\Repositories\Wine\WineRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WineController extends Controller
{

    public function __construct(private readonly WineRepositoryInterface $repository)
    {}

    public function index(): View {
        return view('wine.index', [
            'wines' => $this->repository->paginate(
                relationships: ['category'], //cargamos las relaciones con la categoria para mostrarlas en la vista//
            ),                           //esto es debido a que cada vino tiene una categoria asociada//
        ]);
    }

    public function create(): View
    {
        return view('wine.create', [
            'wine' => $this->repository->model(),
            'action' => route('wines.store'),
            'method' => 'POST',
           'submit' => 'Crear',
        ]);
    }

    public function store(WineRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        session()->flash('success', 'Vino añadido con éxito');

        return redirect()->route('wines.index');
    }


    public function edit(Wine $wine): View //muestra el formulario para editar un vino//
    {
        return view('wine.edit', [
            'wine' => $wine,
            'action' => route('wines.update', $wine),
            'method' => 'PUT',
           'submit' => 'Actualizar',
        ]);
    }

    public function update(WineRequest $request, Wine $wine): RedirectResponse //procesa los nuevos datos del formulario//
    {
        $this->repository->update($request->validated(), $wine);

        session()->flash('success', 'Vino actualizado con éxito');

        return redirect()->route('wines.index');
    }

    public function destroy(Wine $wine): RedirectResponse
    {
        try {
            $this->repository->delete($wine);
            session()->flash('success', 'Vino eliminado con éxito');
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
        return redirect()->route('wines.index');
    }

}
