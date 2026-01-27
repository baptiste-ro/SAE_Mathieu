package com.saeweb.service.mailto;

import com.saeweb.database.entity.appointment.Appointment;
import com.saeweb.database.entity.users.Users;
import com.saeweb.database.repository.user.UsersRepository;
import jakarta.mail.MessagingException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.mail.javamail.MimeMessageHelper;
import org.springframework.stereotype.Service;

import jakarta.mail.internet.MimeMessage;

@Service
public class MailSenderServiceImpl implements MailSenderService {
    @Autowired
    private JavaMailSender sender;

    @Autowired
    private UsersRepository repo;

    @Override
    public void sendMail(Appointment appointment) throws MessagingException {
        Users user = repo.findById(appointment.getClient().getCid()).get();

        MimeMessage message = sender.createMimeMessage();
        MimeMessageHelper helper = new MimeMessageHelper(message);

        helper.setFrom("mariteam.contact@gmail.com");
        helper.setTo(user.getEmail());
        helper.setSubject("Confirmation de prise de rendez-vous.");
        helper.setText("Bonjour,\nnous vous confirmons votre rendez-vous pour le \n" +
                appointment.getId().getAppointmentDate() +
                " à " +
                appointment.getId().getAppointmentTime() +
                "\navec [not implemented].\nMerci de bien vouloir vous présenter au moins 5 minutes." + "\n\n" +
                "S'il ne s'agît pas de vous, veuillez consulter vos réservations sur notre site, ou bien en nous contactant à l'adresse suivante: " + "\n" +
                "mariteam@gmail.com" + "\n\n" +
                "Nous vous souhaitons une bonne journée." + "\n" +
                "Cordialement," + "\n" +
                "L'équipe Mariteam."
        );

        sender.send(message);
    }
}
