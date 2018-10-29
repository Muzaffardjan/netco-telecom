<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 28.10.2018 / 1:09
 */
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends AbstractAdminController
{
    /**
     * @var Manufacturer
     */
    protected $model;

    /**
     * ManufacturerController constructor.
     * @param Manufacturer $model
     */
    public function __construct(Manufacturer $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $manufacturers = $this->model->getAll();

        return view(
            'admin.manufacturer.index',
            [
                'manufacturers' => $manufacturers,
            ]
        );
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'required' => 'Barcha maydonlar to\'ldirilishi shart',
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validator($request->all())->validate();

            $this->model->saveData($request);

            return redirect()->route('admin.manufacturers', ['locale' => app()->getLocale()]);
        }

        return view('admin.manufacturer.create');
    }

    public function edit(Request $request)
    {
        $manufacturer = $this->model->getById($request->route('id'));

        return view(
            'admin.manufacturer.edit',
            [
                'manufacturer' => $manufacturer,
            ]
        );
    }
}
