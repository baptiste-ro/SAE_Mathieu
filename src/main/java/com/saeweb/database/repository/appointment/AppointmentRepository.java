package com.saeweb.database.repository.appointment;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.database.entity.appointment.AppointmentID;
import com.saeweb.dto.appointment.NbAppointment;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.time.LocalDate;
import java.util.List;

@Repository
public interface AppointmentRepository extends JpaRepository<Appointment, AppointmentID> {
    @Query(value = "SELECT new com.saeweb.dto.appointment.NbAppointment(a.id.appointmentDate, count(a)) FROM Appointment AS a WHERE a.id.appointmentDate BETWEEN :c AND :n GROUP BY a.id.appointmentDate")
    List<NbAppointment> findAppointmentByMonth(@Param(value = "c") LocalDate current, @Param(value = "n") LocalDate next);

    @Query(value = "SELECT a FROM Appointment AS a WHERE a.id.appointmentDate = :d")
    List<Appointment> findByAppointmentDate(@Param(value = "d") LocalDate appointmentDate);
}
