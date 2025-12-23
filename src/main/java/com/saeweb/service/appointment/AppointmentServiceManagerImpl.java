package com.saeweb.service.appointment;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.dto.appointment.AppointmentAnswer;
import com.saeweb.dto.date.Month;
import com.saeweb.service.appointment.find.FindAppointmentServiceImpl;
import com.saeweb.service.appointment.save.SaveAppointmentServiceImpl;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class AppointmentServiceManagerImpl implements AppointmentServiceManager{

    @Autowired
    private SaveAppointmentServiceImpl saveAppointmentService;

    @Autowired
    private FindAppointmentServiceImpl findAppointmentService;

    @Override
    public AppointmentAnswer saveAppointment(Appointment appointment) {
        Month saveResult = saveAppointmentService.saveAppointment(appointment);
        return findAppointmentService.findNbAppointmentByMonth(saveResult);
    }
}
