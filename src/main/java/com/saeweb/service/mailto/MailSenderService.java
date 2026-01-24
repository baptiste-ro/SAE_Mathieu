package com.saeweb.service.mailto;

import com.saeweb.database.entity.appointment.Appointment;
import jakarta.mail.MessagingException;


public interface MailSenderService {
    void sendMail(Appointment appointment) throws MessagingException;
}
