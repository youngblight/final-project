<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User Deleted Successfully');
    }
    public function toggleBlock($id)
   {
    $user = User::findOrFail($id);
    $user->is_blocked = !$user->is_blocked;
    $user->save();

    $status = $user->is_blocked ? 'Ameblokiwa' : 'Amecomfirmed kufunguliwa';
     return back()->with('success', "Mtumiaji {$status} kikamilifu!");
    }
  }