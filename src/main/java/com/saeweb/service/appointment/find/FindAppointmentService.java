package com.saeweb.service.appointment.find;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.database.entity.appointment.AppointmentID;
import com.saeweb.dto.appointment.AppointmentAnswer;
import com.saeweb.dto.date.Month;

import java.time.LocalDate;
import java.util.List;

public interface FindAppointmentService {
    List<Appointment> findAppointmentByDate(LocalDate date);
    Appointment findAppointmentByDateAndTime(AppointmentID id);
    AppointmentAnswer findNbAppointmentByMonth(Month month);
}
