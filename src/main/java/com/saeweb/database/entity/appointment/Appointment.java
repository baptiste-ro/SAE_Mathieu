package com.saeweb.database.entity.appointment;

import com.saeweb.database.entity.users.Users;
import jakarta.persistence.*;
import lombok.*;

@Entity
@NoArgsConstructor
@AllArgsConstructor
public class Appointment {
    @EmbeddedId
    private AppointmentID id;

    @ManyToOne
    @JoinColumn(name = "cid", referencedColumnName = "cid")
    private Users client;

    public AppointmentID getId() {
        return id;
    }

    public void setId(AppointmentID id) {
        this.id = id;
    }

    public Users getClient() {
        return client;
    }

    public void setClientId(Users clientId) {
        this.client = clientId;
    }

    public String toString() {
        return "{\n    id: {date: " + this.id.getAppointmentDate().toString() + ", time: " + this.id.getAppointmentTime().toString() + "},\n    cid: " + this.client.getCid() + "\n}";
    }

    public boolean isNull() {
        return this.id.getAppointmentDate() == null && this.id.getAppointmentTime() == null;
    }
}
