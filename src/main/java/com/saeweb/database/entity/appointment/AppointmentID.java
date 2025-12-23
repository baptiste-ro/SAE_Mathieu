package com.saeweb.database.entity.appointment;

import jakarta.persistence.Column;
import jakarta.persistence.Embeddable;

import java.sql.Time;
import java.time.LocalDate;
import java.time.LocalTime;

@Embeddable
public class AppointmentID {
    @Column(name = "appointmentDate")
    private LocalDate appointmentDate;

    @Column(name = "appointmentTime")
    private LocalTime appointmentTime;

    public AppointmentID() {
        this.appointmentDate = null;
        this.appointmentTime = null;
    }

    public AppointmentID(LocalDate appointmentDate, LocalTime appointmentTime) {
        this.appointmentDate = appointmentDate;
        this.appointmentTime = appointmentTime;
    }

    public LocalDate getAppointmentDate() {
        return appointmentDate;
    }

    public void setAppointmentDate(LocalDate appointmentDate) {
        this.appointmentDate = appointmentDate;
    }

    public LocalTime getAppointmentTime() {
        return appointmentTime;
    }

    public void setAppointmentTime(LocalTime appointmentTime) {
        this.appointmentTime = appointmentTime;
    }
}
