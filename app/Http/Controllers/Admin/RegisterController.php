<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 16:15
 */
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class RegisterController extends AbstractAdminController
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

        }

        return view('admin.auth.register');
    }
}
