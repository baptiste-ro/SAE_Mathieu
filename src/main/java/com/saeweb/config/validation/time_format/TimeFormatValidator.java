package com.saeweb.config.validation.time_format;

import com.saeweb.config.validation.date_format.DateFormatValidation;
import jakarta.validation.ConstraintValidator;
import jakarta.validation.ConstraintValidatorContext;

public class TimeFormatValidator implements ConstraintValidator<TimeFormatValidation, String> {

    @Override
    public void initialize(TimeFormatValidation constraintAnnotation) {
    }

    @Override
    public boolean isValid(String date, ConstraintValidatorContext context) {
        return date != null && date.matches("^(0[8-9]|1[0-9]|20):(00|30)$");
    }
}
