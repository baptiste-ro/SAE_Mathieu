package com.saeweb.database.entity.appointment;

import jakarta.persistence.Column;
import jakarta.persistence.EmbeddedId;
import jakarta.persistence.Entity;
import lombok.*;

@Entity
@NoArgsConstructor
@AllArgsConstructor
public class Appointment {
    @EmbeddedId
    private AppointmentID id;

    @Column(name = "cid")
    private int clientId;

    public AppointmentID getId() {
        return id;
    }

    public void setId(AppointmentID id) {
        this.id = id;
    }

    public int getClientId() {
        return clientId;
    }

    public void setClientId(int clientId) {
        this.clientId = clientId;
    }

    public String toString() {
        return "{\n    id: {date: " + this.id.getAppointmentDate().toString() + ", time: " + this.id.getAppointmentTime().toString() + "},\n    cid: " + this.clientId + "\n}";
    }

    public boolean isNull() {
        return this.id.getAppointmentDate() == null && this.id.getAppointmentTime() == null;
    }
}
