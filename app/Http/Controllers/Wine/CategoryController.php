<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function __construct(private readonly CategoryRepositoryInterface $repository)
    {}


    public function index()
    {
        return view('wine.category.index', [
            'categories' => $this->repository->paginate(
                counts: ['wines'],
            )
        ]);
    }

    public function create(): View
    {
        return view('wine.category.create', [
        'category' => $this->repository->model(),
        'action' => route('categories.store'),
        'method' => 'POST',
        'submit' => 'Crear',
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated()); //nos pasa los datos validados//
        session()->flash('success', 'Categoría creada con éxito');
        return redirect()->route('categories.index');
    }

    public function edit(Category $category): View
    {
        return view('wine.category.edit', [
            'category' => $category,
            'action' => route('categories.update', $category),
            'method' => 'PUT',
            'submit' => 'Actualizar',
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse //va asociado por asi decirlo al metodo update//
    {
        $this->repository->update($request->validated(), $category); //nos pasa los datos validados y la categoría//
        session()->flash('success', 'Categoría actualizada con éxito');
        return redirect()->route('categories.index');
    }
}
