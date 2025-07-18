<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Specialization::class);
        $specializations = Specialization::paginate(10);
        return view('dashboard.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Specialization::class);
        $specialization = new Specialization();
        $specialization->is_active = 1;
        $users = User::where('role', 'reviewer')->get();
        return view('dashboard.specializations.create', compact('specialization', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Specialization::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'hierarchies' => 'nullable|array|min:1',
            'hierarchies.*.role_name' => 'nullable|string|max:255',
            'hierarchies.*.order_sequence' => 'nullable|integer|min:1',
            'hierarchies.*.user_id' => 'nullable|exists:users,id',
        ]);

        DB::transaction(function () use ($request) {
            $specialization = Specialization::create([
                'name' => $request->name,
                'is_active' => $request->is_active ?? true,
            ]);

            if($request->has('hierarchies')){
                foreach ($request->hierarchies as $item) {
                    $specialization->approvalHierarchies()->create($item);
                    $user = User::find($item['user_id']);
                    $user->specialization_id = $specialization->id;
                    $user->save();
                }
            }
        });
        return redirect()->route('dashboard.specializations.index')->with('success', 'تم إضافة التخصص');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialization $specialization)
    {
        $this->authorize('view', Specialization::class);
        return view('dashboard.specializations.show', compact('specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update', Specialization::class);
        $btn_label = "تعديل";
        $specialization = Specialization::with('approvalHierarchies')->findOrFail($id);
        $users = User::where('role', 'reviewer')->get();
        return view('dashboard.specializations.edit', compact('specialization', 'btn_label', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialization $specialization)
    {
        $this->authorize('update', Specialization::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'hierarchies' => 'nullable|array|min:1',
            'hierarchies.*.role_name' => 'nullable|string|max:255',
            'hierarchies.*.order_sequence' => 'nullable|integer|min:1',
            'hierarchies.*.user_id' => 'nullable|exists:users,id',
        ]);
        DB::transaction(function () use ($request, $specialization) {
            $specialization->update($request->all());
            $specialization->approvalHierarchies()->delete();
            if($request->has('hierarchies')){
                foreach ($request->hierarchies as $item) {
                    $specialization->approvalHierarchies()->create($item);
                    $user = User::find($item['user_id']);
                    $user->specialization_id = $specialization->id;
                    $user->save();
                }
            }
        });
        return redirect()->route('dashboard.specializations.index')->with('success', 'تم تحديث التخصص');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        $this->authorize('delete', Specialization::class);
        $specialization->delete();
        return redirect()->route('dashboard.specializations.index')->with('success', 'تم حذف التخصص');
    }
}
