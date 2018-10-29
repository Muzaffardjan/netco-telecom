<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 13:49
 */
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends AbstractAdminController
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
