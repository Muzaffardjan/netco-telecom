<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 20:48
 */
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

class ProductController extends AbstractAdminController
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
