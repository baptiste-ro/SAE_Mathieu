package com.saeweb.service.appointment.save;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.dto.date.Month;

public interface SaveAppointmentService {
    public Month saveAppointment(Appointment appointment);
}
