package com.saeweb.service.appointment.save;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.database.repository.appointment.AppointmentRepository;
import com.saeweb.dto.date.Month;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class SaveAppointmentServiceImpl implements SaveAppointmentService{

    @Autowired
    private AppointmentRepository repository;

    @Override
    public Month saveAppointment(Appointment appointment) {
        try {
            if (repository.findById(appointment.getId()).isPresent()) {
                System.out.println("\nUn rendez-vous a déjà été trouvé à cette date et à la même heure.\n");
                return new Month();
            } else {
                System.out.println("\nAucun rendez-vous au même ID n'a été trouvé.\n");
                repository.save(appointment);
                return new Month(appointment.getId().getAppointmentDate());
            }
        } catch (Exception e) {
            System.out.println("\n" + e.getMessage() + "\n");
            return new Month();
        }
    }
}
