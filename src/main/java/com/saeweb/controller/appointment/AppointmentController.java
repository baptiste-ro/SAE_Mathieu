package com.saeweb.controller.appointment;

import com.fasterxml.jackson.databind.JsonNode;
import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.database.entity.appointment.AppointmentID;
import com.saeweb.database.entity.users.Users;
import com.saeweb.database.repository.appointment.AppointmentRepository;
import com.saeweb.database.repository.user.UsersRepository;
import com.saeweb.dto.appointment.AppointmentAnswer;
import com.saeweb.dto.date.Month;
import com.saeweb.service.appointment.AppointmentServiceManagerImpl;
import com.saeweb.service.appointment.find.FindAppointmentServiceImpl;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.List;

@RestController
@RequestMapping("/appointment")
public class AppointmentController {

    @Autowired
    private AppointmentServiceManagerImpl appointmentService;

    @Autowired
    private FindAppointmentServiceImpl findAppointmentService;

    @Autowired
    private UsersRepository usersRepository;

    @Autowired
    private AppointmentRepository appointmentRepository;

    @PostMapping("/add-appointment")
    public AppointmentAnswer addAppointment(@RequestBody @Valid JsonNode node) {
        Appointment appointment = new Appointment();
        appointment.setId(
                new AppointmentID(
                        LocalDate.parse(node.get("id").get("appointmentDate").asText()),
                        LocalTime.parse(node.get("id").get("appointmentTime").asText())
                )
        );
        appointment.setClientId(usersRepository.getReferenceById(node.get("cid").asInt()));

        return appointmentService.saveAppointment(appointment);
    }

    @PostMapping("/get-appointment-count")
    public AppointmentAnswer appointmentAnswer(@RequestBody String date) {
        String[] split = date.split("-");
        return findAppointmentService.findNbAppointmentByMonth(new Month(LocalDate.parse(split[0] + "-" + (split[1].length() == 1 ? "0" + split[1] : split[1]) + "-01")));
    }

    @GetMapping("/get-user-appointment/{id}/{date}")
    public List<LocalTime> userAppointment(@PathVariable(name = "id") String cid, @PathVariable(name = "date") String date) {
        Users u = usersRepository.getReferenceById(Integer.parseInt(cid));
        LocalDate d = LocalDate.parse(date);
        System.out.println(u);
        System.out.println(d);
        return appointmentRepository.findByCidAndDate(u, d);
    }

    @PostMapping("/delete-appointment")
    public  String userAppointment(@RequestBody JsonNode node) {
        Appointment appointment = new Appointment();
        appointment.setId(
                new AppointmentID(
                        LocalDate.parse(node.get("id").get("appointmentDate").asText()),
                        LocalTime.parse(node.get("id").get("appointmentTime").asText())
                )
        );
        appointment.setClientId(usersRepository.getReferenceById(node.get("cid").asInt()));

        appointmentRepository.delete(appointment);

        return "Deletion Successful";
    }
}