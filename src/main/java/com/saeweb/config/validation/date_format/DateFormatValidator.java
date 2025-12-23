package com.saeweb.config.validation.date_format;

import jakarta.validation.ConstraintValidator;
import jakarta.validation.ConstraintValidatorContext;
import org.springframework.stereotype.Component;

@Component
public class DateFormatValidator implements ConstraintValidator<DateFormatValidation, String> {

    @Override
    public void initialize(DateFormatValidation constraintAnnotation) {
    }

    @Override
    public boolean isValid(String date, ConstraintValidatorContext context) {
        if (date != null && date.matches("^[2-9][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$")) {
            String[] split = date.split("-");
            switch (split[1]) {
                case "01", "03", "05", "07", "08", "10", "12":
                    return true;
                case "04", "06", "09", "11":
                    return split[2].matches("^(0[1-9]|[1-2][0-9]|30)$");
                case "02":
                    if (Integer.parseInt(split[0])%4 == 0) {
                        return split[2].matches("^(0[1-9]|[1-2][0-9])$");
                    } else {
                        return split[2].matches("^(0[1-9]|1[0-9]|2[0-8])$");
                    }
                default:
                    return false;
            }
        } else {
            return false;
        }
    }
}