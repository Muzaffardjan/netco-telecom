<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 14:06
 */
declare(strict_types=1);

namespace App\Http\Controllers;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
