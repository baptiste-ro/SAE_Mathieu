package com.saeweb.controller.appointment;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.dto.appointment.AppointmentAnswer;
import com.saeweb.dto.date.Month;
import com.saeweb.service.appointment.AppointmentServiceManagerImpl;
import com.saeweb.service.appointment.find.FindAppointmentServiceImpl;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.time.LocalDate;

@RestController
@RequestMapping("/appointment")
public class AppointmentController {

    @Autowired
    private AppointmentServiceManagerImpl appointmentService;

    @Autowired
    private FindAppointmentServiceImpl findAppointmentService;

    @PostMapping("/add-appointment")
    public AppointmentAnswer addAppointment(@RequestBody @Valid Appointment appointment) {
        return appointmentService.saveAppointment(appointment);
    }

    @PostMapping("/get-appointment-count")
    public AppointmentAnswer getAppointmentAnswer(@RequestBody String date) {
        String[] split = date.split("-");
        return findAppointmentService.findNbAppointmentByMonth(new Month(LocalDate.parse(split[0] + "-" + (split[1].length() == 1 ? "0" + split[1] : split[1]) + "-01")));
    }
}