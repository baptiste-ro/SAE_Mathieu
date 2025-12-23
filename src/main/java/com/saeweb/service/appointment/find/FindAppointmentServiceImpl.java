package com.saeweb.service.appointment.find;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.database.entity.appointment.AppointmentID;
import com.saeweb.database.repository.appointment.AppointmentRepository;
import com.saeweb.dto.appointment.AppointmentAnswer;
import com.saeweb.dto.appointment.NbAppointment;
import com.saeweb.dto.date.Month;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;

@Service
public class FindAppointmentServiceImpl implements FindAppointmentService {

    @Autowired
    private AppointmentRepository repository;

    @Override
    public List<Appointment> findAppointmentByDate(LocalDate date) {
        return repository.findByAppointmentDate(date);
    }

    @Override
    public Appointment findAppointmentByDateAndTime(AppointmentID id) {
        return repository.findById(id).get();
    }

    @Override
    public AppointmentAnswer findNbAppointmentByMonth(Month month) {
        List<NbAppointment> li =  repository.findAppointmentByMonth(month.getCurrent(), month.getNext());
        return new AppointmentAnswer(li, li.isEmpty());
    }
}
