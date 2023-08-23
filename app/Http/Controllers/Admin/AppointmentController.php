<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\CreateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $appointments = Appointment::query()
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create(): View
    {
        return view('admin.appointments.create');
    }

    public function store(CreateAppointmentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Appointment::query()->create([
            'name'=> $data['name'] ,
            'email'=> $data['email'] ,
            'phone'=> $data['phone'] ,
            'status' => $data['status'],
            'appointment_at' => $data['appointment_at'],
            'notes' => $data['notes'],
        ]);

        toast('Đặt lịch thành công', 'success');

        return redirect('appointments');
    }

    public function edit(string $id): View
    {
        $appointment = Appointment::getAppointmentById($id);
        return view('admin.appointments.edit', compact('appointment'));
    }

    public function update(UpdateAppointmentRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $appointment = Appointment::getAppointmentById($id);

        $appointment->update([
            'name'=> $data['name'] ,
            'email'=> $data['email'] ,
            'phone'=> $data['phone'] ,
            'status' => $data['status'],
            'appointment_at' => $data['appointment_at'],
            'notes' => $data['notes'],
        ]);

        toast('Cập nhật '.$appointment->name.'thành công ', 'success');

        return redirect('appointments');
    }

    public function destroy(string $id): RedirectResponse
    {
        $appointment = Appointment::getAppointmentById($id);

        $appointment->delete();

        toast('Xóa '.$appointment->name. 'thành công ', 'success');

        return redirect('appointments');
    }
}
