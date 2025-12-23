package com.saeweb.dto.appointment;

import java.util.List;

public class AppointmentAnswer {
    private List<NbAppointment> list;
    private boolean error;

    public AppointmentAnswer(List<NbAppointment> list, boolean error) {
        this.list = list;
        this.error = error;
    }

    public List<NbAppointment> getList() {
        return list;
    }

    public boolean isError() {
        return error;
    }
}
