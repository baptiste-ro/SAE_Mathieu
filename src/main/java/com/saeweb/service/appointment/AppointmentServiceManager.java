package com.saeweb.service.appointment;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.dto.appointment.AppointmentAnswer;

public interface AppointmentServiceManager {
    AppointmentAnswer saveAppointment(Appointment appointment);
}
